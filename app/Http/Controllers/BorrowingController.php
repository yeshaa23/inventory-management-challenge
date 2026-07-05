<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('details.product')
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('borrowings.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'borrower_name' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'borrow_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:borrow_date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()
                ->withErrors([
                    'quantity' => __('app.error_insufficient_stock'),
                ])
                ->withInput();
        }

        DB::transaction(function () use ($request, $product) {
            $borrowing = Borrowing::create([
                'borrower_name' => $request->borrower_name,
                'division' => $request->division,
                'borrow_date' => $request->borrow_date,
                'due_date' => $request->due_date,
                'status' => 'borrowed',
            ]);

            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);

            $product->decrement('stock', $request->quantity);

            ActivityLog::record(
                'create',
                'borrowings',
                'Mencatat peminjaman barang oleh: ' . $borrowing->borrower_name,
                [
                    'borrowing' => $borrowing->toArray(),
                    'product' => $product->toArray(),
                    'quantity' => $request->quantity,
                ]
            );
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', __('app.success_create_borrowing'));
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load('details.product');

        return view('borrowings.show', compact('borrowing'));
    }

    public function returnForm(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return redirect()
                ->route('borrowings.index')
                ->with('error', __('app.error_already_returned'));
        }

        $borrowing->load('details.product');

        return view('borrowings.return', compact('borrowing'));
    }

    public function returnItem(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'return_condition' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'return_note' => 'nullable|string|max:1000',
        ]);

        if ($borrowing->status === 'returned') {
            return redirect()
                ->route('borrowings.index')
                ->with('error', __('app.error_already_returned'));
        }

        DB::transaction(function () use ($request, $borrowing) {
            $borrowing->load('details.product');

            foreach ($borrowing->details as $detail) {
                $detail->product->increment('stock', $detail->quantity);

                if ($request->return_condition !== 'Baik') {
                    $detail->product->update([
                        'condition' => $request->return_condition,
                    ]);
                }
            }

            $borrowing->update([
                'status' => 'returned',
                'return_date' => now()->toDateString(),
                'return_condition' => $request->return_condition,
                'return_note' => $request->return_note,
            ]);

            ActivityLog::record(
                'return',
                'borrowings',
                'Mencatat pengembalian barang oleh: ' . $borrowing->borrower_name,
                [
                    'borrowing' => $borrowing->fresh()->toArray(),
                    'return_condition' => $request->return_condition,
                    'return_note' => $request->return_note,
                ]
            );
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', __('app.success_return_borrowing'));
    }

    public function destroy(Borrowing $borrowing)
    {
        DB::transaction(function () use ($borrowing) {
            $borrowing->load('details.product');

            if ($borrowing->status === 'borrowed') {
                foreach ($borrowing->details as $detail) {
                    $detail->product->increment('stock', $detail->quantity);
                }
            }

            ActivityLog::record(
                'delete',
                'borrowings',
                'Menghapus riwayat peminjaman: ' . $borrowing->borrower_name,
                $borrowing->toArray()
            );

            $borrowing->delete();
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', __('app.success_delete_borrowing'));
    }
}

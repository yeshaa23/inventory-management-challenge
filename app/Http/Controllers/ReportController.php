<?php

namespace App\Http\Controllers;

use App\Exports\BorrowingsExport;
use App\Exports\ProductsExport;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;

class ReportController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        $borrowings = Borrowing::with('details.product')
            ->latest()
            ->get();

        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $totalAvailableStock = Product::sum('good_stock');
        $totalDamagedStock = Product::sum('minor_damage_stock') + Product::sum('major_damage_stock');
        $totalBorrowings = Borrowing::count();

        $totalBorrowedItems = BorrowingDetail::whereHas('borrowing', function ($query) {
            $query->where('status', 'borrowed');
        })->sum('quantity');

        $lowStockProducts = Product::with('category')
            ->whereBetween('good_stock', [1, 5])
            ->get();

        $outOfStockProducts = Product::with('category')
            ->where('stock', '<=', 0)
            ->get();

        $damagedProducts = Product::with('category')
            ->where(function ($query) {
                $query->where('minor_damage_stock', '>', 0)
                    ->orWhere('major_damage_stock', '>', 0);
            })
            ->get();

        $overdueBorrowings = Borrowing::with('details.product')
            ->where('status', 'borrowed')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', now())
            ->latest()
            ->get();

        return view('reports.index', compact(
            'products',
            'borrowings',
            'totalProducts',
            'totalStock',
            'totalAvailableStock',
            'totalDamagedStock',
            'totalBorrowings',
            'totalBorrowedItems',
            'lowStockProducts',
            'outOfStockProducts',
            'damagedProducts',
            'overdueBorrowings'
        ));
    }

    public function exportProductsPdf()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->get();

        $pdf = Pdf::loadView('reports.pdf.products', [
            'products' => $products,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-barang.pdf');
    }

    public function exportProductsExcel()
    {
        return Excel::download(new ProductsExport, 'laporan-barang.xlsx');
    }

    public function exportProductsCsv()
    {
        return Excel::download(new ProductsExport, 'laporan-barang.csv', ExcelFormat::CSV);
    }

    public function exportBorrowingsPdf()
    {
        $borrowings = Borrowing::with('details.product')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('reports.pdf.borrowings', [
            'borrowings' => $borrowings,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function exportBorrowingsExcel()
    {
        return Excel::download(new BorrowingsExport, 'laporan-peminjaman.xlsx');
    }

    public function exportBorrowingsCsv()
    {
        return Excel::download(new BorrowingsExport, 'laporan-peminjaman.csv', ExcelFormat::CSV);
    }
}

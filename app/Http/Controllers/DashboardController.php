<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $availableStock = Product::sum('good_stock');
        $damagedStock = Product::sum('minor_damage_stock') + Product::sum('major_damage_stock');

        $borrowedItems = BorrowingDetail::whereHas('borrowing', function ($query) {
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

        $monthlyBorrowings = Borrowing::select('borrow_date')
            ->whereNotNull('borrow_date')
            ->get()
            ->groupBy(function ($borrowing) {
                return Carbon::parse($borrowing->borrow_date)->format('Y-m');
            })
            ->sortKeys()
            ->map(function ($items, $period) {
                $date = Carbon::createFromFormat('Y-m-d', $period . '-01')
                    ->locale(app()->getLocale());

                return (object) [
                    'label' => $date->translatedFormat('F Y'),
                    'month' => (int) $date->format('m'),
                    'year' => (int) $date->format('Y'),
                    'total' => $items->count(),
                ];
            })
            ->values();

        $categorySummaries = Product::select(
                'categories.name as category_name',
                DB::raw('COUNT(products.id) as total_product'),
                DB::raw('SUM(products.stock) as total_stock'),
                DB::raw('SUM(products.good_stock) as good_stock'),
                DB::raw('SUM(products.minor_damage_stock + products.major_damage_stock) as damaged_stock')
            )
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->groupBy('categories.name')
            ->orderBy('categories.name')
            ->get();

        $topBorrowedProducts = BorrowingDetail::select(
                'products.name',
                'products.code',
                DB::raw('SUM(borrowing_details.quantity) as total_borrowed')
            )
            ->join('products', 'products.id', '=', 'borrowing_details.product_id')
            ->groupBy('products.id', 'products.name', 'products.code')
            ->orderByDesc('total_borrowed')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'availableStock',
            'damagedStock',
            'borrowedItems',
            'lowStockProducts',
            'outOfStockProducts',
            'damagedProducts',
            'overdueBorrowings',
            'monthlyBorrowings',
            'categorySummaries',
            'topBorrowedProducts'
        ));
    }
}

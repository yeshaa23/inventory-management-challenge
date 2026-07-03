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
        $totalBorrowings = Borrowing::count();

        $totalBorrowedItems = BorrowingDetail::whereHas('borrowing', function ($query) {
            $query->where('status', 'borrowed');
        })->sum('quantity');

        $lowStockProducts = Product::with('category')
            ->where('stock', '<=', 5)
            ->get();

        return view('reports.index', compact(
            'products',
            'borrowings',
            'totalProducts',
            'totalStock',
            'totalBorrowings',
            'totalBorrowedItems',
            'lowStockProducts'
        ));
    }

    public function exportProductsPdf()
    {
        $products = Product::with('category')->orderBy('name')->get();

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

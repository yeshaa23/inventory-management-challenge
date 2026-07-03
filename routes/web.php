<?php

use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:Admin,Staff,Manager')
        ->name('dashboard');

    Route::resource('categories', CategoryController::class)
        ->middleware('role:Admin,Staff');

    Route::resource('products', ProductController::class)
        ->middleware('role:Admin,Staff');

    Route::resource('borrowings', BorrowingController::class)
        ->middleware('role:Admin,Staff');

    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnItem'])
        ->middleware('role:Admin,Staff')
        ->name('borrowings.return');

    Route::get('/reports', [ReportController::class, 'index'])
        ->middleware('role:Admin,Manager')
        ->name('reports.index');

    Route::get('/reports/products/pdf', [ReportController::class, 'exportProductsPdf'])
        ->middleware('role:Admin,Manager')
        ->name('reports.products.pdf');

    Route::get('/reports/products/excel', [ReportController::class, 'exportProductsExcel'])
        ->middleware('role:Admin,Manager')
        ->name('reports.products.excel');

    Route::get('/reports/products/csv', [ReportController::class, 'exportProductsCsv'])
        ->middleware('role:Admin,Manager')
        ->name('reports.products.csv');

    Route::get('/reports/borrowings/pdf', [ReportController::class, 'exportBorrowingsPdf'])
        ->middleware('role:Admin,Manager')
        ->name('reports.borrowings.pdf');

    Route::get('/reports/borrowings/excel', [ReportController::class, 'exportBorrowingsExcel'])
        ->middleware('role:Admin,Manager')
        ->name('reports.borrowings.excel');

    Route::get('/reports/borrowings/csv', [ReportController::class, 'exportBorrowingsCsv'])
        ->middleware('role:Admin,Manager')
        ->name('reports.borrowings.csv');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';

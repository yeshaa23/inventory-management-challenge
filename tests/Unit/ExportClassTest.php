<?php

use App\Exports\BorrowingsExport;
use App\Exports\ProductsExport;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

test('products export maps product data correctly', function () {
    $category = Category::create([
        'name' => 'Router',
        'description' => 'Perangkat jaringan',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'code' => 'RTR-0001',
        'name' => 'Router Telkomsel',
        'stock' => 10,
        'location' => 'Gudang A',
        'condition' => 'Baik',
    ]);

    $export = new ProductsExport();

    expect($export->collection())->toHaveCount(1);
    expect($export->headings())->toBeArray();
    expect($export->headings())->not->toBeEmpty();
    expect($export->title())->not->toBeEmpty();

    $mapped = $export->map($product->load('category'));

    expect($mapped)->toContain('RTR-0001');
    expect($mapped)->toContain('Router Telkomsel');
    expect($mapped)->toContain('Router');
    expect($mapped)->toContain(10);
    expect($mapped)->toContain('Gudang A');
    expect($mapped)->toContain('Available');
});

test('borrowings export maps borrowing data correctly', function () {
    $category = Category::create([
        'name' => 'Modem',
        'description' => 'Perangkat modem',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'code' => 'MOD-0001',
        'name' => 'Modem Huawei',
        'stock' => 10,
        'location' => 'Gudang A',
        'condition' => 'Baik',
    ]);

    $borrowing = Borrowing::create([
        'borrower_name' => 'Ayesha Hana',
        'division' => 'IT Support',
        'borrow_date' => now()->toDateString(),
        'due_date' => now()->addDays(7)->toDateString(),
        'return_date' => now()->addDays(2)->toDateString(),
        'return_condition' => 'Baik',
        'return_note' => 'Barang dikembalikan dengan baik.',
        'status' => 'returned',
    ]);

    $detail = BorrowingDetail::create([
        'borrowing_id' => $borrowing->id,
        'product_id' => $product->id,
        'quantity' => 2,
    ]);

    $export = new BorrowingsExport();

    expect($export->collection())->toHaveCount(1);
    expect($export->headings())->toBeArray();
    expect($export->headings())->not->toBeEmpty();
    expect($export->title())->not->toBeEmpty();

    $mapped = $export->map($detail->load(['borrowing', 'product']));

    expect($mapped)->toContain('Ayesha Hana');
    expect($mapped)->toContain('IT Support');
    expect($mapped)->toContain('MOD-0001');
    expect($mapped)->toContain('Modem Huawei');
    expect($mapped)->toContain(2);
    expect($mapped)->toContain('Returned');
});

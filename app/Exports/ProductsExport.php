<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    public function collection(): Collection
    {
        return Product::with('category')
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {
        return [
            __('app.product_code'),
            __('app.product_name'),
            __('app.category'),
            __('app.total_stock'),
            __('app.good_stock'),
            __('app.minor_damage_stock'),
            __('app.major_damage_stock'),
            __('app.storage_location'),
            __('app.status_stock'),
        ];
    }

    public function map($product): array
    {
        return [
            $product->code,
            $product->name,
            $product->category->name ?? '-',
            $product->stock,
            $product->good_stock,
            $product->minor_damage_stock,
            $product->major_damage_stock,
            $product->location,
            $product->stock_status_label,
        ];
    }

    public function title(): string
    {
        return __('app.product_report');
    }
}

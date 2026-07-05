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
            __('app.stock'),
            __('app.storage_location'),
            __('app.product_condition'),
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
            $product->location,
            match ($product->condition) {
                'Baik' => __('app.good'),
                'Rusak Ringan' => __('app.minor_damage'),
                'Rusak Berat' => __('app.major_damage'),
                default => $product->condition,
            },
            $product->stock_status_label,
        ];
    }

    public function title(): string
    {
        return __('app.product_report');
    }
}

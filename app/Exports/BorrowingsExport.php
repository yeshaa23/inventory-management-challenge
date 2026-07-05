<?php

namespace App\Exports;

use App\Models\BorrowingDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class BorrowingsExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    public function collection(): Collection
    {
        return BorrowingDetail::with(['borrowing', 'product'])
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            __('app.borrower_name'),
            __('app.division'),
            __('app.product_code'),
            __('app.product_name'),
            __('app.quantity'),
            __('app.borrow_date'),
            __('app.due_date'),
            __('app.return_date'),
            __('app.status'),
            __('app.return_condition'),
            __('app.return_note'),
        ];
    }

    public function map($detail): array
    {
        return [
            $detail->borrowing->borrower_name ?? '-',
            $detail->borrowing->division ?? '-',
            $detail->product->code ?? '-',
            $detail->product->name ?? '-',
            $detail->quantity,
            optional($detail->borrowing->borrow_date)->format('Y-m-d') ?? '-',
            optional($detail->borrowing->due_date)->format('Y-m-d') ?? '-',
            optional($detail->borrowing->return_date)->format('Y-m-d') ?? '-',
            $detail->borrowing->display_status_label ?? '-',
            match ($detail->borrowing->return_condition ?? null) {
                'Baik' => __('app.good'),
                'Rusak Ringan' => __('app.minor_damage'),
                'Rusak Berat' => __('app.major_damage'),
                default => '-',
            },
            $detail->borrowing->return_note ?? '-',
        ];
    }

    public function title(): string
    {
        return __('app.borrowing_report');
    }
}

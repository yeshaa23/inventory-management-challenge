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
            'Nama Peminjam',
            'Kode Barang',
            'Nama Barang',
            'Jumlah',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }

    public function map($detail): array
    {
        return [
            $detail->borrowing->borrower_name ?? '-',
            $detail->product->code ?? '-',
            $detail->product->name ?? '-',
            $detail->quantity,
            $detail->borrowing->borrow_date ?? '-',
            $detail->borrowing->return_date ?? '-',
            $detail->borrowing->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan',
        ];
    }

    public function title(): string
    {
        return 'Laporan Peminjaman';
    }
}

<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Borrowing</p>
            <h2>Detail Peminjaman</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Borrowing Detail</p>
                    <h3>{{ $borrowing->borrower_name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Detail data peminjaman, divisi peminjam, barang yang dipinjam, dan informasi pengembalian.
                    </p>
                </div>

                <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1">
                    <div class="gsm-helper-card static">
                        <div class="gsm-helper-icon">↔</div>

                        <h4>Informasi Peminjam</h4>

                        <div class="mt-5 space-y-4">
                            <div class="gsm-preview-box">
                                <p>Nama Peminjam</p>
                                <strong>{{ $borrowing->borrower_name }}</strong>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Divisi</p>
                                <p class="font-bold text-slate-900 mt-1">{{ $borrowing->division ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Status</p>
                                <div class="mt-2">
                                    @if($borrowing->display_status === 'overdue')
                                        <span class="gsm-badge danger">Terlambat</span>
                                    @elseif($borrowing->display_status === 'borrowed')
                                        <span class="gsm-badge warning">Dipinjam</span>
                                    @else
                                        <span class="gsm-badge success">Dikembalikan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="gsm-panel !shadow-none !p-0 !border-0">
                        <div class="gsm-table-wrapper">
                            <table class="gsm-table">
                                <tbody>
                                    <tr>
                                        <td class="font-bold">Tanggal Pinjam</td>
                                        <td>{{ $borrowing->borrow_date?->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">Jatuh Tempo</td>
                                        <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">Tanggal Kembali</td>
                                        <td>{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">Kondisi Saat Kembali</td>
                                        <td>{{ $borrowing->return_condition ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">Catatan Pengembalian</td>
                                        <td>{{ $borrowing->return_note ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <div class="gsm-panel-header mb-4">
                            <div>
                                <p class="gsm-eyebrow">Borrowed Item</p>
                                <h3>Barang Dipinjam</h3>
                            </div>
                        </div>

                        <div class="gsm-table-wrapper">
                            <table class="gsm-table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($borrowing->details as $detail)
                                        <tr>
                                            <td class="font-bold text-slate-900">{{ $detail->product->code ?? '-' }}</td>
                                            <td>{{ $detail->product->name ?? '-' }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($borrowing->status === 'borrowed')
                        <div class="gsm-form-actions">
                            <a href="{{ route('borrowings.return.form', $borrowing) }}" class="gsm-button-primary">
                                Kembalikan Barang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

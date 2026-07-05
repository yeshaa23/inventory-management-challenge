<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Reporting Center</p>
            <h2>Laporan Inventaris</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-stretch">
                <div class="xl:col-span-2 rounded-[30px] p-8 bg-slate-950 text-white overflow-hidden relative">
                    <div class="absolute -right-24 -top-24 w-72 h-72 rounded-full bg-red-600/30"></div>
                    <div class="absolute right-20 -bottom-32 w-72 h-72 rounded-full bg-white/10"></div>

                    <div class="relative z-10">
                        <span class="gsm-hero-badge">Report Workspace</span>

                        <h1 class="text-4xl md:text-5xl font-black tracking-tight leading-tight max-w-3xl">
                            Laporan formal untuk monitoring aset dan peminjaman.
                        </h1>

                        <p class="mt-5 text-slate-300 leading-8 max-w-2xl">
                            Berbeda dari dashboard yang berfungsi sebagai ringkasan cepat, halaman ini berfokus pada rekap data, daftar lengkap, dan export laporan untuk kebutuhan dokumentasi.
                        </p>
                    </div>
                </div>

                <div class="rounded-[30px] p-6 bg-red-50 border border-red-100 flex flex-col justify-between">
                    <div>
                        <p class="gsm-eyebrow">Export</p>
                        <h3 class="text-2xl font-black text-slate-900">Unduh Laporan</h3>
                        <p class="mt-2 text-sm text-slate-500 leading-6">
                            Pilih format PDF untuk laporan formal, Excel untuk pengolahan data, atau CSV untuk kebutuhan integrasi.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-3">
                        <a href="{{ route('reports.products.pdf') }}" class="gsm-button-primary w-full">
                            PDF Data Barang
                        </a>

                        <a href="{{ route('reports.borrowings.pdf') }}" class="gsm-button-secondary w-full">
                            PDF Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="gsm-detail-card">
                <span>Total Jenis Barang</span>
                <strong>{{ $totalProducts }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>Total Stok</span>
                <strong>{{ $totalStock }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>Total Transaksi</span>
                <strong>{{ $totalBorrowings }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>Barang Dipinjam</span>
                <strong>{{ $totalBorrowedItems }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>Stok Menipis</span>
                <strong>{{ $lowStockProducts->count() }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>Stok Habis</span>
                <strong>{{ $outOfStockProducts->count() }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>Barang Rusak</span>
                <strong>{{ $damagedProducts->count() }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>Terlambat</span>
                <strong>{{ $overdueBorrowings->count() }}</strong>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Download Center</p>
                    <h3>Export Laporan</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Gunakan tombol berikut untuk mengunduh laporan sesuai kebutuhan.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div class="rounded-[26px] border border-slate-200 bg-slate-50 p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="gsm-eyebrow">Inventory Report</p>
                            <h4 class="text-xl font-black text-slate-900">Laporan Data Barang</h4>
                            <p class="mt-2 text-sm text-slate-500 leading-6">
                                Berisi kode, nama, kategori, stok, lokasi, kondisi, dan status stok barang.
                            </p>
                        </div>

                        <div class="gsm-stat-icon red">▦</div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-2">
                        <a href="{{ route('reports.products.pdf') }}" class="gsm-button-primary">PDF</a>
                        <a href="{{ route('reports.products.excel') }}" class="gsm-button-secondary">Excel</a>
                        <a href="{{ route('reports.products.csv') }}" class="gsm-button-secondary">CSV</a>
                    </div>
                </div>

                <div class="rounded-[26px] border border-slate-200 bg-slate-50 p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="gsm-eyebrow">Borrowing Report</p>
                            <h4 class="text-xl font-black text-slate-900">Laporan Peminjaman</h4>
                            <p class="mt-2 text-sm text-slate-500 leading-6">
                                Berisi peminjam, divisi, barang, tanggal pinjam, jatuh tempo, status, dan kondisi kembali.
                            </p>
                        </div>

                        <div class="gsm-stat-icon yellow">↔</div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-2">
                        <a href="{{ route('reports.borrowings.pdf') }}" class="gsm-button-primary">PDF</a>
                        <a href="{{ route('reports.borrowings.excel') }}" class="gsm-button-secondary">Excel</a>
                        <a href="{{ route('reports.borrowings.csv') }}" class="gsm-button-secondary">CSV</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Inventory Data</p>
                    <h3>Laporan Data Barang</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Total {{ $products->count() }} barang tercatat di sistem.
                    </p>
                </div>
            </div>

            <div class="gsm-table-wrapper">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="font-bold text-slate-900">{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td class="font-bold">{{ $product->stock }}</td>
                                <td>{{ $product->location }}</td>
                                <td>{{ $product->condition }}</td>
                                <td>
                                    @if($product->stock_status === 'available')
                                        <span class="gsm-badge success">{{ $product->stock_status_label }}</span>
                                    @elseif($product->stock_status === 'low_stock')
                                        <span class="gsm-badge warning">{{ $product->stock_status_label }}</span>
                                    @elseif($product->stock_status === 'out_of_stock')
                                        <span class="gsm-badge danger">{{ $product->stock_status_label }}</span>
                                    @else
                                        <span class="gsm-badge info">{{ $product->stock_status_label }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="gsm-empty-state small">
                                        Belum ada data barang.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Borrowing Data</p>
                    <h3>Laporan Riwayat Peminjaman</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Total {{ $borrowings->count() }} transaksi peminjaman tercatat di sistem.
                    </p>
                </div>
            </div>

            <div class="gsm-table-wrapper">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Divisi</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Kondisi Kembali</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($borrowings as $borrowing)
                            @foreach($borrowing->details as $detail)
                                <tr>
                                    <td class="font-bold text-slate-900">{{ $borrowing->borrower_name }}</td>
                                    <td>{{ $borrowing->division ?? '-' }}</td>
                                    <td>{{ $detail->product->name ?? '-' }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $borrowing->borrow_date?->format('d M Y') }}</td>
                                    <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td>
                                    <td>
                                        @if($borrowing->display_status === 'overdue')
                                            <span class="gsm-badge danger">Terlambat</span>
                                        @elseif($borrowing->display_status === 'borrowed')
                                            <span class="gsm-badge warning">Dipinjam</span>
                                        @else
                                            <span class="gsm-badge success">Dikembalikan</span>
                                        @endif
                                    </td>
                                    <td>{{ $borrowing->return_condition ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="gsm-empty-state small">
                                        Belum ada data peminjaman.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">Low Stock</p>
                        <h3>Laporan Stok Menipis</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($lowStockProducts as $product)
                                <tr>
                                    <td class="font-bold text-slate-900">{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <span class="gsm-badge warning">{{ $product->stock }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="gsm-empty-state small">
                                            Tidak ada barang dengan stok menipis.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">Overdue</p>
                        <h3>Laporan Peminjaman Terlambat</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>Nama Peminjam</th>
                                <th>Divisi</th>
                                <th>Jatuh Tempo</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($overdueBorrowings as $borrowing)
                                <tr>
                                    <td class="font-bold text-slate-900">{{ $borrowing->borrower_name }}</td>
                                    <td>{{ $borrowing->division ?? '-' }}</td>
                                    <td>
                                        <span class="gsm-badge danger">{{ $borrowing->due_date?->format('d M Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="gsm-empty-state small">
                                            Tidak ada peminjaman terlambat.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

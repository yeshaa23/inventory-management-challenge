<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Overview</p>
            <h2>Dashboard Inventaris</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-hero-card">
            <div>
                <span class="gsm-hero-badge">Telkomsel Inventory Center</span>

                <h1>
                    Kelola inventaris kantor dengan lebih cepat dan terkontrol.
                </h1>

                <p>
                    Pantau stok barang, peminjaman aktif, barang rusak, stok menipis,
                    hingga riwayat pengembalian dalam satu dashboard.
                </p>

                <div class="gsm-hero-actions">
                    @if(auth()->user()->hasRole(['Admin', 'Staff']))
                        <a href="{{ route('products.create') }}" class="gsm-button-primary">
                            Tambah Barang
                        </a>

                        <a href="{{ route('borrowings.create') }}" class="gsm-button-white">
                            Tambah Peminjaman
                        </a>
                    @endif
                </div>
            </div>

            <div class="gsm-hero-visual">
                <div class="gsm-phone-card">
                    <div class="gsm-phone-top"></div>

                    <div class="gsm-phone-content">
                        <span>Total Stock</span>
                        <strong>{{ $availableStock }}</strong>
                        <p>{{ $totalProducts }} jenis barang tercatat</p>
                    </div>

                    <div class="gsm-phone-mini-grid">
                        <div>
                            <span>Borrowed</span>
                            <strong>{{ $borrowedItems }}</strong>
                        </div>

                        <div>
                            <span>Low Stock</span>
                            <strong>{{ $lowStockProducts->count() }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($lowStockProducts->count() > 0 || $overdueBorrowings->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @if($lowStockProducts->count() > 0)
                    <div class="gsm-alert-card warning">
                        <div class="gsm-alert-icon">!</div>

                        <div>
                            <h3>Stok Menipis</h3>
                            <p>
                                Ada {{ $lowStockProducts->count() }} barang dengan stok 1 sampai 5.
                                Segera lakukan pengecekan atau pengadaan ulang.
                            </p>
                        </div>
                    </div>
                @endif

                @if($overdueBorrowings->count() > 0)
                    <div class="gsm-alert-card danger">
                        <div class="gsm-alert-icon">!</div>

                        <div>
                            <h3>Peminjaman Terlambat</h3>
                            <p>
                                Ada {{ $overdueBorrowings->count() }} peminjaman yang melewati tanggal jatuh tempo.
                                Perlu dilakukan follow up pengembalian.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <section class="gsm-stat-grid">
            <div class="gsm-stat-card">
                <div class="gsm-stat-icon red">▦</div>
                <p>Total Jenis Barang</p>
                <h3>{{ $totalProducts }}</h3>
                <span>Item master</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon blue">◈</div>
                <p>Total Stok</p>
                <h3>{{ $availableStock }}</h3>
                <span>Unit tersedia</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon yellow">↔</div>
                <p>Barang Dipinjam</p>
                <h3>{{ $borrowedItems }}</h3>
                <span>Masih aktif</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon red">!</div>
                <p>Peminjaman Terlambat</p>
                <h3>{{ $overdueBorrowings->count() }}</h3>
                <span>Butuh follow up</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon yellow">↓</div>
                <p>Stok Menipis</p>
                <h3>{{ $lowStockProducts->count() }}</h3>
                <span>Stok 1 sampai 5</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon dark">×</div>
                <p>Stok Habis</p>
                <h3>{{ $outOfStockProducts->count() }}</h3>
                <span>Perlu restock</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon orange">⚠</div>
                <p>Barang Rusak</p>
                <h3>{{ $damagedProducts->count() }}</h3>
                <span>Perlu pengecekan</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon green">★</div>
                <p>Top Dipinjam</p>
                <h3>{{ $topBorrowedProducts->first()->total_borrowed ?? 0 }}</h3>
                <span>Frekuensi tertinggi</span>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="gsm-panel xl:col-span-2">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">Monthly Tracking</p>
                        <h3>Grafik Peminjaman per Bulan</h3>
                    </div>
                </div>

                <div class="gsm-chart-wrapper">
                    <canvas id="borrowingChart"></canvas>
                </div>
            </div>

            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">Most Used</p>
                        <h3>Top 5 Barang Dipinjam</h3>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse($topBorrowedProducts as $product)
                        <div class="gsm-mini-list">
                            <div>
                                <strong>{{ $product->name }}</strong>
                                <span>{{ $product->code }}</span>
                            </div>

                            <p>{{ $product->total_borrowed }}x</p>
                        </div>
                    @empty
                        <div class="gsm-empty-state small">
                            Belum ada data peminjaman barang.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">Category Summary</p>
                        <h3>Ringkasan Barang per Kategori</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Jenis Barang</th>
                                <th>Total Stok</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($categorySummaries as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->total_product }}</td>
                                    <td>{{ $category->total_stock }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="gsm-empty-state small">
                                            Belum ada data kategori barang.
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
                        <h3>Peminjaman Terlambat</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>Nama Peminjam</th>
                                <th>Divisi</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($overdueBorrowings as $borrowing)
                                <tr>
                                    <td>{{ $borrowing->borrower_name }}</td>
                                    <td>{{ $borrowing->division ?? '-' }}</td>
                                    <td>{{ $borrowing->due_date?->format('d M Y') }}</td>
                                    <td>
                                        <span class="gsm-badge danger">
                                            Terlambat
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="gsm-empty-state small">
                                            Tidak ada peminjaman yang terlambat.
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const monthlyData = @json($monthlyBorrowings);
        const labels = monthlyData.map(item => 'Bulan ' + item.month);
        const data = monthlyData.map(item => item.total);
        const ctx = document.getElementById('borrowingChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: data,
                    borderWidth: 1,
                    borderRadius: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Master Data</p>
            <h2>Data Barang</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        @if(session('success'))
            <div class="gsm-alert-card success">
                <div class="gsm-alert-icon">✓</div>

                <div>
                    <h3>Berhasil</h3>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Inventory Items</p>
                    <h3>Master Data Barang</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Kelola data inventaris, stok, lokasi penyimpanan, dan kondisi barang.
                    </p>
                </div>

                <a href="{{ route('products.create') }}" class="gsm-button-primary">
                    Tambah Barang
                </a>
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="gsm-filter-card">
                <div>
                    <label>Cari Barang</label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari kode, nama, atau lokasi"
                    >
                </div>

                <div>
                    <label>Kategori</label>

                    <select name="category_id">
                        <option value="">Semua Kategori</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Kondisi</label>

                    <select name="condition">
                        <option value="">Semua Kondisi</option>
                        <option value="Baik" {{ request('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ request('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ request('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>

                <div>
                    <label>Lokasi</label>

                    <select name="location">
                        <option value="">Semua Lokasi</option>

                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Status Stok</label>

                    <select name="stock_status">
                        <option value="">Semua Status</option>
                        <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Stok Menipis</option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Habis</option>
                        <option value="damaged" {{ request('stock_status') == 'damaged' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>

                <div>
                    <label>Urutkan</label>

                    <select name="sort">
                        <option value="">Terbaru</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>Stok Terendah</option>
                        <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Stok Tertinggi</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>

                <div class="gsm-filter-actions">
                    <button class="gsm-button-primary">
                        Filter
                    </button>

                    <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="gsm-table-wrapper mt-6">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <span class="font-bold text-slate-900">
                                        {{ $product->code }}
                                    </span>
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        @if($product->image)
                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-10 h-10 rounded-xl object-cover"
                                            >
                                        @else
                                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 grid place-items-center font-bold">
                                                {{ strtoupper(substr($product->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-bold text-slate-900">
                                                {{ $product->name }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                {{ $product->created_at?->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $product->category->name ?? '-' }}</td>

                                <td>
                                    <span class="font-bold">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                <td>{{ $product->location }}</td>

                                <td>
                                    @if($product->condition === 'Baik')
                                        <span class="gsm-badge success">
                                            Baik
                                        </span>
                                    @elseif($product->condition === 'Rusak Ringan')
                                        <span class="gsm-badge warning">
                                            Rusak Ringan
                                        </span>
                                    @else
                                        <span class="gsm-badge danger">
                                            Rusak Berat
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if($product->stock_status === 'available')
                                        <span class="gsm-badge success">
                                            {{ $product->stock_status_label }}
                                        </span>
                                    @elseif($product->stock_status === 'low_stock')
                                        <span class="gsm-badge warning">
                                            {{ $product->stock_status_label }}
                                        </span>
                                    @elseif($product->stock_status === 'out_of_stock')
                                        <span class="gsm-badge danger">
                                            {{ $product->stock_status_label }}
                                        </span>
                                    @else
                                        <span class="gsm-badge info">
                                            {{ $product->stock_status_label }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="gsm-action-group">
                                        <a href="{{ route('products.show', $product) }}" class="gsm-action-link view">
                                            Detail
                                        </a>

                                        <a href="{{ route('products.edit', $product) }}" class="gsm-action-link edit">
                                            Edit
                                        </a>

                                        <form id="delete-product-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="openConfirmModal('Yakin ingin menghapus barang ini? Data yang dihapus tidak dapat dikembalikan.', 'delete-product-{{ $product->id }}')"
                                                class="gsm-action-link delete"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="gsm-empty-state">
                                        <div>
                                            <p class="font-bold">Belum ada data barang.</p>
                                            <p class="text-sm mt-1">
                                                Klik tombol Tambah Barang untuk mulai mencatat inventaris.
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </section>
    </div>
</x-app-layout>

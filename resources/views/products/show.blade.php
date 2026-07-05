<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Master Data</p>
            <h2>Detail Barang</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Inventory Detail</p>
                    <h3>{{ $product->name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Informasi lengkap barang inventaris, lokasi penyimpanan, stok, dan kondisi barang.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="gsm-button-primary">
                        Edit Barang
                    </a>

                    <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1">
                    @if($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-80 object-cover rounded-[32px] border border-slate-200"
                        >
                    @else
                        <div class="w-full h-80 rounded-[32px] bg-red-50 text-red-600 grid place-items-center border border-red-100">
                            <div class="text-center">
                                <div class="text-6xl font-black">
                                    {{ strtoupper(substr($product->name, 0, 1)) }}
                                </div>
                                <p class="mt-2 font-bold">Tidak ada gambar</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="gsm-detail-card">
                            <span>Kode Barang</span>
                            <strong>{{ $product->code }}</strong>
                        </div>

                        <div class="gsm-detail-card">
                            <span>Nama Barang</span>
                            <strong>{{ $product->name }}</strong>
                        </div>

                        <div class="gsm-detail-card">
                            <span>Kategori</span>
                            <strong>{{ $product->category->name ?? '-' }}</strong>
                        </div>

                        <div class="gsm-detail-card">
                            <span>Stok</span>
                            <strong>{{ $product->stock }}</strong>
                        </div>

                        <div class="gsm-detail-card">
                            <span>Lokasi Penyimpanan</span>
                            <strong>{{ $product->location }}</strong>
                        </div>

                        <div class="gsm-detail-card">
                            <span>Kondisi</span>

                            @if($product->condition === 'Baik')
                                <strong><span class="gsm-badge success">Baik</span></strong>
                            @elseif($product->condition === 'Rusak Ringan')
                                <strong><span class="gsm-badge warning">Rusak Ringan</span></strong>
                            @else
                                <strong><span class="gsm-badge danger">Rusak Berat</span></strong>
                            @endif
                        </div>

                        <div class="gsm-detail-card md:col-span-2">
                            <span>Status Stok</span>

                            @if($product->stock_status === 'available')
                                <strong><span class="gsm-badge success">{{ $product->stock_status_label }}</span></strong>
                            @elseif($product->stock_status === 'low_stock')
                                <strong><span class="gsm-badge warning">{{ $product->stock_status_label }}</span></strong>
                            @elseif($product->stock_status === 'out_of_stock')
                                <strong><span class="gsm-badge danger">{{ $product->stock_status_label }}</span></strong>
                            @else
                                <strong><span class="gsm-badge info">{{ $product->stock_status_label }}</span></strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

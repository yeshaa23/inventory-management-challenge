<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Master Data</p>
            <h2>Detail Kategori</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Category Detail</p>
                    <h3>{{ $category->name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Detail kategori dan jumlah barang yang terhubung.
                    </p>
                </div>

                <div class="gsm-action-group">
                    <a href="{{ route('categories.edit', $category) }}" class="gsm-action-link edit">
                        Edit
                    </a>

                    <a href="{{ route('categories.index') }}" class="gsm-action-link view">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="gsm-detail-card">
                    <span>Nama Kategori</span>
                    <strong>{{ $category->name }}</strong>
                </div>

                <div class="gsm-detail-card">
                    <span>Jumlah Barang</span>
                    <strong>{{ $category->products()->count() }}</strong>
                </div>

                <div class="gsm-detail-card">
                    <span>Tanggal Dibuat</span>
                    <strong>{{ $category->created_at?->format('d M Y') }}</strong>
                </div>
            </div>

            <div class="gsm-panel mt-6 shadow-none">
                <p class="gsm-eyebrow">Description</p>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Deskripsi Kategori</h3>
                <p class="text-slate-600 leading-relaxed">
                    {{ $category->description ?? 'Belum ada deskripsi untuk kategori ini.' }}
                </p>
            </div>
        </section>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Master Data</p>
            <h2>Tambah Kategori</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-form-layout">
            <div class="gsm-panel gsm-form-main">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">Category Form</p>
                        <h3>Form Tambah Kategori</h3>
                        <p class="text-sm text-slate-500 mt-1">
                            Tambahkan kategori baru untuk mengelompokkan barang inventaris.
                        </p>
                    </div>
                </div>

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="gsm-form-grid">
                        <div class="gsm-field gsm-field-full">
                            <label>Nama Kategori</label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Elektronik, ATK, Furniture"
                            >

                            @error('name')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label>Deskripsi</label>

                            <textarea
                                name="description"
                                rows="5"
                                placeholder="Tulis deskripsi singkat kategori"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            Simpan Kategori
                        </button>

                        <a href="{{ route('categories.index') }}" class="gsm-button-secondary">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

            <aside class="gsm-helper-card">
                <div class="gsm-helper-icon">▦</div>

                <h4>Tips Kategori</h4>

                <ul>
                    <li>Gunakan nama kategori yang singkat dan mudah dipahami.</li>
                    <li>Contoh kategori: Elektronik, ATK, Furniture, Perangkat Jaringan.</li>
                    <li>Kategori akan digunakan saat membuat kode barang otomatis.</li>
                </ul>
            </aside>
        </section>
    </div>
</x-app-layout>

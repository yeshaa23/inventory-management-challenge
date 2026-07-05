<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Master Data</p>
            <h2>Tambah Barang</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">New Inventory Item</p>
                    <h3>Form Tambah Barang</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Tambahkan data barang baru beserta kategori, stok, lokasi penyimpanan, kondisi, dan gambar barang.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                    Kembali
                </a>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="gsm-form-layout">
                @csrf

                <div class="gsm-form-main">
                    <div class="gsm-form-grid">
                        <div class="gsm-field">
                            <label for="code">Kode Barang</label>

                            <input
                                type="text"
                                name="code"
                                id="code"
                                value="{{ old('code') }}"
                                placeholder="Pilih kategori untuk membuat kode otomatis"
                                readonly
                            >

                            <small>Kode barang dibuat otomatis berdasarkan kategori.</small>

                            @error('code')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="name">Nama Barang</label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Laptop Lenovo ThinkPad"
                            >

                            @error('name')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="category_id">Kategori</label>

                            <select name="category_id" id="category_id">
                                <option value="">Pilih Kategori</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="stock">Stok</label>

                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                value="{{ old('stock', 0) }}"
                                min="0"
                                placeholder="0"
                            >

                            @error('stock')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="location_select">Lokasi Penyimpanan</label>

                            @php
                                $defaultLocations = [
                                    'Gudang Utama',
                                    'Ruang IT',
                                    'Ruang Administrasi',
                                    'Ruang Meeting',
                                    'Kantor Cabang',
                                ];

                                $allLocations = collect($locations)
                                    ->merge($defaultLocations)
                                    ->unique()
                                    ->values();
                            @endphp

                            <select name="location_select" id="location_select">
                                <option value="">Pilih Lokasi Penyimpanan</option>

                                @foreach($allLocations as $location)
                                    <option value="{{ $location }}" {{ old('location_select') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach

                                <option value="other" {{ old('location_select') == 'other' ? 'selected' : '' }}>
                                    Lokasi Lainnya
                                </option>
                            </select>

                            @error('location_select')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror

                            <div id="location_other_wrapper" class="gsm-nested-field hidden">
                                <label for="location_other">Masukkan Lokasi Baru</label>

                                <input
                                    type="text"
                                    name="location_other"
                                    id="location_other"
                                    value="{{ old('location_other') }}"
                                    placeholder="Contoh: Gudang Cabang Surabaya"
                                >

                                @error('location_other')
                                    <p class="gsm-error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="gsm-field">
                            <label for="condition">Kondisi Barang</label>

                            <select name="condition" id="condition">
                                <option value="">Pilih Kondisi</option>
                                <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ old('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>

                            @error('condition')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label for="image">Upload Gambar Barang</label>

                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept="image/png, image/jpeg, image/jpg"
                            >

                            <small>Format gambar: JPG, JPEG, atau PNG. Maksimal 2 MB.</small>

                            @error('image')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            Simpan Barang
                        </button>

                        <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                            Batal
                        </a>
                    </div>
                </div>

                <aside class="gsm-helper-card">
                    <div class="gsm-helper-icon">◈</div>

                    <h4>Preview Data Barang</h4>

                    <div class="gsm-preview-box">
                        <p>Kode Barang</p>
                        <strong id="preview-code">Belum dibuat</strong>
                    </div>

                    <ul>
                        <li>Pilih kategori untuk membuat kode otomatis.</li>
                        <li>Gunakan lokasi yang sudah tersedia atau pilih Lokasi Lainnya.</li>
                        <li>Pastikan stok dan kondisi barang sesuai data fisik.</li>
                    </ul>
                </aside>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const codeInput = document.getElementById('code');
            const previewCode = document.getElementById('preview-code');

            async function generateCode(categoryId) {
                if (!categoryId) {
                    codeInput.value = '';
                    codeInput.placeholder = 'Pilih kategori untuk membuat kode otomatis';
                    previewCode.textContent = 'Belum dibuat';
                    return;
                }

                codeInput.value = 'Membuat kode...';
                previewCode.textContent = 'Membuat kode...';

                try {
                    const response = await fetch(`{{ route('products.generate-code') }}?category_id=${categoryId}`);
                    const data = await response.json();

                    if (data.code) {
                        codeInput.value = data.code;
                        previewCode.textContent = data.code;
                    } else {
                        codeInput.value = '';
                        codeInput.placeholder = 'Kode gagal dibuat';
                        previewCode.textContent = 'Kode gagal dibuat';
                    }
                } catch (error) {
                    codeInput.value = '';
                    codeInput.placeholder = 'Terjadi kesalahan saat membuat kode';
                    previewCode.textContent = 'Gagal membuat kode';
                }
            }

            if (categorySelect) {
                categorySelect.addEventListener('change', function () {
                    generateCode(this.value);
                });

                if (categorySelect.value) {
                    generateCode(categorySelect.value);
                }
            }

            const locationSelect = document.getElementById('location_select');
            const locationOtherWrapper = document.getElementById('location_other_wrapper');
            const locationOtherInput = document.getElementById('location_other');

            function toggleLocationOther() {
                if (locationSelect.value === 'other') {
                    locationOtherWrapper.classList.remove('hidden');
                    locationOtherInput.setAttribute('required', 'required');
                } else {
                    locationOtherWrapper.classList.add('hidden');
                    locationOtherInput.removeAttribute('required');
                    locationOtherInput.value = '';
                }
            }

            if (locationSelect) {
                locationSelect.addEventListener('change', toggleLocationOther);
                toggleLocationOther();
            }
        });
    </script>
</x-app-layout>

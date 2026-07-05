<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Master Data</p>
            <h2>Edit Barang</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Update Inventory Item</p>
                    <h3>Form Edit Barang</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Perbarui data barang, stok, lokasi penyimpanan, kondisi, dan gambar barang.
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                    Kembali
                </a>
            </div>

            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="gsm-form-layout">
                @csrf
                @method('PUT')

                <div class="gsm-form-main">
                    <div class="gsm-form-grid">
                        <div class="gsm-field">
                            <label for="code">Kode Barang</label>

                            <input
                                type="text"
                                name="code"
                                id="code"
                                value="{{ old('code', $product->code) }}"
                            >

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
                                value="{{ old('name', $product->name) }}"
                                placeholder="Contoh: Laptop Lenovo ThinkPad"
                            >

                            @error('name')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="category_id">Kategori</label>

                            <select name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                value="{{ old('stock', $product->stock) }}"
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

                                $isCustomLocation = ! $allLocations->contains($product->location);
                            @endphp

                            <select name="location_select" id="location_select">
                                <option value="">Pilih Lokasi Penyimpanan</option>

                                @foreach($allLocations as $location)
                                    <option value="{{ $location }}"
                                        {{ old('location_select', $isCustomLocation ? 'other' : $product->location) == $location ? 'selected' : '' }}
                                    >
                                        {{ $location }}
                                    </option>
                                @endforeach

                                <option value="other" {{ old('location_select', $isCustomLocation ? 'other' : $product->location) == 'other' ? 'selected' : '' }}>
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
                                    value="{{ old('location_other', $isCustomLocation ? $product->location : '') }}"
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
                                <option value="Baik" {{ old('condition', $product->condition) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('condition', $product->condition) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ old('condition', $product->condition) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>

                            @error('condition')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label for="image">Gambar Barang</label>

                            @if($product->image)
                                <div class="mb-3">
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-32 h-32 object-cover rounded-3xl border border-slate-200"
                                    >
                                </div>
                            @endif

                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept="image/png, image/jpeg, image/jpg"
                            >

                            <small>Kosongkan jika tidak ingin mengganti gambar.</small>

                            @error('image')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            Update Barang
                        </button>

                        <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                            Batal
                        </a>
                    </div>
                </div>

                <aside class="gsm-helper-card">
                    <div class="gsm-helper-icon">◈</div>

                    <h4>Ringkasan Barang</h4>

                    <div class="gsm-preview-box">
                        <p>Kode Barang</p>
                        <strong>{{ $product->code }}</strong>
                    </div>

                    <ul>
                        <li>Pastikan perubahan stok sesuai kondisi aktual barang.</li>
                        <li>Lokasi dapat dipilih dari daftar atau diisi sebagai lokasi baru.</li>
                        <li>Jika kondisi rusak, data akan terlihat di laporan barang rusak.</li>
                    </ul>
                </aside>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                }
            }

            if (locationSelect) {
                locationSelect.addEventListener('change', toggleLocationOther);
                toggleLocationOther();
            }
        });
    </script>
</x-app-layout>

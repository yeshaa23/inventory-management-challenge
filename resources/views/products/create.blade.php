<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Tambah Barang
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 p-6 rounded shadow">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1">Kode Barang</label>

                        <input
                            type="text"
                            name="code"
                            id="code"
                            value="{{ old('code') }}"
                            placeholder="Pilih kategori untuk membuat kode otomatis"
                            class="w-full border rounded px-3 py-2 bg-gray-100 dark:bg-gray-700"
                            readonly
                        >

                        <p class="text-sm text-gray-500 mt-1">
                            Kode barang akan dibuat otomatis berdasarkan kategori.
                        </p>

                        @error('code')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Nama Barang</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full border rounded px-3 py-2"
                        >

                        @error('name')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Kategori</label>

                        <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Kategori</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Stok</label>

                        <input
                            type="number"
                            name="stock"
                            value="{{ old('stock', 0) }}"
                            min="0"
                            class="w-full border rounded px-3 py-2"
                        >

                        @error('stock')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Lokasi Penyimpanan</label>

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

                        <select
                            name="location_select"
                            id="location_select"
                            class="w-full border rounded px-3 py-2"
                        >
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
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror

                        <div id="location_other_wrapper" class="mt-3 hidden">
                            <label class="block mb-1">Masukkan Lokasi Baru</label>

                            <input
                                type="text"
                                name="location_other"
                                id="location_other"
                                value="{{ old('location_other') }}"
                                placeholder="Contoh: Gudang Cabang Surabaya, Luar Kantor Pusat"
                                class="w-full border rounded px-3 py-2"
                            >

                            @error('location_other')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1">Kondisi Barang</label>

                        <select name="condition" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>

                        @error('condition')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-1">Upload Gambar Barang</label>

                        <input
                            type="file"
                            name="image"
                            class="w-full border rounded px-3 py-2"
                        >

                        @error('image')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                        Simpan
                    </button>

                    <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const codeInput = document.getElementById('code');

            async function generateCode(categoryId) {
                if (!categoryId) {
                    codeInput.value = '';
                    codeInput.placeholder = 'Pilih kategori untuk membuat kode otomatis';
                    return;
                }

                codeInput.value = 'Membuat kode...';

                try {
                    const response = await fetch(`{{ route('products.generate-code') }}?category_id=${categoryId}`);
                    const data = await response.json();

                    if (data.code) {
                        codeInput.value = data.code;
                    } else {
                        codeInput.value = '';
                        codeInput.placeholder = 'Kode gagal dibuat';
                    }
                } catch (error) {
                    codeInput.value = '';
                    codeInput.placeholder = 'Terjadi kesalahan saat membuat kode';
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

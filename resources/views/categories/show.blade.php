<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Detail Kategori
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Informasi detail kategori barang inventaris.
                </p>
            </div>

            <a href="{{ route('categories.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="border-b border-gray-100 px-6 py-5">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $category->name }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Detail data kategori inventaris.
                    </p>
                </div>

                <div class="space-y-6 px-6 py-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nama Kategori</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">
                            {{ $category->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Deskripsi</p>
                        <p class="mt-1 text-base text-gray-700">
                            {{ $category->description ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Dibuat Pada</p>
                        <p class="mt-1 text-base text-gray-700">
                            {{ $category->created_at ? $category->created_at->format('d M Y H:i') : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Terakhir Diperbarui</p>
                        <p class="mt-1 text-base text-gray-700">
                            {{ $category->updated_at ? $category->updated_at->format('d M Y H:i') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 sm:flex-row sm:justify-end">
                    <a href="{{ route('categories.index') }}"
                       class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50">
                        Kembali
                    </a>

                    <a href="{{ route('categories.edit', $category) }}"
                        class="inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-red-700">
                        Edit Kategori
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

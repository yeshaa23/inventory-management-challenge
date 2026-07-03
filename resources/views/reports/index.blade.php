<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Laporan Inventaris
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- EXPORT LAPORAN --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                    Export Laporan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Export Data Barang --}}
                    <div class="border dark:border-gray-600 rounded p-4">
                        <h4 class="font-semibold mb-3 text-gray-800 dark:text-gray-100">
                            Laporan Data Barang
                        </h4>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('reports.products.pdf') }}"
                               class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Export PDF
                            </a>

                            <a href="{{ route('reports.products.excel') }}"
                               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Export Excel
                            </a>

                            <a href="{{ route('reports.products.csv') }}"
                               class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800">
                                Export CSV
                            </a>
                        </div>
                    </div>

                    {{-- Export Peminjaman --}}
                    <div class="border dark:border-gray-600 rounded p-4">
                        <h4 class="font-semibold mb-3 text-gray-800 dark:text-gray-100">
                            Laporan Peminjaman
                        </h4>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('reports.borrowings.pdf') }}"
                               class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Export PDF
                            </a>

                            <a href="{{ route('reports.borrowings.excel') }}"
                               class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Export Excel
                            </a>

                            <a href="{{ route('reports.borrowings.csv') }}"
                               class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800">
                                Export CSV
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- STATISTIK RINGKAS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-gray-500 dark:text-gray-300">Total Jenis Barang</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        {{ $totalProducts }}
                    </h3>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-gray-500 dark:text-gray-300">Total Stok Barang</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        {{ $totalStock }}
                    </h3>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-gray-500 dark:text-gray-300">Total Transaksi Peminjaman</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        {{ $totalBorrowings }}
                    </h3>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <p class="text-gray-500 dark:text-gray-300">Barang Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        {{ $totalBorrowedItems }}
                    </h3>
                </div>
            </div>

            {{-- LAPORAN DATA BARANG --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        Laporan Data Barang
                    </h3>

                    <span class="text-sm text-gray-500 dark:text-gray-300">
                        Total: {{ $products->count() }} barang
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border dark:border-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Kode
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Nama Barang
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Kategori
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Stok
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Lokasi
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Kondisi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($products as $product)
                                <tr class="text-gray-800 dark:text-gray-100">
                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->code }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->name }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->category->name ?? '-' }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->stock }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->location }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->condition }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="border dark:border-gray-600 px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                        Belum ada data barang.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- LAPORAN RIWAYAT PEMINJAMAN --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        Laporan Riwayat Peminjaman
                    </h3>

                    <span class="text-sm text-gray-500 dark:text-gray-300">
                        Total: {{ $borrowings->count() }} transaksi
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border dark:border-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Nama Peminjam
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Barang
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Jumlah
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Tanggal Pinjam
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Tanggal Kembali
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($borrowings as $borrowing)
                                @foreach($borrowing->details as $detail)
                                    <tr class="text-gray-800 dark:text-gray-100">
                                        <td class="border dark:border-gray-600 px-4 py-2">
                                            {{ $borrowing->borrower_name }}
                                        </td>

                                        <td class="border dark:border-gray-600 px-4 py-2">
                                            {{ $detail->product->name ?? '-' }}
                                        </td>

                                        <td class="border dark:border-gray-600 px-4 py-2">
                                            {{ $detail->quantity }}
                                        </td>

                                        <td class="border dark:border-gray-600 px-4 py-2">
                                            {{ $borrowing->borrow_date }}
                                        </td>

                                        <td class="border dark:border-gray-600 px-4 py-2">
                                            {{ $borrowing->return_date ?? '-' }}
                                        </td>

                                        <td class="border dark:border-gray-600 px-4 py-2">
                                            @if($borrowing->status == 'borrowed')
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded">
                                                    Dipinjam
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded">
                                                    Dikembalikan
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="border dark:border-gray-600 px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                        Belum ada data peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- LAPORAN STOK MENIPIS --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                    Laporan Stok Menipis
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full border dark:border-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Kode
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Nama Barang
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Kategori
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Stok
                                </th>
                                <th class="border dark:border-gray-600 px-4 py-2 text-left text-gray-800 dark:text-gray-100">
                                    Lokasi
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($lowStockProducts as $product)
                                <tr class="text-gray-800 dark:text-gray-100">
                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->code }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->name }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->category->name ?? '-' }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->stock }}
                                    </td>

                                    <td class="border dark:border-gray-600 px-4 py-2">
                                        {{ $product->location }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="border dark:border-gray-600 px-4 py-2 text-center text-gray-500 dark:text-gray-300">
                                        Tidak ada barang dengan stok menipis.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

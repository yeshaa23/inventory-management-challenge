<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Master Data</p>
            <h2>Data Kategori</h2>
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
                    <p class="gsm-eyebrow">Category Management</p>
                    <h3>Master Data Kategori</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Kelola kategori barang untuk membantu pengelompokan inventaris kantor.
                    </p>
                </div>

                <a href="{{ route('categories.create') }}" class="gsm-button-primary">
                    Tambah Kategori
                </a>
            </div>

            <div class="gsm-table-wrapper mt-6">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <span class="font-bold text-slate-900">
                                        {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                                    </span>
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 grid place-items-center font-bold">
                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-bold text-slate-900">
                                                {{ $category->name }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Dibuat {{ $category->created_at?->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    {{ $category->description ?? '-' }}
                                </td>

                                <td>
                                    <span class="gsm-badge info">
                                        {{ $category->products()->count() }} barang
                                    </span>
                                </td>

                                <td>
                                    <div class="gsm-action-group">
                                        <a href="{{ route('categories.show', $category) }}" class="gsm-action-link view">
                                            Detail
                                        </a>

                                        <a href="{{ route('categories.edit', $category) }}" class="gsm-action-link edit">
                                            Edit
                                        </a>

                                        <form id="delete-category-{{ $category->id }}" action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="openConfirmModal('Yakin ingin menghapus kategori ini? Pastikan tidak ada barang penting yang masih terhubung dengan kategori ini.', 'delete-category-{{ $category->id }}')"
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
                                <td colspan="5">
                                    <div class="gsm-empty-state">
                                        <div>
                                            <p class="font-bold">Belum ada data kategori.</p>
                                            <p class="text-sm mt-1">
                                                Klik Tambah Kategori untuk mulai mengelompokkan barang inventaris.
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
                {{ $categories->links() }}
            </div>
        </section>
    </div>
</x-app-layout>

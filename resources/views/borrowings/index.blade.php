<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">Borrowing</p>
            <h2>Riwayat Peminjaman</h2>
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

        @if(session('error'))
            <div class="gsm-alert-card danger">
                <div class="gsm-alert-icon">!</div>

                <div>
                    <h3>Gagal</h3>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Borrowing History</p>
                    <h3>Data Peminjaman Barang</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Kelola peminjaman, pengembalian, divisi peminjam, dan keterlambatan barang.
                    </p>
                </div>

                <a href="{{ route('borrowings.create') }}" class="gsm-button-primary">
                    Tambah Peminjaman
                </a>
            </div>

            <div class="gsm-table-wrapper mt-6">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>Divisi</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($borrowings as $borrowing)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 grid place-items-center font-bold">
                                            {{ strtoupper(substr($borrowing->borrower_name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-bold text-slate-900">
                                                {{ $borrowing->borrower_name }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                {{ $borrowing->details->count() }} item detail
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $borrowing->division ?? '-' }}</td>
                                <td>{{ $borrowing->borrow_date?->format('d M Y') }}</td>
                                <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
                                <td>{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td>

                                <td>
                                    @if($borrowing->display_status === 'overdue')
                                        <span class="gsm-badge danger">
                                            Terlambat
                                        </span>
                                    @elseif($borrowing->display_status === 'borrowed')
                                        <span class="gsm-badge warning">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="gsm-badge success">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="gsm-action-group">
                                        <a href="{{ route('borrowings.show', $borrowing) }}" class="gsm-action-link view">
                                            Detail
                                        </a>

                                        @if($borrowing->status === 'borrowed')
                                            <a href="{{ route('borrowings.return.form', $borrowing) }}" class="gsm-action-link edit">
                                                Kembalikan
                                            </a>
                                        @endif

                                        <form id="delete-borrowing-{{ $borrowing->id }}" action="{{ route('borrowings.destroy', $borrowing) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="openConfirmModal('Yakin ingin menghapus riwayat peminjaman ini? Jika masih dipinjam, stok akan dikembalikan.', 'delete-borrowing-{{ $borrowing->id }}')"
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
                                <td colspan="7">
                                    <div class="gsm-empty-state">
                                        <div>
                                            <p class="font-bold">Belum ada data peminjaman.</p>
                                            <p class="text-sm mt-1">
                                                Klik Tambah Peminjaman untuk mencatat transaksi peminjaman barang.
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
                {{ $borrowings->links() }}
            </div>
        </section>
    </div>
</x-app-layout>

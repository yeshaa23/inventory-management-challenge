<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">System Audit</p>
            <h2>Riwayat Aktivitas</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
                <div class="lg:col-span-2 rounded-[30px] p-8 bg-slate-950 text-white relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-red-600/30"></div>

                    <div class="relative z-10">
                        <span class="gsm-hero-badge">Audit Trail</span>

                        <h1 class="text-4xl md:text-5xl font-black tracking-tight leading-tight">
                            Pantau perubahan data penting pada sistem.
                        </h1>

                        <p class="mt-5 text-slate-300 leading-8 max-w-2xl">
                            Riwayat aktivitas membantu admin melihat siapa yang menambah, mengubah, menghapus, atau mengembalikan data inventaris.
                        </p>
                    </div>
                </div>

                <div class="rounded-[30px] border border-red-100 bg-red-50 p-6 flex flex-col justify-between">
                    <div>
                        <p class="gsm-eyebrow">Total Log</p>
                        <h3 class="text-5xl font-black text-red-600">{{ $activityLogs->total() }}</h3>
                        <p class="mt-3 text-sm text-slate-500 leading-6">
                            Aktivitas terbaru ditampilkan paling atas untuk memudahkan pengecekan perubahan data.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">Audit Log</p>
                    <h3>Riwayat Aktivitas Sistem</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Data ini hanya dapat dilihat oleh Admin.
                    </p>
                </div>
            </div>

            <div class="gsm-table-wrapper">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aksi</th>
                            <th>Modul</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($activityLogs as $log)
                            <tr>
                                <td>
                                    <div>
                                        <p class="font-bold text-slate-900">
                                            {{ $log->created_at->format('d M Y') }}
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $log->created_at->format('H:i') }} WIB
                                        </p>
                                    </div>
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 grid place-items-center font-black">
                                            {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-bold text-slate-900">
                                                {{ $log->user->name ?? 'System' }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                {{ $log->user->role->name ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if($log->action === 'create')
                                        <span class="gsm-badge success">CREATE</span>
                                    @elseif($log->action === 'update')
                                        <span class="gsm-badge warning">UPDATE</span>
                                    @elseif($log->action === 'delete')
                                        <span class="gsm-badge danger">DELETE</span>
                                    @elseif($log->action === 'return')
                                        <span class="gsm-badge info">RETURN</span>
                                    @else
                                        <span class="gsm-badge info">{{ strtoupper($log->action) }}</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="font-bold text-slate-900">
                                        {{ $log->module ?? '-' }}
                                    </span>
                                </td>

                                <td>{{ $log->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="gsm-empty-state">
                                        <div>
                                            <p class="font-bold">Belum ada aktivitas yang tercatat.</p>
                                            <p class="text-sm mt-1">
                                                Aktivitas akan muncul setelah data kategori, barang, atau peminjaman dikelola.
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
                {{ $activityLogs->links() }}
            </div>
        </section>
    </div>
</x-app-layout>

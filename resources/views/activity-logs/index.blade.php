<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.system_audit') }}</p>
            <h2>{{ __('app.activity_logs') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
                <div class="lg:col-span-2 rounded-[30px] p-8 bg-slate-950 text-white relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-red-600/30"></div>

                    <div class="relative z-10">
                        <span class="gsm-hero-badge">{{ __('app.audit_trail') }}</span>

                        <h1 class="text-4xl md:text-5xl font-black tracking-tight leading-tight">
                            {{ __('app.activity_hero_title') }}
                        </h1>

                        <p class="mt-5 text-slate-300 leading-8 max-w-2xl">
                            {{ __('app.activity_hero_desc') }}
                        </p>
                    </div>
                </div>

                <div class="rounded-[30px] border border-red-100 bg-red-50 p-6 flex flex-col justify-between">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.total_log') }}</p>
                        <h3 class="text-5xl font-black text-red-600">{{ $activityLogs->total() }}</h3>
                        <p class="mt-3 text-sm text-slate-500 leading-6">
                            {{ __('app.activity_total_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.audit_log') }}</p>
                    <h3>{{ __('app.system_activity_history') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.admin_only_data') }}
                    </p>
                </div>
            </div>

            <div class="gsm-table-wrapper">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.time') }}</th>
                            <th>{{ __('app.user') }}</th>
                            <th>{{ __('app.actions') }}</th>
                            <th>{{ __('app.module') }}</th>
                            <th>{{ __('app.description') }}</th>
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
                                            <p class="font-bold">{{ __('app.no_activity_data') }}</p>
                                            <p class="text-sm mt-1">
                                                {{ __('app.activity_empty_desc') }}
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

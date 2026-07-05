<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.borrowing') }}</p>
            <h2>{{ __('app.borrowing_history') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        @if(session('success'))
            <div class="gsm-alert-card success">
                <div class="gsm-alert-icon">✓</div>

                <div>
                    <h3>{{ __('app.success') }}</h3>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="gsm-alert-card danger">
                <div class="gsm-alert-icon">!</div>

                <div>
                    <h3>{{ __('app.failed') }}</h3>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.borrowing_history_label') }}</p>
                    <h3>{{ __('app.borrowing_data_title') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.borrowing_index_desc') }}
                    </p>
                </div>

                <a href="{{ route('borrowings.create') }}" class="gsm-button-primary">
                    {{ __('app.add_borrowing') }}
                </a>
            </div>

            <div class="gsm-table-wrapper mt-6">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.borrower_name') }}</th>
                            <th>{{ __('app.division') }}</th>
                            <th>{{ __('app.borrow_date') }}</th>
                            <th>{{ __('app.due_date') }}</th>
                            <th>{{ __('app.return_date') }}</th>
                            <th>{{ __('app.status') }}</th>
                            <th>{{ __('app.actions') }}</th>
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
                                                {{ $borrowing->details->count() }} {{ __('app.item_detail') }}
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
                                            {{ __('app.overdue') }}
                                        </span>
                                    @elseif($borrowing->display_status === 'borrowed')
                                        <span class="gsm-badge warning">
                                            {{ __('app.borrowed') }}
                                        </span>
                                    @else
                                        <span class="gsm-badge success">
                                            {{ __('app.returned') }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="gsm-action-group">
                                        <a href="{{ route('borrowings.show', $borrowing) }}" class="gsm-action-link view">
                                            {{ __('app.detail') }}
                                        </a>

                                        @if($borrowing->status === 'borrowed')
                                            <a href="{{ route('borrowings.return.form', $borrowing) }}" class="gsm-action-link edit">
                                                {{ __('app.return_item') }}
                                            </a>
                                        @endif

                                        <form id="delete-borrowing-{{ $borrowing->id }}" action="{{ route('borrowings.destroy', $borrowing) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="openConfirmModal(@js(__('app.delete_borrowing_confirmation')), 'delete-borrowing-{{ $borrowing->id }}')"
                                                class="gsm-action-link delete"
                                            >
                                                {{ __('app.delete') }}
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
                                            <p class="font-bold">{{ __('app.no_borrowing_data') }}</p>
                                            <p class="text-sm mt-1">
                                                {{ __('app.add_borrowing_hint') }}
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

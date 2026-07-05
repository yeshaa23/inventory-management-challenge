<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.borrowing') }}</p>
            <h2>{{ __('app.borrowing_detail') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.borrowing_detail') }}</p>
                    <h3>{{ $borrowing->borrower_name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.borrow_detail_desc') }}
                    </p>
                </div>

                <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                    {{ __('app.back') }}
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1">
                    <div class="gsm-helper-card static">
                        <div class="gsm-helper-icon">↔</div>

                        <h4>{{ __('app.borrower_information') }}</h4>

                        <div class="mt-5 space-y-4">
                            <div class="gsm-preview-box">
                                <p>{{ __('app.borrower_name') }}</p>
                                <strong>{{ $borrowing->borrower_name }}</strong>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('app.division') }}</p>
                                <p class="font-bold text-slate-900 mt-1">{{ $borrowing->division ?? '-' }}</p>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">{{ __('app.status') }}</p>
                                <div class="mt-2">
                                    @if($borrowing->display_status === 'overdue')
                                        <span class="gsm-badge danger">{{ __('app.overdue') }}</span>
                                    @elseif($borrowing->display_status === 'borrowed')
                                        <span class="gsm-badge warning">{{ __('app.borrowed') }}</span>
                                    @else
                                        <span class="gsm-badge success">{{ __('app.returned') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="gsm-panel !shadow-none !p-0 !border-0">
                        <div class="gsm-table-wrapper">
                            <table class="gsm-table">
                                <tbody>
                                    <tr>
                                        <td class="font-bold">{{ __('app.borrow_date') }}</td>
                                        <td>{{ $borrowing->borrow_date?->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">{{ __('app.due_date') }}</td>
                                        <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">{{ __('app.return_date') }}</td>
                                        <td>{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">{{ __('app.return_condition') }}</td>
                                        <td>
                                        @if($borrowing->return_condition === 'Baik')
                                                                                    {{ __('app.good') }}
                                                                                @elseif($borrowing->return_condition === 'Rusak Ringan')
                                                                                    {{ __('app.minor_damage') }}
                                                                                @elseif($borrowing->return_condition === 'Rusak Berat')
                                                                                    {{ __('app.major_damage') }}
                                                                                @else
                                                                                    -
                                                                                @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">{{ __('app.return_note') }}</td>
                                        <td>{{ $borrowing->return_note ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <div class="gsm-panel-header mb-4">
                            <div>
                                <p class="gsm-eyebrow">{{ __('app.borrowed_item') }}</p>
                                <h3>{{ __('app.borrowed_items') }}</h3>
                            </div>
                        </div>

                        <div class="gsm-table-wrapper">
                            <table class="gsm-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('app.code') }}</th>
                                        <th>{{ __('app.product_name') }}</th>
                                        <th>{{ __('app.quantity') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($borrowing->details as $detail)
                                        <tr>
                                            <td class="font-bold text-slate-900">{{ $detail->product->code ?? '-' }}</td>
                                            <td>{{ $detail->product->name ?? '-' }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($borrowing->status === 'borrowed')
                        <div class="gsm-form-actions">
                            <a href="{{ route('borrowings.return.form', $borrowing) }}" class="gsm-button-primary">
                                {{ __('app.return_item') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

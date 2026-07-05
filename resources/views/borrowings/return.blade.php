<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.borrowing') }}</p>
            <h2>{{ __('app.return_item') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.return_process') }}</p>
                    <h3>{{ __('app.return_item_form') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.return_form_desc') }}
                    </p>
                </div>

                <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                    {{ __('app.back') }}
                </a>
            </div>

            <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="gsm-form-layout">
                @csrf
                @method('PATCH')

                <div class="gsm-form-main">
                    <div class="gsm-panel !shadow-none !p-0 !border-0 mb-6">
                        <div class="gsm-table-wrapper">
                            <table class="gsm-table">
                                <tbody>
                                    <tr>
                                        <td class="font-bold">{{ __('app.borrower_name') }}</td>
                                        <td>{{ $borrowing->borrower_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">{{ __('app.division') }}</td>
                                        <td>{{ $borrowing->division ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">{{ __('app.borrow_date') }}</td>
                                        <td>{{ $borrowing->borrow_date?->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold">{{ __('app.due_date') }}</td>
                                        <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="gsm-table-wrapper mb-6">
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

                    <div class="gsm-form-grid">
                        <div class="gsm-field gsm-field-full">
                            <label for="return_condition">{{ __('app.return_condition') }}</label>

                            <select name="return_condition" id="return_condition">
                                <option value="">{{ __('app.choose_condition') }}</option>
                                <option value="Baik" {{ old('return_condition') == 'Baik' ? 'selected' : '' }}>{{ __('app.good') }}</option>
                                <option value="Rusak Ringan" {{ old('return_condition') == 'Rusak Ringan' ? 'selected' : '' }}>{{ __('app.minor_damage') }}</option>
                                <option value="Rusak Berat" {{ old('return_condition') == 'Rusak Berat' ? 'selected' : '' }}>{{ __('app.major_damage') }}</option>
                            </select>

                            @error('return_condition')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label for="return_note">{{ __('app.return_note') }}</label>

                            <textarea
                                name="return_note"
                                id="return_note"
                                rows="5"
                                placeholder="{{ __('app.return_note_placeholder') }}"
                            >{{ old('return_note') }}</textarea>

                            @error('return_note')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            {{ __('app.save_return') }}
                        </button>

                        <a href="{{ route('borrowings.index') }}" class="gsm-button-secondary">
                            {{ __('app.cancel') }}
                        </a>
                    </div>
                </div>

                <aside class="gsm-helper-card">
                    <div class="gsm-helper-icon">✓</div>

                    <h4>{{ __('app.return_checklist') }}</h4>

                    <div class="gsm-preview-box">
                        <p>{{ __('app.status') }}</p>
                        <strong>{{ __('app.borrowed') }}</strong>
                    </div>

                    <ul>
                        <li>{{ __('app.return_tip_1') }}</li>
                        <li>{{ __('app.return_tip_2') }}</li>
                        <li>{{ __('app.return_tip_3') }}</li>
                    </ul>
                </aside>
            </form>
        </section>
    </div>
</x-app-layout>

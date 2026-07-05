<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.master_data') }}</p>
            <h2>{{ __('app.add_category') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-form-layout">
            <div class="gsm-panel gsm-form-main">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.category_form') }}</p>
                        <h3>{{ __('app.add_category_form') }}</h3>
                        <p class="text-sm text-slate-500 mt-1">
                            {{ __('app.add_category_desc') }}
                        </p>
                    </div>
                </div>

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="gsm-form-grid">
                        <div class="gsm-field gsm-field-full">
                            <label>{{ __('app.category_name') }}</label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="{{ __('app.category_tip_2') }}"
                            >

                            @error('name')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label>{{ __('app.description') }}</label>

                            <textarea
                                name="description"
                                rows="5"
                                placeholder="{{ __('app.description_category') }}"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            {{ __('app.save_category') }}
                        </button>

                        <a href="{{ route('categories.index') }}" class="gsm-button-secondary">
                            {{ __('app.back') }}
                        </a>
                    </div>
                </form>
            </div>

            <aside class="gsm-helper-card">
                <div class="gsm-helper-icon">▦</div>

                <h4>{{ __('app.category_tips') }}</h4>

                <ul>
                    <li>{{ __('app.category_tip_1') }}</li>
                    <li>{{ __('app.category_tip_2') }}</li>
                    <li>{{ __('app.category_tip_3') }}</li>
                </ul>
            </aside>
        </section>
    </div>
</x-app-layout>

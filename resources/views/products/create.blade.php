<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.master_data') }}</p>
            <h2>{{ __('app.add_product') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.new_inventory_item') }}</p>
                    <h3>{{ __('app.product_form_add') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.product_form_desc') }}
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                    {{ __('app.back') }}
                </a>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="gsm-form-layout">
                @csrf

                <div class="gsm-form-main">
                    <div class="gsm-form-grid">
                        <div class="gsm-field">
                            <label for="code">{{ __('app.product_code') }}</label>

                            <input
                                type="text"
                                name="code"
                                id="code"
                                value="{{ old('code') }}"
                                placeholder="{{ __('app.choose_category_auto_code') }}"
                                readonly
                            >

                            <small>{{ __('app.auto_code_desc') }}</small>

                            @error('code')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="name">{{ __('app.product_name') }}</label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="{{ __('app.example_laptop') }}"
                            >

                            @error('name')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="category_id">{{ __('app.category') }}</label>

                            <select name="category_id" id="category_id">
                                <option value="">{{ __('app.choose_category') }}</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="stock">{{ __('app.stock') }}</label>

                            <input
                                type="number"
                                name="stock"
                                id="stock"
                                value="{{ old('stock', 0) }}"
                                min="0"
                                placeholder="0"
                            >

                            @error('stock')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="location_select">{{ __('app.storage_location') }}</label>

                            @php
                                $defaultLocations = [
                                    'Gudang Utama',
                                    'Ruang IT',
                                    'Ruang Administrasi',
                                    'Ruang Meeting',
                                    'Kantor Cabang',
                                ];

                                $allLocations = collect($locations)
                                    ->merge($defaultLocations)
                                    ->filter()
                                    ->unique()
                                    ->values();
                            @endphp

                            <select name="location_select" id="location_select">
                                <option value="">{{ __('app.choose_location') }}</option>

                                @foreach($allLocations as $location)
                                    <option value="{{ $location }}" {{ old('location_select') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach

                                <option value="other" {{ old('location_select') == 'other' ? 'selected' : '' }}>
                                    {{ __('app.other_location') }}
                                </option>
                            </select>

                            @error('location_select')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror

                            <div id="location_other_wrapper" class="gsm-nested-field hidden">
                                <label for="location_other">{{ __('app.new_location') }}</label>

                                <input
                                    type="text"
                                    name="location_other"
                                    id="location_other"
                                    value="{{ old('location_other') }}"
                                    placeholder="{{ __('app.example_branch_warehouse') }}"
                                >

                                @error('location_other')
                                    <p class="gsm-error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="gsm-field">
                            <label for="condition">{{ __('app.product_condition') }}</label>

                            <select name="condition" id="condition">
                                <option value="">{{ __('app.choose_condition') }}</option>
                                <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>{{ __('app.good') }}</option>
                                <option value="Rusak Ringan" {{ old('condition') == 'Rusak Ringan' ? 'selected' : '' }}>{{ __('app.minor_damage') }}</option>
                                <option value="Rusak Berat" {{ old('condition') == 'Rusak Berat' ? 'selected' : '' }}>{{ __('app.major_damage') }}</option>
                            </select>

                            @error('condition')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label for="image">{{ __('app.upload_product_image') }}</label>

                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept="image/png, image/jpeg, image/jpg"
                            >

                            <small>{{ __('app.image_format_help') }}</small>

                            @error('image')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button type="submit" class="gsm-button-primary">
                            {{ __('app.save_product') }}
                        </button>

                        <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                            {{ __('app.cancel') }}
                        </a>
                    </div>
                </div>

                <aside class="gsm-helper-card">
                    <div class="gsm-helper-icon">◈</div>

                    <h4>{{ __('app.preview_product_data') }}</h4>

                    <div class="gsm-preview-box">
                        <p>{{ __('app.product_code') }}</p>
                        <strong id="preview-code">{{ __('app.code_not_generated') }}</strong>
                    </div>

                    <ul>
                        <li>{{ __('app.choose_category_auto_code') }}.</li>
                        <li>{{ __('app.product_create_tip_2') }}</li>
                        <li>{{ __('app.product_create_tip_3') }}</li>
                    </ul>
                </aside>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category_id');
            const codeInput = document.getElementById('code');
            const previewCode = document.getElementById('preview-code');

            async function generateCode(categoryId) {
                if (!codeInput || !previewCode) {
                    return;
                }

                if (!categoryId) {
                    codeInput.value = '';
                    codeInput.placeholder = @json(__('app.choose_category_auto_code'));
                    previewCode.textContent = @json(__('app.code_not_generated'));
                    return;
                }

                codeInput.value = @json(__('app.creating_code'));
                previewCode.textContent = @json(__('app.creating_code'));

                try {
                    const response = await fetch(`{{ route('products.generate-code') }}?category_id=${categoryId}`);
                    const data = await response.json();

                    if (data.code) {
                        codeInput.value = data.code;
                        previewCode.textContent = data.code;
                    } else {
                        codeInput.value = '';
                        codeInput.placeholder = @json(__('app.code_generation_failed'));
                        previewCode.textContent = @json(__('app.code_generation_failed'));
                    }
                } catch (error) {
                    codeInput.value = '';
                    codeInput.placeholder = @json(__('app.code_creation_error'));
                    previewCode.textContent = @json(__('app.code_generation_failed'));
                }
            }

            if (categorySelect) {
                categorySelect.addEventListener('change', function () {
                    generateCode(this.value);
                });

                if (categorySelect.value) {
                    generateCode(categorySelect.value);
                }
            }

            const locationSelect = document.getElementById('location_select');
            const locationOtherWrapper = document.getElementById('location_other_wrapper');
            const locationOtherInput = document.getElementById('location_other');

            function toggleLocationOther() {
                if (!locationSelect || !locationOtherWrapper || !locationOtherInput) {
                    return;
                }

                const shouldShowOtherField = locationSelect.value === 'other';

                locationOtherWrapper.classList.toggle('hidden', !shouldShowOtherField);

                if (shouldShowOtherField) {
                    locationOtherInput.setAttribute('required', 'required');
                } else {
                    locationOtherInput.removeAttribute('required');
                    locationOtherInput.value = '';
                }
            }

            if (locationSelect) {
                locationSelect.addEventListener('change', toggleLocationOther);
                toggleLocationOther();
            }
        });
    </script>
</x-app-layout>

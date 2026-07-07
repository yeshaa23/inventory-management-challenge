<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.master_data') }}</p>
            <h2>{{ __('app.edit_product') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.update_inventory_item') }}</p>
                    <h3>{{ __('app.product_form_edit') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.product_edit_desc') }}
                    </p>
                </div>

                <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                    {{ __('app.back') }}
                </a>
            </div>

            <form
                action="{{ route('products.update', $product) }}"
                method="POST"
                enctype="multipart/form-data"
                class="gsm-form-layout"
            >
                @csrf
                @method('PUT')

                <div class="gsm-form-main">
                    <div class="gsm-form-grid">
                        <div class="gsm-field">
                            <label for="code">{{ __('app.product_code') }}</label>

                            <input
                                type="text"
                                name="code"
                                id="code"
                                value="{{ old('code', $product->code) }}"
                            >

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
                                value="{{ old('name', $product->name) }}"
                                placeholder="{{ __('app.example_laptop') }}"
                            >

                            @error('name')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gsm-field">
                            <label for="category_id">{{ __('app.category') }}</label>

                            <select name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
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
                                    ->unique()
                                    ->values();

                                $isCustomLocation = ! $allLocations->contains($product->location);
                            @endphp

                            <select name="location_select" id="location_select">
                                <option value="">{{ __('app.choose_location') }}</option>

                                @foreach($allLocations as $location)
                                    <option
                                        value="{{ $location }}"
                                        {{ old('location_select', $isCustomLocation ? 'other' : $product->location) == $location ? 'selected' : '' }}
                                    >
                                        {{ $location }}
                                    </option>
                                @endforeach

                                <option
                                    value="other"
                                    {{ old('location_select', $isCustomLocation ? 'other' : $product->location) == 'other' ? 'selected' : '' }}
                                >
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
                                    value="{{ old('location_other', $isCustomLocation ? $product->location : '') }}"
                                    placeholder="{{ __('app.example_branch_warehouse') }}"
                                >

                                @error('location_other')
                                    <p class="gsm-error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label>{{ __('app.stock_by_condition') }}</label>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="good_stock" class="text-xs font-bold text-slate-500 uppercase tracking-[0.16em]">
                                        {{ __('app.good_stock') }}
                                    </label>

                                    <input
                                        type="number"
                                        name="good_stock"
                                        id="good_stock"
                                        value="{{ old('good_stock', $product->good_stock) }}"
                                        min="0"
                                        placeholder="0"
                                    >

                                    @error('good_stock')
                                        <p class="gsm-error-text">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="minor_damage_stock" class="text-xs font-bold text-slate-500 uppercase tracking-[0.16em]">
                                        {{ __('app.minor_damage_stock') }}
                                    </label>

                                    <input
                                        type="number"
                                        name="minor_damage_stock"
                                        id="minor_damage_stock"
                                        value="{{ old('minor_damage_stock', $product->minor_damage_stock) }}"
                                        min="0"
                                        placeholder="0"
                                    >

                                    @error('minor_damage_stock')
                                        <p class="gsm-error-text">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="major_damage_stock" class="text-xs font-bold text-slate-500 uppercase tracking-[0.16em]">
                                        {{ __('app.major_damage_stock') }}
                                    </label>

                                    <input
                                        type="number"
                                        name="major_damage_stock"
                                        id="major_damage_stock"
                                        value="{{ old('major_damage_stock', $product->major_damage_stock) }}"
                                        min="0"
                                        placeholder="0"
                                    >

                                    @error('major_damage_stock')
                                        <p class="gsm-error-text">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <small>{{ __('app.stock_condition_help') }}</small>
                        </div>

                        <div class="gsm-field gsm-field-full">
                            <label for="image">{{ __('app.product_image') }}</label>

                            <div class="mb-3">
                                <img
                                    id="product-image-preview"
                                    src="{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                                    alt="{{ $product->name }}"
                                    class="w-32 h-32 object-cover rounded-3xl border border-slate-200 {{ $product->image ? '' : 'hidden' }}"
                                >
                            </div>

                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept="image/png, image/jpeg, image/jpg, image/webp"
                            >

                            <small>{{ __('app.update_image_hint') }}</small>

                            @error('image')
                                <p class="gsm-error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="gsm-form-actions">
                        <button class="gsm-button-primary">
                            {{ __('app.update_product') }}
                        </button>

                        <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                            {{ __('app.cancel') }}
                        </a>
                    </div>
                </div>

                <aside class="gsm-helper-card">
                    <div class="gsm-helper-icon">◈</div>

                    <h4>{{ __('app.product_summary') }}</h4>

                    <div class="gsm-preview-box">
                        <p>{{ __('app.product_code') }}</p>
                        <strong>{{ $product->code }}</strong>
                    </div>

                    <div class="gsm-preview-box">
                        <p>{{ __('app.total_stock') }}</p>
                        <strong id="preview-total-stock">{{ $product->stock }}</strong>
                    </div>

                    <ul>
                        <li>{{ __('app.product_edit_tip_1') }}</li>
                        <li>{{ __('app.product_edit_tip_2') }}</li>
                        <li>{{ __('app.stock_condition_tip') }}</li>
                    </ul>
                </aside>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const locationSelect = document.getElementById('location_select');
            const locationOtherWrapper = document.getElementById('location_other_wrapper');
            const locationOtherInput = document.getElementById('location_other');

            function toggleLocationOther() {
                if (!locationSelect || !locationOtherWrapper || !locationOtherInput) {
                    return;
                }

                if (locationSelect.value === 'other') {
                    locationOtherWrapper.classList.remove('hidden');
                    locationOtherInput.setAttribute('required', 'required');
                } else {
                    locationOtherWrapper.classList.add('hidden');
                    locationOtherInput.removeAttribute('required');
                }
            }

            if (locationSelect) {
                locationSelect.addEventListener('change', toggleLocationOther);
                toggleLocationOther();
            }

            const stockInputs = [
                document.getElementById('good_stock'),
                document.getElementById('minor_damage_stock'),
                document.getElementById('major_damage_stock'),
            ];
            const previewTotalStock = document.getElementById('preview-total-stock');

            function updateTotalStockPreview() {
                const total = stockInputs.reduce(function (sum, input) {
                    return sum + Number(input?.value || 0);
                }, 0);

                if (previewTotalStock) {
                    previewTotalStock.textContent = total;
                }
            }

            stockInputs.forEach(function (input) {
                if (input) {
                    input.addEventListener('input', updateTotalStockPreview);
                }
            });

            updateTotalStockPreview();

            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('product-image-preview');

            if (imageInput && imagePreview) {
                imageInput.addEventListener('change', function () {
                    const file = this.files && this.files[0];

                    if (!file) {
                        return;
                    }

                    const previewUrl = URL.createObjectURL(file);

                    imagePreview.src = previewUrl;
                    imagePreview.classList.remove('hidden');

                    imagePreview.onload = function () {
                        URL.revokeObjectURL(previewUrl);
                    };
                });
            }
        });
    </script>
</x-app-layout>

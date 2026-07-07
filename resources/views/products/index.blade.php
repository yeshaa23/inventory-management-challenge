<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.master_data') }}</p>
            <h2>{{ __('app.product_data') }}</h2>
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

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.inventory_items') }}</p>
                    <h3>{{ __('app.product_data') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.product_index_desc') }}
                    </p>
                </div>

                <a href="{{ route('products.create') }}" class="gsm-button-primary">
                    {{ __('app.add_product') }}
                </a>
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="gsm-filter-card">
                <div>
                    <label>{{ __('app.search_product') }}</label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('app.search_products_placeholder') }}"
                    >
                </div>

                <div>
                    <label>{{ __('app.category') }}</label>

                    <select name="category_id">
                        <option value="">{{ __('app.all_categories') }}</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>{{ __('app.condition') }}</label>

                    <select name="condition">
                        <option value="">{{ __('app.all_conditions') }}</option>
                        <option value="Baik" {{ request('condition') == 'Baik' ? 'selected' : '' }}>{{ __('app.good') }}</option>
                        <option value="Rusak Ringan" {{ request('condition') == 'Rusak Ringan' ? 'selected' : '' }}>{{ __('app.minor_damage') }}</option>
                        <option value="Rusak Berat" {{ request('condition') == 'Rusak Berat' ? 'selected' : '' }}>{{ __('app.major_damage') }}</option>
                    </select>
                </div>

                <div>
                    <label>{{ __('app.location') }}</label>

                    <select name="location">
                        <option value="">{{ __('app.all_locations') }}</option>

                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                {{ $location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>{{ __('app.status_stock') }}</label>

                    <select name="stock_status">
                        <option value="">{{ __('app.all_statuses') }}</option>
                        <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>{{ __('app.available') }}</option>
                        <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>{{ __('app.low_stock') }}</option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>{{ __('app.out_of_stock') }}</option>
                        <option value="damaged" {{ request('stock_status') == 'damaged' ? 'selected' : '' }}>{{ __('app.damaged_products') }}</option>
                    </select>
                </div>

                <div>
                    <label>{{ __('app.sort_by') }}</label>

                    <select name="sort">
                        <option value="">{{ __('app.newest') }}</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>{{ __('app.name_az') }}</option>
                        <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>{{ __('app.lowest_stock') }}</option>
                        <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>{{ __('app.highest_stock') }}</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('app.oldest') }}</option>
                    </select>
                </div>

                <div class="gsm-filter-actions">
                    <button class="gsm-button-primary">
                        {{ __('app.filter') }}
                    </button>

                    <a href="{{ route('products.index') }}" class="gsm-button-secondary">
                        {{ __('app.reset') }}
                    </a>
                </div>
            </form>

            <div class="gsm-table-wrapper mt-6">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.code') }}</th>
                            <th>{{ __('app.product_name') }}</th>
                            <th>{{ __('app.category') }}</th>
                            <th>{{ __('app.total_stock') }}</th>
                            <th>{{ __('app.good') }}</th>
                            <th>{{ __('app.minor_damage_short') }}</th>
                            <th>{{ __('app.major_damage_short') }}</th>
                            <th>{{ __('app.location') }}</th>
                            <th>{{ __('app.status') }}</th>
                            <th>{{ __('app.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <span class="font-bold text-slate-900">
                                        {{ $product->code }}
                                    </span>
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        @if($product->image)
                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-10 h-10 rounded-xl object-cover"
                                            >
                                        @else
                                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 grid place-items-center font-bold">
                                                {{ strtoupper(substr($product->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-bold text-slate-900">
                                                {{ $product->name }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                {{ $product->created_at?->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $product->category->name ?? '-' }}</td>

                                <td>
                                    <span class="font-bold">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                <td>
                                    <span class="gsm-badge success">
                                        {{ $product->good_stock }}
                                    </span>
                                </td>

                                <td>
                                    <span class="gsm-badge warning">
                                        {{ $product->minor_damage_stock }}
                                    </span>
                                </td>

                                <td>
                                    <span class="gsm-badge danger">
                                        {{ $product->major_damage_stock }}
                                    </span>
                                </td>

                                <td>{{ $product->location }}</td>

                                <td>
                                    @if($product->stock_status === 'available')
                                        <span class="gsm-badge success">
                                            {{ __('app.' . $product->stock_status) }}
                                        </span>
                                    @elseif($product->stock_status === 'low_stock')
                                        <span class="gsm-badge warning">
                                            {{ __('app.' . $product->stock_status) }}
                                        </span>
                                    @elseif($product->stock_status === 'out_of_stock')
                                        <span class="gsm-badge danger">
                                            {{ __('app.' . $product->stock_status) }}
                                        </span>
                                    @else
                                        <span class="gsm-badge info">
                                            {{ __('app.' . $product->stock_status) }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="gsm-action-group">
                                        <a href="{{ route('products.show', $product) }}" class="gsm-action-link view">
                                            {{ __('app.detail') }}
                                        </a>

                                        <a href="{{ route('products.edit', $product) }}" class="gsm-action-link edit">
                                            {{ __('app.edit') }}
                                        </a>

                                        <form id="delete-product-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="openConfirmModal('{{ __('app.confirm_delete_product') }}', 'delete-product-{{ $product->id }}')"
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
                                <td colspan="10">
                                    <div class="gsm-empty-state">
                                        <div>
                                            <p class="font-bold">{{ __('app.no_product_data') }}</p>
                                            <p class="text-sm mt-1">
                                                {{ __('app.start_product_hint') }}
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
                {{ $products->links() }}
            </div>
        </section>
    </div>
</x-app-layout>

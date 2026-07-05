<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.master_data') }}</p>
            <h2>{{ __('app.category_detail') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.category_detail') }}</p>
                    <h3>{{ $category->name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.category_detail_desc') }}
                    </p>
                </div>

                <div class="gsm-action-group">
                    <a href="{{ route('categories.edit', $category) }}" class="gsm-action-link edit">
                        {{ __('app.edit') }}
                    </a>

                    <a href="{{ route('categories.index') }}" class="gsm-action-link view">
                        {{ __('app.back') }}
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="gsm-detail-card">
                    <span>{{ __('app.category_name') }}</span>
                    <strong>{{ $category->name }}</strong>
                </div>

                <div class="gsm-detail-card">
                    <span>{{ __('app.product_count') }}</span>
                    <strong>{{ $category->products()->count() }}</strong>
                </div>

                <div class="gsm-detail-card">
                    <span>{{ __('app.created_date') }}</span>
                    <strong>{{ $category->created_at?->format('d M Y') }}</strong>
                </div>
            </div>

            <div class="gsm-panel mt-6 shadow-none">
                <p class="gsm-eyebrow">{{ __('app.description') }}</p>
                <h3 class="text-xl font-bold text-slate-900 mb-3">{{ __('app.description_category') }}</h3>
                <p class="text-slate-600 leading-relaxed">
                    {{ $category->description ?? '{{ __('app.no_category_description') }}' }}
                </p>
            </div>
        </section>
    </div>
</x-app-layout>

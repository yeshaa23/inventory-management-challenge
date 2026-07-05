<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.master_data') }}</p>
            <h2>{{ __('app.category_data') }}</h2>
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
                    <p class="gsm-eyebrow">{{ __('app.category_management') }}</p>
                    <h3>{{ __('app.category_master_data') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.category_desc') }}
                    </p>
                </div>

                <a href="{{ route('categories.create') }}" class="gsm-button-primary">
                    {{ __('app.add_category') }}
                </a>
            </div>

            <div class="gsm-table-wrapper mt-6">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>{{ __('app.category_name') }}</th>
                            <th>{{ __('app.description') }}</th>
                            <th>{{ __('app.product_count') }}</th>
                            <th>{{ __('app.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <span class="font-bold text-slate-900">
                                        {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                                    </span>
                                </td>

                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 grid place-items-center font-bold">
                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="font-bold text-slate-900">
                                                {{ $category->name }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                {{ __('app.created_on') }} {{ $category->created_at?->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    {{ $category->description ?? '-' }}
                                </td>

                                <td>
                                    <span class="gsm-badge info">
                                        {{ $category->products()->count() }} {{ __('app.products') }}
                                    </span>
                                </td>

                                <td>
                                    <div class="gsm-action-group">
                                        <a href="{{ route('categories.show', $category) }}" class="gsm-action-link view">
                                            {{ __('app.detail') }}
                                        </a>

                                        <a href="{{ route('categories.edit', $category) }}" class="gsm-action-link edit">
                                            {{ __('app.edit') }}
                                        </a>

                                        <form id="delete-category-{{ $category->id }}" action="{{ route('categories.destroy', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="openConfirmModal('{{ __('app.confirm_delete_category') }}', 'delete-category-{{ $category->id }}')"
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
                                <td colspan="5">
                                    <div class="gsm-empty-state">
                                        <div>
                                            <p class="font-bold">{{ __('app.no_category_data') }}</p>
                                            <p class="text-sm mt-1">
                                                {{ __('app.start_category_hint') }}
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
                {{ $categories->links() }}
            </div>
        </section>
    </div>
</x-app-layout>

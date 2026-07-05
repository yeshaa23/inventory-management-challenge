<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.reporting_center') }}</p>
            <h2>{{ __('app.inventory_report_title') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-panel">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-stretch">
                <div class="xl:col-span-2 rounded-[30px] p-8 bg-slate-950 text-white overflow-hidden relative">
                    <div class="absolute -right-24 -top-24 w-72 h-72 rounded-full bg-red-600/30"></div>
                    <div class="absolute right-20 -bottom-32 w-72 h-72 rounded-full bg-white/10"></div>

                    <div class="relative z-10">
                        <span class="gsm-hero-badge">{{ __('app.report_workspace') }}</span>

                        <h1 class="text-4xl md:text-5xl font-black tracking-tight leading-tight max-w-3xl">
                            {{ __('app.report_hero_title') }}
                        </h1>

                        <p class="mt-5 text-slate-300 leading-8 max-w-2xl">
                            {{ __('app.report_hero_desc') }}
                        </p>
                    </div>
                </div>

                <div class="rounded-[30px] p-6 bg-red-50 border border-red-100 flex flex-col justify-between">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.export') }}</p>
                        <h3 class="text-2xl font-black text-slate-900">{{ __('app.download_report') }}</h3>
                        <p class="mt-2 text-sm text-slate-500 leading-6">
                            {{ __('app.download_report_desc') }}
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-3">
                        <a href="{{ route('reports.products.pdf') }}" class="gsm-button-primary w-full">
                            {{ __('app.pdf_product_data') }}
                        </a>

                        <a href="{{ route('reports.borrowings.pdf') }}" class="gsm-button-secondary w-full">
                            {{ __('app.pdf_borrowings') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="gsm-detail-card">
                <span>{{ __('app.total_product_types') }}</span>
                <strong>{{ $totalProducts }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>{{ __('app.total_stock') }}</span>
                <strong>{{ $totalStock }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>{{ __('app.total_transactions') }}</span>
                <strong>{{ $totalBorrowings }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>{{ __('app.borrowed_items') }}</span>
                <strong>{{ $totalBorrowedItems }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>{{ __('app.low_stock') }}</span>
                <strong>{{ $lowStockProducts->count() }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>{{ __('app.out_of_stock_title') }}</span>
                <strong>{{ $outOfStockProducts->count() }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>{{ __('app.damaged_products') }}</span>
                <strong>{{ $damagedProducts->count() }}</strong>
            </div>

            <div class="gsm-detail-card">
                <span>{{ __('app.overdue') }}</span>
                <strong>{{ $overdueBorrowings->count() }}</strong>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.download_center') }}</p>
                    <h3>{{ __('app.export_report') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.export_report_desc') }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div class="rounded-[26px] border border-slate-200 bg-slate-50 p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="gsm-eyebrow">{{ __('app.inventory_report') }}</p>
                            <h4 class="text-xl font-black text-slate-900">{{ __('app.product_report') }}</h4>
                            <p class="mt-2 text-sm text-slate-500 leading-6">
                                {{ __('app.product_report_desc') }}
                            </p>
                        </div>

                        <div class="gsm-stat-icon red">▦</div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-2">
                        <a href="{{ route('reports.products.pdf') }}" class="gsm-button-primary">PDF</a>
                        <a href="{{ route('reports.products.excel') }}" class="gsm-button-secondary">Excel</a>
                        <a href="{{ route('reports.products.csv') }}" class="gsm-button-secondary">CSV</a>
                    </div>
                </div>

                <div class="rounded-[26px] border border-slate-200 bg-slate-50 p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="gsm-eyebrow">{{ __('app.borrowing_report_label') }}</p>
                            <h4 class="text-xl font-black text-slate-900">{{ __('app.borrowing_report') }}</h4>
                            <p class="mt-2 text-sm text-slate-500 leading-6">
                                {{ __('app.borrowing_report_desc') }}
                            </p>
                        </div>

                        <div class="gsm-stat-icon yellow">↔</div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-2">
                        <a href="{{ route('reports.borrowings.pdf') }}" class="gsm-button-primary">PDF</a>
                        <a href="{{ route('reports.borrowings.excel') }}" class="gsm-button-secondary">Excel</a>
                        <a href="{{ route('reports.borrowings.csv') }}" class="gsm-button-secondary">CSV</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.inventory_data') }}</p>
                    <h3>{{ __('app.product_report') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.product_total_desc', ['count' => $products->count()]) }}
                    </p>
                </div>
            </div>

            <div class="gsm-table-wrapper">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.code') }}</th>
                            <th>{{ __('app.product_name') }}</th>
                            <th>{{ __('app.category') }}</th>
                            <th>{{ __('app.stock') }}</th>
                            <th>{{ __('app.location') }}</th>
                            <th>{{ __('app.condition') }}</th>
                            <th>{{ __('app.status') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="font-bold text-slate-900">{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td class="font-bold">{{ $product->stock }}</td>
                                <td>{{ $product->location }}</td>
                                <td>
                                @if($product->condition === 'Baik')
                                                                    {{ __('app.good') }}
                                                                @elseif($product->condition === 'Rusak Ringan')
                                                                    {{ __('app.minor_damage') }}
                                                                @else
                                                                    {{ __('app.major_damage') }}
                                                                @endif
                                </td>
                                <td>
                                    @if($product->stock_status === 'available')
                                        <span class="gsm-badge success">{{ __('app.' . $product->stock_status) }}</span>
                                    @elseif($product->stock_status === 'low_stock')
                                        <span class="gsm-badge warning">{{ __('app.' . $product->stock_status) }}</span>
                                    @elseif($product->stock_status === 'out_of_stock')
                                        <span class="gsm-badge danger">{{ __('app.' . $product->stock_status) }}</span>
                                    @else
                                        <span class="gsm-badge info">{{ __('app.' . $product->stock_status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="gsm-empty-state small">
                                        {{ __('app.no_product_data') }}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="gsm-panel">
            <div class="gsm-panel-header">
                <div>
                    <p class="gsm-eyebrow">{{ __('app.borrowings_data') }}</p>
                    <h3>{{ __('app.borrowing_history_report') }}</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        {{ __('app.borrowing_total_desc', ['count' => $borrowings->count()]) }}
                    </p>
                </div>
            </div>

            <div class="gsm-table-wrapper">
                <table class="gsm-table">
                    <thead>
                        <tr>
                            <th>{{ __('app.borrower_name') }}</th>
                            <th>{{ __('app.division') }}</th>
                            <th>{{ __('app.product') }}</th>
                            <th>{{ __('app.quantity') }}</th>
                            <th>{{ __('app.borrow_date') }}</th>
                            <th>{{ __('app.due_date') }}</th>
                            <th>{{ __('app.return_date') }}</th>
                            <th>{{ __('app.status') }}</th>
                            <th>{{ __('app.return_condition_short') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($borrowings as $borrowing)
                            @foreach($borrowing->details as $detail)
                                <tr>
                                    <td class="font-bold text-slate-900">{{ $borrowing->borrower_name }}</td>
                                    <td>{{ $borrowing->division ?? '-' }}</td>
                                    <td>{{ $detail->product->name ?? '-' }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $borrowing->borrow_date?->format('d M Y') }}</td>
                                    <td>{{ $borrowing->due_date?->format('d M Y') ?? '-' }}</td>
                                    <td>{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td>
                                    <td>
                                        @if($borrowing->display_status === 'overdue')
                                            <span class="gsm-badge danger">{{ __('app.overdue') }}</span>
                                        @elseif($borrowing->display_status === 'borrowed')
                                            <span class="gsm-badge warning">{{ __('app.borrowed') }}</span>
                                        @else
                                            <span class="gsm-badge success">{{ __('app.returned') }}</span>
                                        @endif
                                    </td>
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
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="gsm-empty-state small">
                                        {{ __('app.no_borrowing_data') }}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.low_stock_short') }}</p>
                        <h3>{{ __('app.low_stock_report') }}</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>{{ __('app.code') }}</th>
                                <th>{{ __('app.product_name') }}</th>
                                <th>{{ __('app.stock') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($lowStockProducts as $product)
                                <tr>
                                    <td class="font-bold text-slate-900">{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <span class="gsm-badge warning">{{ $product->stock }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="gsm-empty-state small">
                                            {{ __('app.no_low_stock_products') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.overdue') }}</p>
                        <h3>{{ __('app.overdue_borrowing_report') }}</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>{{ __('app.borrower_name') }}</th>
                                <th>{{ __('app.division') }}</th>
                                <th>{{ __('app.due_date') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($overdueBorrowings as $borrowing)
                                <tr>
                                    <td class="font-bold text-slate-900">{{ $borrowing->borrower_name }}</td>
                                    <td>{{ $borrowing->division ?? '-' }}</td>
                                    <td>
                                        <span class="gsm-badge danger">{{ $borrowing->due_date?->format('d M Y') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="gsm-empty-state small">
                                            {{ __('app.no_overdue_borrowing_short') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

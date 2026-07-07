<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="gsm-eyebrow">{{ __('app.overview') }}</p>
            <h2>{{ __('app.inventory_dashboard') }}</h2>
        </div>
    </x-slot>

    <div class="gsm-dashboard">
        <section class="gsm-hero-card">
            <div>
                <span class="gsm-hero-badge">{{ __('app.inventory_center') }}</span>

                <h1>
                    {{ __('app.dashboard_hero_title') }}
                </h1>

                <p>
                    {{ __('app.dashboard_hero_desc') }}
                </p>

                <div class="gsm-hero-actions">
                    @if(auth()->user()->hasRole(['Admin', 'Staff']))
                        <a href="{{ route('products.create') }}" class="gsm-button-primary">
                            {{ __('app.add_product') }}
                        </a>

                        <a href="{{ route('borrowings.create') }}" class="gsm-button-white">
                            {{ __('app.add_borrowing') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="gsm-hero-visual">
                <div class="gsm-phone-card">
                    <div class="gsm-phone-top"></div>

                    <div class="gsm-phone-content">
                        <span>{{ __('app.total_stock') }}</span>
                        <strong>{{ $totalStock }}</strong>
                        <p>{{ $totalProducts }} {{ __('app.items_recorded') }}</p>
                    </div>

                    <div class="gsm-phone-mini-grid">
                        <div>
                            <span>{{ __('app.available_good_stock') }}</span>
                            <strong>{{ $availableStock }}</strong>
                        </div>

                        <div>
                            <span>{{ __('app.low_stock_short') }}</span>
                            <strong>{{ $lowStockProducts->count() }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($lowStockProducts->count() > 0 || $overdueBorrowings->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @if($lowStockProducts->count() > 0)
                    <div class="gsm-alert-card warning">
                        <div class="gsm-alert-icon">!</div>

                        <div>
                            <h3>{{ __('app.low_stock') }}</h3>
                            <p>
                                {{ __('app.low_stock_alert_desc', ['count' => $lowStockProducts->count()]) }}
                            </p>
                        </div>
                    </div>
                @endif

                @if($overdueBorrowings->count() > 0)
                    <div class="gsm-alert-card danger">
                        <div class="gsm-alert-icon">!</div>

                        <div>
                            <h3>{{ __('app.overdue_alert_title') }}</h3>
                            <p>
                                {{ __('app.overdue_alert_desc', ['count' => $overdueBorrowings->count()]) }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <section class="gsm-stat-grid">
            <div class="gsm-stat-card">
                <div class="gsm-stat-icon red">▦</div>
                <p>{{ __('app.total_product_types') }}</p>
                <h3>{{ $totalProducts }}</h3>
                <span>{{ __('app.item_master') }}</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon blue">◈</div>
                <p>{{ __('app.total_stock') }}</p>
                <h3>{{ $totalStock }}</h3>
                <span>{{ __('app.all_condition_units') }}</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon yellow">↔</div>
                <p>{{ __('app.borrowed_items') }}</p>
                <h3>{{ $borrowedItems }}</h3>
                <span>{{ __('app.still_active') }}</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon red">!</div>
                <p>{{ __('app.overdue_alert_title') }}</p>
                <h3>{{ $overdueBorrowings->count() }}</h3>
                <span>{{ __('app.needs_follow_up') }}</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon yellow">↓</div>
                <p>{{ __('app.low_stock') }}</p>
                <h3>{{ $lowStockProducts->count() }}</h3>
                <span>{{ __('app.stock_one_to_five') }}</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon dark">×</div>
                <p>{{ __('app.out_of_stock_title') }}</p>
                <h3>{{ $outOfStockProducts->count() }}</h3>
                <span>{{ __('app.needs_restock') }}</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon orange">⚠</div>
                <p>{{ __('app.damaged_stock') }}</p>
                <h3>{{ $damagedStock }}</h3>
                <span>{{ __('app.needs_checking') }}</span>
            </div>

            <div class="gsm-stat-card">
                <div class="gsm-stat-icon green">★</div>
                <p>{{ __('app.top_borrowed') }}</p>
                <h3>{{ $topBorrowedProducts->first()->total_borrowed ?? 0 }}</h3>
                <span>{{ __('app.highest_frequency') }}</span>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="gsm-panel xl:col-span-2">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.monthly_tracking') }}</p>
                        <h3>{{ __('app.monthly_borrowing_chart') }}</h3>
                    </div>
                </div>

                <div class="gsm-chart-wrapper">
                    <canvas id="borrowingChart"></canvas>
                </div>
            </div>

            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.most_used') }}</p>
                        <h3>{{ __('app.top_5_borrowed_products') }}</h3>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse($topBorrowedProducts as $product)
                        <div class="gsm-mini-list">
                            <div>
                                <strong>{{ $product->name }}</strong>
                                <span>{{ $product->code }}</span>
                            </div>

                            <p>{{ $product->total_borrowed }}x</p>
                        </div>
                    @empty
                        <div class="gsm-empty-state small">
                            {{ __('app.no_product_borrowing_data') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="gsm-panel">
                <div class="gsm-panel-header">
                    <div>
                        <p class="gsm-eyebrow">{{ __('app.category_summary') }}</p>
                        <h3>{{ __('app.products_per_category_summary') }}</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper gsm-dashboard-table-scroll">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>{{ __('app.category') }}</th>
                                <th>{{ __('app.product_types') }}</th>
                                <th>{{ __('app.total_stock') }}</th>
                                <th>{{ __('app.good_stock') }}</th>
                                <th>{{ __('app.damaged_stock') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($categorySummaries as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->total_product }}</td>
                                    <td>{{ $category->total_stock }}</td>
                                    <td>{{ $category->good_stock }}</td>
                                    <td>{{ $category->damaged_stock }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="gsm-empty-state small">
                                            {{ __('app.no_category_product_data') }}
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
                        <h3>{{ __('app.overdue_alert_title') }}</h3>
                    </div>
                </div>

                <div class="gsm-table-wrapper gsm-dashboard-table-scroll">
                    <table class="gsm-table">
                        <thead>
                            <tr>
                                <th>{{ __('app.borrower_name') }}</th>
                                <th>{{ __('app.division') }}</th>
                                <th>{{ __('app.due_date') }}</th>
                                <th>{{ __('app.status') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($overdueBorrowings as $borrowing)
                                <tr>
                                    <td>{{ $borrowing->borrower_name }}</td>
                                    <td>{{ $borrowing->division ?? '-' }}</td>
                                    <td>{{ $borrowing->due_date?->format('d M Y') }}</td>
                                    <td>
                                        <span class="gsm-badge danger">
                                            {{ __('app.overdue') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="gsm-empty-state small">
                                            {{ __('app.no_overdue_borrowings') }}
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const monthlyData = @json($monthlyBorrowings);

        const labels = monthlyData.map(function (item) {
            return item.label;
        });

        const data = monthlyData.map(function (item) {
            return item.total;
        });

        const pastelBackgroundColors = [
            'rgba(254, 202, 202, 0.85)',
            'rgba(254, 215, 170, 0.85)',
            'rgba(253, 230, 138, 0.85)',
            'rgba(187, 247, 208, 0.85)',
            'rgba(191, 219, 254, 0.85)',
            'rgba(216, 180, 254, 0.85)',
            'rgba(244, 202, 252, 0.85)',
            'rgba(196, 181, 253, 0.85)',
            'rgba(165, 243, 252, 0.85)',
            'rgba(209, 250, 229, 0.85)',
            'rgba(254, 240, 138, 0.85)',
            'rgba(253, 186, 116, 0.85)'
        ];

        const pastelBorderColors = [
            'rgba(248, 113, 113, 1)',
            'rgba(251, 146, 60, 1)',
            'rgba(250, 204, 21, 1)',
            'rgba(74, 222, 128, 1)',
            'rgba(96, 165, 250, 1)',
            'rgba(168, 85, 247, 1)',
            'rgba(232, 121, 249, 1)',
            'rgba(139, 92, 246, 1)',
            'rgba(34, 211, 238, 1)',
            'rgba(16, 185, 129, 1)',
            'rgba(234, 179, 8, 1)',
            'rgba(249, 115, 22, 1)'
        ];

        const backgroundColors = data.map(function (_, index) {
            return pastelBackgroundColors[index % pastelBackgroundColors.length];
        });

        const borderColors = data.map(function (_, index) {
            return pastelBorderColors[index % pastelBorderColors.length];
        });

        const ctx = document.getElementById('borrowingChart');

        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: @json(__('app.borrowing_count_label')),
                            data: data,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1.5,
                            borderRadius: 14,
                            borderSkipped: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            padding: 12,
                            cornerRadius: 12,
                            displayColors: true,
                            callbacks: {
                                title: function (context) {
                                    return context[0].label;
                                },
                                label: function (context) {
                                    return @json(__('app.borrowing_count_label')) + ': ' + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#64748b',
                                font: {
                                    size: 12,
                                    weight: '600'
                                },
                                maxRotation: 25,
                                minRotation: 0,
                                autoSkip: false
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.15)'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grace: '10%',
                            ticks: {
                                precision: 0,
                                color: '#64748b',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.15)'
                            }
                        }
                    }
                }
            });
        }
    </script>
</x-app-layout>

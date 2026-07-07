<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('app.product_report') }}</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        h2 { text-align: center; margin-bottom: 20px; }
        .meta { margin-bottom: 15px; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #eeeeee; }
        th, td { border: 1px solid #444444; padding: 6px; text-align: left; }
    </style>
</head>

<body>
    <h2>{{ __('app.product_report') }}</h2>

    <div class="meta">
        {{ __('app.printed_at') }}: {{ now()->format('d M Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>{{ __('app.product_code') }}</th>
                <th>{{ __('app.product_name') }}</th>
                <th>{{ __('app.category') }}</th>
                <th>{{ __('app.total_stock') }}</th>
                <th>{{ __('app.good') }}</th>
                <th>{{ __('app.minor_damage_short') }}</th>
                <th>{{ __('app.major_damage_short') }}</th>
                <th>{{ __('app.storage_location') }}</th>
                <th>{{ __('app.status_stock') }}</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->good_stock }}</td>
                    <td>{{ $product->minor_damage_stock }}</td>
                    <td>{{ $product->major_damage_stock }}</td>
                    <td>{{ $product->location }}</td>
                    <td>{{ __('app.' . $product->stock_status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        {{ __('app.no_product_data') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

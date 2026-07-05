<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('app.borrowing_history_report') }}</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 20px; }
        .meta { margin-bottom: 15px; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #eeeeee; }
        th, td { border: 1px solid #444444; padding: 6px; text-align: left; }
    </style>
</head>

<body>
    <h2>{{ __('app.borrowing_history_report') }}</h2>

    <div class="meta">
        {{ __('app.printed_at') }}: {{ now()->format('d M Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>{{ __('app.borrower_name') }}</th>
                <th>{{ __('app.division') }}</th>
                <th>{{ __('app.product_code') }}</th>
                <th>{{ __('app.product_name') }}</th>
                <th>{{ __('app.quantity') }}</th>
                <th>{{ __('app.borrow_date') }}</th>
                <th>{{ __('app.due_date') }}</th>
                <th>{{ __('app.return_date') }}</th>
                <th>{{ __('app.status') }}</th>
                <th>{{ __('app.return_condition_short') }}</th>
                <th>{{ __('app.note') }}</th>
            </tr>
        </thead>

        <tbody>
            @forelse($borrowings as $borrowing)
                @foreach($borrowing->details as $detail)
                    <tr>
                        <td>{{ $borrowing->borrower_name }}</td>
                        <td>{{ $borrowing->division ?? '-' }}</td>
                        <td>{{ $detail->product->code ?? '-' }}</td>
                        <td>{{ $detail->product->name ?? '-' }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $borrowing->borrow_date?->format('Y-m-d') }}</td>
                        <td>{{ $borrowing->due_date?->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ $borrowing->return_date?->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ __('app.' . $borrowing->display_status) }}</td>
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
                        <td>{{ $borrowing->return_note ?? '-' }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="11">
                        {{ __('app.no_borrowing_data') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #eeeeee;
        }

        th, td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Riwayat Peminjaman</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
                @foreach($borrowing->details as $detail)
                    <tr>
                        <td>{{ $borrowing->borrower_name }}</td>
                        <td>{{ $detail->product->code ?? '-' }}</td>
                        <td>{{ $detail->product->name ?? '-' }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $borrowing->borrow_date }}</td>
                        <td>{{ $borrowing->return_date ?? '-' }}</td>
                        <td>{{ $borrowing->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="7">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

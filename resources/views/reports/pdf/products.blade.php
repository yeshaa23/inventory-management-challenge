<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang</title>
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
    <h2>Laporan Data Barang</h2>

    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Lokasi Penyimpanan</th>
                <th>Kondisi Barang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->location }}</td>
                    <td>{{ $product->condition }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

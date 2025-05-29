<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Barang</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->kategori->nama }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>{{ number_format($barang->harga, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
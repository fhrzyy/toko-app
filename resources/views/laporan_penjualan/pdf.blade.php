<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #2b6cb0;
        }
        .periode {
            text-align: center;
            margin-bottom: 20px;
            color: #4a5568;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #2b6cb0;
            color: white;
        }
        .grand-total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Laporan Penjualan</h1>
    <div class="periode">
        @if ($tanggal_awal && $tanggal_akhir)
            Periode: {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}
        @else
            Periode: Semua Data
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal Penjualan</th>
                <th>Pembeli</th>
                <th>Detail Barang</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penjualans as $penjualan)
                <tr>
                    <td>{{ $penjualan->tanggal_penjualan }}</td>
                    <td>{{ $penjualan->pembeli->nama }}</td>
                    <td>
                        <ul>
                            @foreach ($penjualan->details as $detail)
                                <li>{{ $detail->barang->nama }} ({{ $detail->jumlah }} x Rp {{ number_format($detail->barang->harga, 3, ',', '.') }}) = Rp {{ number_format($detail->total_harga, 3, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Rp {{ number_format($penjualan->details->sum('total_harga'), 3, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
        @if ($penjualans->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Grand Total:</td>
                    <td style="font-weight: bold;">Rp {{ number_format($penjualans->sum(fn($penjualan) => $penjualan->details->sum('total_harga')), 3, ',', '.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>
</body>
</html>
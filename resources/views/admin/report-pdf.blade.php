<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            margin-bottom: 16px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 4px;
        }

        .meta {
            margin: 0;
            color: #475569;
            font-size: 11px;
        }

        .summary {
            margin: 16px 0;
            width: 100%;
            border-collapse: collapse;
        }

        .summary td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            width: 33.33%;
        }

        .summary .label {
            color: #475569;
            display: block;
            margin-bottom: 3px;
        }

        .summary .value {
            font-weight: bold;
            font-size: 14px;
        }

        table.report {
            width: 100%;
            border-collapse: collapse;
        }

        table.report th,
        table.report td {
            border: 1px solid #cbd5e1;
            padding: 8px;
            vertical-align: top;
        }

        table.report th {
            background: #e2e8f0;
            text-align: left;
            font-size: 11px;
        }

        .muted {
            color: #64748b;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">Laporan Peminjaman</p>
        <p class="meta">Periode {{ $startDate }} sampai {{ $endDate }}</p>
        <p class="meta">Dicetak {{ now()->format('d M Y H:i') }}</p>
    </div>

    <table class="summary">
        <tr>
            <td>
                <span class="label">Transaksi</span>
                <span class="value">{{ $summary['transactions'] }}</span>
            </td>
            <td>
                <span class="label">Baris Data</span>
                <span class="value">{{ $summary['items'] }}</span>
            </td>
            <td>
                <span class="label">Total Unit Dipinjam</span>
                <span class="value">{{ $summary['units'] }}</span>
            </td>
        </tr>
    </table>

    <table class="report">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Kategori</th>
                <th>Qty</th>
                <th>Periode</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reportItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->rental_code ?? '-' }}</td>
                    <td>
                        <div>{{ $item->borrower_name ?? '-' }}</div>
                        <div class="muted">{{ $item->borrower_phone ?? '-' }}</div>
                    </td>
                    <td>{{ $item->product_name ?? '-' }}</td>
                    <td>{{ $item->category_name ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->rental_start_date ?? '-' }} - {{ $item->rental_end_date ?? '-' }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $item->rental_status ?? 'unknown')) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data peminjaman pada filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

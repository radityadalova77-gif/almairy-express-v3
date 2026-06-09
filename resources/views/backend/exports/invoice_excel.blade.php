<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            width: 95%;
            margin: auto;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .header-table td {
            padding: 3px;
        }

        .amount {
            text-align: right;
            margin-bottom: 10px;
            font-weight: bold;
        }

        table.invoice {
            width: 100%;
            border-collapse: collapse;
        }

        table.invoice th,
        table.invoice td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table.invoice th {
            background: #dcdcdc;
        }

        .text-right {
            text-align: right;
        }

        .grand-total {
            margin-top: 10px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="title">INVOICE</div>

        {{-- HEADER --}}
        <table class="header-table">
            <tr>
                <td width="8%">No</td>
                <td>: {{ $invoice->no_invoice }}</td>
            </tr>
            <tr>
                <td>To</td>
                <td>: {{ $invoice->pelanggan?->nama_perusahaan }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>: {{ $invoice->pelanggan?->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tlp</td>
                <td>: {{ $invoice->pelanggan?->telepon ?? '-' }}</td>
            </tr>
            <tr>
                <td>Attn</td>
                <td>: -</td>
            </tr>
        </table>


        {{-- TABLE --}}
        <table class="invoice">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>No AWB</th>
                    <th>Description</th>
                    <th>Service</th>
                    <th>KG</th>
                    <th>Tarif</th>
                    <th>Total (Rp)</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($invoice->pengirimans as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($invoice->tanggal_invoice)->format('d-M-y') }}
                    </td>

                    <td>{{ $p->resi }}</td>
                    <td>{{ $p->kota_tujuan }}</td> <!-- Description -->
                    <td>Retail</td> <!-- Service -->
                    <td>{{ rtrim(rtrim(number_format($p->berat_kg, 2, '.', ''), '0'), '.') }}</td>
                    <td>{{ rtrim(rtrim(number_format($p->harga_per_kg, 2, '.', ''), '0'), '.') }}</td>
                    <td class="text-right">
                        {{ number_format($p->tarif, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table style="width:100%; margin-top:10px; border-collapse:collapse;">
            <tr>
                <td style="border:1px solid #000; text-align:center; font-weight:bold;">
                    TOTAL
                </td>
                <td style="border:1px solid #000; text-align:right; font-weight:bold;">
                    Rp {{ number_format($invoice->nominal,0,',','.') }}
                </td>
            </tr>

            <tr>
                <td style="border:1px solid #000;">Terbilang</td>
                <td style="border:1px solid #000; text-align:right; font-style:italic;">
                    {{ ucwords(terbilang($invoice->nominal)) }} Rupiah
                </td>
            </tr>
        </table>

    </div>

</body>

</html>
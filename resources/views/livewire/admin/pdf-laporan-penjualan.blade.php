<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan Pasir</title>


    <style>
        @page {
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif, Helvetica, Arial, sans-serif;
        }

        table.bordered {
            border-collapse: collapse;
        }

        table.bordered thead,
        table.bordered body,
        table.bordered tr,
        table.bordered td,
        table.bordered th {
            /* border: 1px solid black; */
            border-top: solid 1px black;
            border-left: solid 1px black;
            border-right: solid 1px black;
            border-bottom: solid 1px black;
        }

        th,
        td {
            padding: 5px;
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-top: var(--bs-gutter-y);
        }

        .col {
            flex: 1 0 0%;
        }

        .text-center {
            text-align: center;
        }

        .check {
            width: 20px;
            height: 20px;
            display: inline-block;
            position: relative;
        }

        .check:before {
            content: "";
            position: absolute;
            top: 4px;
            left: 6px;
            width: 4px;
            height: 10px;
            border-bottom: 2px solid black;
            border-right: 2px solid black;
            transform: rotate(45deg);
        }
    </style>
</head>

<body>
    <div style="margin-left:50px;margin-right:30px">
        <table style="width: 100%;text-align:center">
            <h5 style="margin-top:5px;margin-bottom:5px">LAPORAN PENJUALAN PASIR</h5>
            <h5 style="margin-top:5px;margin-bottom:5px">PT. TAMBANG PASIR RANOKOMEA</h5>
            <h5 style="margin-top:5px;margin-bottom:5px;font-weight:normal;">PERIODE:<span style="margin-right: 50px">
                </span>/<span style="margin-right: 50px"> </span>/</h5>
        </table>
        <br>
        <table class="bordered" style="width: 100%; margin-top:5px;font-size:13px">
            <thead>
                <tr style="text-align: center; font-weight:bold">
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Tgl Pengantaran</th>
                    <th style="text-align: center">Pelanggan</th>
                    <th style="text-align: center">Alamat Pengantaran</th>
                    <th style="text-align: center">Jenis Pasir</th>
                    <th style="text-align: center">Jumlah</th>
                    <th style="text-align: center">Harga</th>
                    <th style="text-align: center">Ongkir</th>
                    <th style="text-align: center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td style="text-align: center">{{ Carbon\Carbon::parse($item->tanggal_pengantaran)->format('d-m-Y') }}</td>
                    <td style="text-align: center">{{ ucwords($item->pelanggan->nama) }} <br>({{ ucwords($item->pelanggan->telepon) }})</td>
                    <td style="text-align: center">{{ ucwords($item->alamat_pengantaran) }}</td>
                    <td style="text-align: center">{{ ucwords($item->produk->nama_produk) }}</td>
                    <td style="text-align: center">{{ $item->jumlah }} Truk</td>
                    <td style="text-align: center">Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                    <td style="text-align: center">Rp. {{ number_format($item->ongkir, 0, ',', '.') }}</td>
                    <td style="text-align: center">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <p></p>
        <table style="width: 100%; margin-top:15px;font-size:13px;page-break-inside: avoid;">
            <tr>
                <td style="text-align: left">Bombana,<span style="margin-right: 50px">
                    </span><span style="margin-right: 50px"> </span> 2024</td>
            </tr>
            <tr>
                <td style="text-align: left">
                    Mengetahui,
                    <br><br>
                    <p></p>
                    <br><br>
                    <b> *Pimpinan*</b>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>

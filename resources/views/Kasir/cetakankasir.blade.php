<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pelayanan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/adminlte.min.css') }}">
</head>

<body>
    <div class="wrapper">
        <div class="card mt-2">
            <div class="card-header">Nota Pembayaran</div>
            <div class="card-body">
                @foreach ($kasirheader as $kh)
                    <div class="card">
                        <div class="card-header">ID HEADER : {{ $kh->id }} | TANGGAL : {{ $kh->tgl_entry }}</div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered text-xs font-italic">
                                <thead>
                                    <th width="150px">Nama Tarif / Obat</th>
                                    <th width="150px">Jumlah Layanan</th>
                                    <th width="150px">Tarif</th>
                                    <th width="150px">Total</th>
                                </thead>
                                <tbody>
                                    @foreach ($kasirdetail as $dk)
                                        @if ($dk->idh == $kh->id)
                                            <tr>
                                                <td>{{ $dk->nama_tarif }} {{ $dk->nama_barang }}</td>
                                                <td>{{ $dk->jumlah_layanan }}</td>
                                                <td>RP. {{ number_format($dk->trfs, 2) }}</td>
                                                <td>RP. {{ number_format($dk->total_tarif, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-sm text-xs table-bordered">
                                <thead>
                                    <th width="150px">Total Tagihan </th>
                                    <th width="150px">Total Bayar</th>
                                    <th width="150px">Total Kembalian</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>RP. {{ number_format($kh->jumlah_tagihan, 2) }}</td>
                                        <td>RP. {{ number_format($kh->jumlah_bayar, 2) }}</td>
                                        <td>RP. {{ number_format($kh->kembalian, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>

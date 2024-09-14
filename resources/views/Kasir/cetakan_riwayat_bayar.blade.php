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
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header mt-4">
                        RIWAYAT PEMBAYARAN
                        <small class="float-right"></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Periode {{ $awal }} s/d {{ $akhir }}
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="tabelriwayatbayar" class="table table-sm table-bordered text-xs">
                        <thead>
                            <th width="15%">Tanggal entry</th>
                            {{-- <th>Nomor RM</th> --}}
                            <th width="4px">Nama</th>
                            {{-- <th class="text-xs">Alamat</th> --}}
                            <th width="4px">Tagihan</th>
                            <th width="2px">Uang Bayar</th>
                            <th width="4px">Kembalian</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $d )
                                <tr>
                                    <td>{{ $d->tgl_resep }}</td>
                                    {{-- <td>{{ $d->no_rm }}</td> --}}
                                    <td>{{ $d->nama_pasien }}</td>
                                    {{-- <td>{{ $d->alamat }}</td> --}}
                                    <td>RP. {{ number_format($d->jumlah_tagihan, 2) }}</td>
                                    <td>RP. {{ number_format($d->jumlah_bayar, 2) }} </td>
                                    <td>RP. {{ number_format($d->kembalian, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>

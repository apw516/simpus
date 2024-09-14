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
                        RIWAYAT PELAYANAN PASIEN
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
                    <table class="table table-sm table-bordered">
                        <thead>
                            <th>Tanggal Masuk</th>
                            <th>Counter</th>
                            <th>Nomor RM</th>
                            <th>Nama Pasien</th>
                            <th>Tujuan</th>
                            <th>Status Kunjungan</th>
                            <th>Pic</th>
                        </thead>
                        <tbody>
                            @foreach ($data_pelayanan as $da)
                                <tr>
                                    <td>{{ $da->tgl_entry_kunjungan }}</td>
                                    <td>{{ $da->counter }}</td>
                                    <td>{{ $da->no_rm }}</td>
                                    <td>{{ $da->nama_pasien }}</td>
                                    <td>{{ $da->nama_unit }}</td>
                                    <td>
                                        @if ($da->status_kunjungan == 1)
                                            Aktif
                                        @elseif($da->status_kunjungan == 2)
                                            Selesai
                                        @elseif($da->status_kunjungan == 3)
                                            Batal
                                        @endif
                                    </td>
                                    <td>{{ $da->nama }}</td>
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

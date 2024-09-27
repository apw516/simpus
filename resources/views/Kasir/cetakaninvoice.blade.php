<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS | Invoice Print</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('public/IMG/logo-puskesmas.png') }}">

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
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i> SIMPUS INVOICE
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{ $invoice_header[0]->nama_pasien }}</strong><br>
                        {{ $invoice_header[0]->alamat_pasien }}<br>
                        Phone: {{ $mt_pasien[0]->nomor_telepon }}<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #{{ $invoice_header[0]->kode_invoice }}</b><br>
                    <br>
                    <b>Kode Kunjungan:</b>#KJ{{ $invoice_header[0]->kode_kunjungan }}<br>
                    <b>Petugas:</b> {{ $invoice_header[0]->nama_pic }}<br>
                    <b>Account:</b> {{ $invoice_header[0]->pic }}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row mt-5">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Nama Tarif</th>
                                <th>Tarif</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($invoice_header as $i )
                                <tr>
                                    <td>{{ $i->qty}}</td>
                                    <td>{{ $i->nama_tarif}}</td>
                                    <td>RP. {{ number_format($i->tarif, 2) }}</td>
                                    <td>RP. {{ number_format($i->grandtotal, 2) }}</td>
                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Metode Pembayaran :</p>
                    <img width="10%" src="{{ asset('public/adminlte/dist/img/credit/dana.jpg') }}" alt="Visa">
                    <img width="10%" src="{{ asset('public/adminlte/dist/img/credit/bankjateng.png') }}" alt="Visa">
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Nama : Haidar Hasan Alfathi <br>
                        Rekening Dana : 082123332344 <br>
                        Rekening Bank Jateng : 666313134
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Tanggal Invoice {{ $invoice_header[0]->tgl_invoice}}</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Grand Total:</th>
                                <td>RP. {{ number_format($invoice_header[0]->total, 2) }}</td>
                            </tr>
                        </table>
                    </div>
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

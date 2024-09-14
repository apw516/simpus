<button class="btn btn-danger" onclick="kembali()">
    <i class="bi bi-backspace mr-1"></i> Kembali</button>
<div class="card mt-2">
    <div class="card-header">Berkas Elektronik Rekamedis Pasien</div>
    <div class="card-body">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        {{ $mt_pasien[0]->nama_pasien }}
                        <small class="float-right">Tanggal entry : {{ $mt_pasien[0]->tgl_entry }}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Nomor RM
                    <address>
                        <strong>{{ $mt_pasien[0]->no_rm }}</strong><br><br>
                        Nomor Identitas : {{ $mt_pasien[0]->nomor_identitas }}<br>
                        Nomor Telepon : {{ $mt_pasien[0]->nomor_telepon }}<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Alamat
                    <address>
                        <strong>{{ $mt_pasien[0]->alamat }}</strong><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Jenis Kelamin : @if ($mt_pasien[0]->jenis_kelamin == 1)
                            Laki - Laki
                        @else
                            Perempuan
                        @endif
                    </b><br>
                    <br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    @foreach ($kunjungan as $da)
                        <div class="card">
                            <div class="card-header text-bold bg-light">Kunjungan ke {{ $da->counter }} | Tanggal
                                Periksa {{ $da->tgl_entry }} | Dokter {{ $da->nama_dokter }} | {{ $da->nama_unit }}
                            </div>
                            <div class="card-body">
                                <p class="text-bold">Hasil Pemeriksaan : <br></p>
                                <p>Subject : {{ $da->Subject }}<br>

                                    Object : {{ $da->Object }}<br>

                                    Assesment : {{ $da->Assesment }}<br>

                                    Planning : {{ $da->Planning }}<br></p>

                                <div class="card">
                                    <div class="card-header bg-secondary">Tindakan dan Obat</div>
                                    <div class="card-body">
                                        <table class="table table-sm text-xs">
                                            <thead>
                                                <th>Nama Tindakan / Obat</th>
                                                <th>Jumlah</th>
                                                <th>Aturan Pakai</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($header as $h)
                                                    @if ($h->kode_kunjungan == $da->id)
                                                        <tr>
                                                            <td>{{ $h->nama_tarif }} {{ $h->nama_barang }}</td>
                                                            <td>{{ $h->jumlah_layanan }}</td>
                                                            <td>{{ $h->aturan_pakai }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            {{-- <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango
                        imeem
                        plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$5.80</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$265.24</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div> --}}
            <!-- /.row -->
            <input type="text" value="{{ $rm }}" hidden id="rm">
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a class="btn btn-default"
                        onclick="printerm()"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function kembali() {
        $('.v2').attr('Hidden', true);
        $('.v1').removeAttr('hidden', true);
    }

    function printerm() {
        rm = $('#rm').val()
        window.open('cetakberkaserm/' + rm);
    }
</script>

@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Pembayaran</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="v1">
                <div class="row mt-3">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Tanggal awal</label>
                            <input type="date" class="form-control" id="tanggalawal" name="tanggalawal"
                                placeholder="Masukan nomor identitas ..." value="{{ $date}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Tanggal akhir</label>
                            <input type="date" class="form-control" id="tanggalakhir" name="tanggalakhir"
                                placeholder="Masukan nomor identitas ..." value="{{ $date}}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <button class="btn btn-success" style="margin-top:31px" onclick="caririwayat()"><i
                                class="bi bi-search mr-2"></i>Cari riwayat</button>
                        <button class="btn btn-warning" style="margin-top:31px" onclick="cetakriwayatbayar()"><i
                                class="bi bi-search mr-2"></i>Cetak riwayat</button>
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="v_master_pasien_kasir">

                    </div>
                </div>
            </div>
            <div hidden class="v2">

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            caririwayat()
        })
        function caririwayat() {
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                   awal,akhir
                },
                url: '<?= route('caririwayatpembayaran') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_master_pasien_kasir').html(response);
                }
            });
        }
        function cetakriwayatbayar()
        {
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            window.open('cetakriwayatbayar/' + awal + '/' + akhir);
        }
    </script>
@endsection

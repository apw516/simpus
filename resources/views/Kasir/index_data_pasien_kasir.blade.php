@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kasir</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="v1">
                <a class="btn btn-info" href="{{ route('riwayatpelayanan')}}" ><i class="bi bi-info-circle mr-2"></i>Riwayat Pembayaran</a>
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
                    <div class="col-md-2">
                        <button class="btn btn-success" style="margin-top:31px" onclick="caripasienkasir()"><i
                                class="bi bi-search mr-2"></i>Cari Pasien</button>
                    </div>
                </div>
                <div class="v_master_pasien_kasir">

                </div>
            </div>
            <div hidden class="v2">

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            caripasienkasir()
        })
        function caripasienkasir() {
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                   awal,akhir
                },
                url: '<?= route('caripasienkasir') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_master_pasien_kasir').html(response);
                }
            });
        }
    </script>
@endsection

@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Pelayanan</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="v1">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal awal</label>
                            <input type="date" class="form-control" id="tanggalawal" aria-describedby="emailHelp" value="{{ $date}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggalakhir" aria-describedby="emailHelp" value="{{ $date}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Filter</label>
                            <select class="form-control" id="filter">
                                <option value="1">Tampil Semua</option>
                                <option value="2">By {{ strtoupper(auth()->user()->nama)}}</option>
                              </select>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" style="margin-top:32px" onclick="tampilkandata()"><i class="bi bi-search mr-2"></i> Tampilkan</button>
                        <button class="btn btn-warning" style="margin-top:32px" onclick="cetakriwayatpelayanan()"><i class="bi bi-printer mr-2"></i> Cetak</button>
                    </div>
                </div>
            </div>
            <div class="v2">

            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modalpasienbaru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Pasien Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="formpasienbaru">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Identitas</label>
                            <input type="email" class="form-control" id="nomoridentitas" name="nomoridentitas"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Telepon</label>
                            <input type="email" class="form-control" id="nomorhp" name="nomorhp"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="email" class="form-control" id="namalengkap" name="namalengkap"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <select class="form-control" id="jeniskelamin" name="jeniskelamin">
                                <option value="1">Laki Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat lahir</label>
                            <input type="email" class="form-control" id="tempatlahir" name="tempatlahir"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal lahir</label>
                            <input type="date" class="form-control" id="tanggallahir" name="tanggallahir"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" aria-describedby="emailHelp"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanpasienbaru()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            tampilkandata()
        })
        function tampilkandata()
        {
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            filter = $('#filter').val()
            spinneron()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    awal,
                    akhir,
                    filter
                },
                url: '<?= route('caririwayatpelayanan') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v2').html(response);
                }
            });
        }
        function cetakriwayatpelayanan(){
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            filter = $('#filter').val()
            window.open('cetakriwayatpelayanan/' + awal + '/' + akhir + '/' + filter);
        }
    </script>
@endsection

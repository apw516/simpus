@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Pasien</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="v1">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalpasienbaru"><i
                        class="bi bi-clipboard2-plus mr-2"></i>Pasien Baru</button>
                <a class="btn btn-info" href="{{ route('riwayatpelayanan')}}" ><i class="bi bi-info-circle mr-2"></i>Riwayat Pelayanan</a>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nomor Identitas</label>
                            <input type="text" class="form-control" id="nomorid" name="nomorid"
                                placeholder="Masukan nomor identitas ...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nomor RM</label>
                            <input type="text" class="form-control" id="nomorrm" name="nomorrm"
                                placeholder="Masukan Nomor RM ...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nama</label>
                            <input type="text" class="form-control" id="namapx" id="namapx"
                                placeholder="Masukan Nama Pasien ...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Alamat</label>
                            <input type="text" class="form-control" id="alamatpx" id="alamatpx"
                                placeholder="Masukan Nama Pasien ...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" style="margin-top:31px" onclick="caripasien()"><i
                                class="bi bi-search mr-2"></i>Cari Pasien</button>
                    </div>
                </div>
                <div class="v_master_pasien">

                </div>
            </div>
            <div hidden class="v2">

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
            caripasien()
        })
        function simpanpasienbaru() {
            var data = $('.formpasienbaru').serializeArray();
            spinneron()
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                },
                url: '<?= route('simpanpasienbaru') ?>',
                error: function(data) {
                    spinnerof()
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops....',
                        text: 'Sepertinya ada masalah......',
                        footer: ''
                    })
                },
                success: function(data) {
                    if (data.kode == 500) {
                        spinnerof()
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: data.message,
                            footer: ''
                        })
                    } else {
                        spinnerof()
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: data.message,
                            footer: ''
                        })
                        location.reload()
                    }
                }
            });
        }

        function caripasien() {
            nomorid = $('#nomorid').val()
            rm = $('#nomorrm').val()
            nama = $('#namapx').val()
            alamat = $('#alamatpx').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorid,
                    rm,
                    nama,
                    alamat
                },
                url: '<?= route('mastercaripasien') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_master_pasien').html(response);
                }
            });
        }
    </script>
@endsection

@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Obat</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-success" data-toggle="modal" data-target="#modaladdobat"><i
                    class="bi bi-house-add mr-2"></i> Tambah Obat</button>
            <div class="v_master_obat">

            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modaladdobat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-house-add mr-2"></i> Tambah Master Obat
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="formtambahobat">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Obat</label>
                            <input type="text" class="form-control" id="namaobat" name="namaobat"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Generik</label>
                            <input type="text" class="form-control" id="namagenerik" name="namagenerik"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Aturan Pakai</label>
                            <input type="text" class="form-control" id="aturanpakai" name="aturanpakai"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dosis</label>
                            <input type="text" class="form-control" id="dosis" name="dosis"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Sediaan</label>
                            <select class="form-control" id="sediaan" name="sediaan">
                                <option value="-">Silahkan Pilih</option>
                                @foreach ($sediaan as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_sediaan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Satuan Besar</label>
                            <select class="form-control" id="satuanbesar" name="satuanbesar">
                                <option value="-">Silahkan Pilih</option>
                                @foreach ($satuan as $s)
                                    <option value="{{ $s->kode_satuan }}">{{ $s->nama_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Satuan Sedang</label>
                            <select class="form-control" id="satuansedang" name="satuansedang">
                                <option value="-">Silahkan Pilih</option>
                                @foreach ($satuan as $s)
                                    <option value="{{ $s->kode_satuan }}">{{ $s->nama_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Satuan Kecil</label>
                            <select class="form-control" id="satuankecil" name="satuankecil">
                                <option value="-">Silahkan Pilih</option>
                                @foreach ($satuan as $s)
                                    <option value="{{ $s->kode_satuan }}">{{ $s->nama_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanobat()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
         $(document).ready(function() {
            ambilmasterbarang()
        })
        function ambilmasterbarang() {
            spinneron()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambilmasterbarang') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_master_obat').html(response);
                }
            });
        }

        function simpanobat() {
            var data = $('.formtambahobat').serializeArray();
            spinneron()
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                },
                url: '<?= route('simpanobat') ?>',
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
                        ambilmasterbarang()
                    }
                }
            });
        }
    </script>
@endsection

@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Unit</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-success" data-toggle="modal" data-target="#modaladdunit"><i
                    class="bi bi-house-add mr-2"></i> Tambah Unit</button>
            <div class="v_master_unit">

            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modaladdunit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-house-add mr-2"></i> Tambah Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="formtambahunit">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Unit</label>
                            <input type="text" class="form-control" id="namaunit" name="namaunit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jenis</label>
                            <select class="form-control" id="jenisunit" name="jenisunit">
                              <option value="1">Pelayanan</option>
                              <option value="2">Manajemen</option>
                            </select>
                          </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanunit()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            ambilmasterunit()
        })

        function ambilmasterunit() {
            spinneron()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambilmasterunit') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_master_unit').html(response);
                }
            });
        }

        function simpanunit() {
            var data = $('.formtambahunit').serializeArray();
            spinneron()
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                },
                url: '<?= route('simpanunit') ?>',
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
                        ambilmasterunit()
                    }
                }
            });
        }
    </script>
@endsection

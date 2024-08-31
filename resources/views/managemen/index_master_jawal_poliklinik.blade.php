@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Jadwal Poliklinik dan Dokter</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-success" data-toggle="modal" data-target="#modaladdpegawai"><i
                    class="bi bi-house-add mr-2"></i> Tambah Jadwal</button>
            <div class="v_master_jadwal">

            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modaladdpegawai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-house-add mr-2"></i> Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="formtambahjadwal">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Poliklinik</label>
                            <select class="form-control" id="unit" name="unit">
                                <option value="0">Silahkan Pilih</option>
                                @foreach ($unit as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Dokter</label>
                            <select class="form-control" id="dokter" name="dokter">
                                <option value="0">Silahkan Pilih</option>
                                @foreach ($pegawai as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pilih Hari</label>
                                <select class="form-control" id="hari" name="hari">
                                    <option value="0">Silahkan Pilih</option>
                                    @foreach ($hari as $h)
                                        <option value="{{ $h->id }}">{{ $h->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Masukan Jam</label>
                                <input type="text" class="form-control" id="jampraktek" name="jampraktek" placeholder="cth: 08:00 - 11:00"
                                    aria-describedby="emailHelp">
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanjadwal()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#namahari').autocomplete({
                source: "<?= route('carihari') ?>",
                select: function(event, ui) {
                    $('[id="namahari"]').val(ui.item.label);
                    $('[id="kodehari"]').val(ui.item.kode);
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            ambilmasterjadwal()
        })

        function ambilmasterjadwal() {
            spinneron()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambilmasterjadwal') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_master_jadwal').html(response);
                }
            });
        }

        function simpanjadwal() {
            var data = $('.formtambahjadwal').serializeArray();
            spinneron()
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                },
                url: '<?= route('simpanjadwal') ?>',
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
                        ambilmasterjadwal()
                    }
                }
            });
        }
    </script>
@endsection

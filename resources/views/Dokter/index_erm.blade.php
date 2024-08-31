<button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace mr-1"></i> Kembali</button>
<style>
    .card2 {
        min-height: 700px;
    }
</style>
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{ strtoupper($mt_pasien[0]->nama_pasien) }}</h3>
                <p class="text-muted text-center">Nomor RM : {{ $mt_pasien[0]->no_rm }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Nomor Identitas</b> <a class="float-right">{{ $mt_pasien[0]->nomor_identitas }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Jenis Kelamin</b> <a class="float-right">{{ $mt_pasien[0]->jenis_kelamin }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tanggal Lahir</b> <a class="float-right">{{ $mt_pasien[0]->tanggal_lahir }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Alamat</b> <a class="float-right">{{ $mt_pasien[0]->alamat }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Riwayat Kunjungan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="v_riwayat_kunjungan">

                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="card card2">
            <div class="card-header bg-light">Form Pemeriksaan</div>
            <div class="card-body">
                <form class="formpemeriksaandokter" method="post">
                    <input hidden type="text" class="form-control" value="{{ $kodekunjungan }}" id="kodekunjungan"
                        name="kodekunjungan">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject</label>
                                <textarea rows="4" type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp">
@foreach ($data_now as $d)
{{ $d->Subject }}
@endforeach
</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Object</label>
                                <textarea rows="4" type="text" class="form-control" id="object" name="object" aria-describedby="emailHelp">
@foreach ($data_now as $d)
{{ $d->Object }}
@endforeach
</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Assesment</label>
                                <textarea rows="4" type="text" class="form-control" id="assesment" name="assesment"
                                    aria-describedby="emailHelp">
@foreach ($data_now as $d)
{{ $d->Assesment }}
@endforeach
</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Planning</label>
                                <textarea rows="4" type="text" class="form-control" id="planning" name="planning"
                                    aria-describedby="emailHelp">
@foreach ($data_now as $d)
{{ $d->Planning }}
@endforeach
</textarea>
                            </div>
                        </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">Input Tindakan</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">Pilih Tindakan / layanan</div>
                                <div class="card-body">
                                    <table id="tabeltarif" class="table table-sm table-hover">
                                        <thead>
                                            <th>Nama</th>
                                            <th>Tarif</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($tarif as $r)
                                                <tr>
                                                    <td>{{ $r->nama_tarif }}</td>
                                                    <td>{{ $r->tarif }}</td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm pilihlayanan"
                                                            idtarif="{{ $r->id }}" nama="{{ $r->nama_tarif }}"
                                                            harga="{{ $r->tarif }}"><i
                                                                class="bi bi-check2-square"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">Pilih tarif</div>
                                <div class="card-body">
                                    <form action="" method="post" class="form_layanan">
                                        <div class="input_layanan">
                                            <div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success tampilriwayat" data-toggle="modal"
                                        data-target="#modalriwayatlayanan"><i class="bi bi-card-list mr-2"></i>
                                        Riwayat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Order Resep</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">Pilih Obat</div>
                                <div class="card-body">
                                    <table id="tabelbarang" class="table table-sm table-hover text-xs">
                                        <thead>
                                            <th>Nama</th>
                                            <th>Dosis</th>
                                            <th>Aturan Pakai</th>
                                            <th>Sediaan</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($barang as $r)
                                                <tr>
                                                    <td>{{ $r->nama_barang }}</td>
                                                    <td>{{ $r->dosis }}</td>
                                                    <td>{{ $r->aturan_pakai }}</td>
                                                    <td>{{ $r->nama_sediaan }}</td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm pilihobat"
                                                        idbarang="{{ $r->id_barang }}" nama="{{ $r->nama_barang }}"
                                                        dosis="{{ $r->dosis }}"
                                                        aturan = "{{$r->aturan_pakai}}"
                                                        ><i
                                                            class="bi bi-check2-square"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">Pilih Obat</div>
                                <div class="card-body">
                                    <form action="" method="post" class="form_layanan_resep">
                                        <div class="input_layanan_resep">
                                            <div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success tampilriwayat" data-toggle="modal"
                                        data-target="#modalriwayatresep"><i class="bi bi-card-list mr-2"></i>
                                        Riwayat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="float-right btn btn-success ml-1"
                onclick="simpanpemeriksaan()">Simpan</button>
            <button class="float-right btn btn-danger" onclick="kembali()"><i class="bi bi-backspace mr-1"></i>
                Kembali</button>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatlayanan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_tabel_riwayat_lyanan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<input hidden type="text" id="rmpasien" value="{{ $mt_pasien[0]->no_rm }}">
<script>
    $(function() {
        $("#tabeltarif").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(function() {
        $("#tabelbarang").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": 5,
            "searching": true,
            "ordering": false,
        })
    });

    function kembali() {
        $('.v2').attr('Hidden', true);
        $('.v1').removeAttr('hidden', true);
    }
    $(document).ready(function() {
        ambilriwayatkunjungan()
    })

    function ambilriwayatkunjungan() {
        rm = $('#rmpasien').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('ambilriwayatkunjungan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_kunjungan').html(response);
            }
        });
    }
    $(".pilihlayanan").on('click', function(event) {
        idtarif = $(this).attr('idtarif')
        nama = $(this).attr('nama')
        harga = $(this).attr('harga')
        var wrapper = $(".input_layanan");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Tarif / Tindakan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namatarif" value="' +
            nama +
            '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="idtarif" value="' +
            idtarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
            harga +
            '"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    $(".pilihobat").on('click', function(event) {
        idtarif = $(this).attr('idbarang')
        nama = $(this).attr('nama')
        dosis = $(this).attr('dosis')
        aturan = $(this).attr('aturan')
        var wrapper = $(".input_layanan_resep");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Obat</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namaobat" value="' +
            nama +
            '"><input  readonly type="" class="form-control form-control-sm" id="" name="idobat" value="' +
            idtarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Dosis</label><input readonly type="" class="form-control form-control-sm" id="" name="dosis" value="' +
            dosis +
            '"></div><div class="form-group col-md-4"><label for="inputPassword4">Aturan Pakai</label><input readonly type="" class="form-control form-control-sm" id="" name="aturanpakai" value="' +
            aturan +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Qty</label><input type="" class="form-control form-control-sm" id="" name="qty" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
    function simpanpemeriksaan() {
        var data = $('.formpemeriksaandokter').serializeArray();
        var data2 = $('.form_layanan').serializeArray();
        var data3 = $('.form_layanan_resep').serializeArray();
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                data2: JSON.stringify(data2),
                data3: JSON.stringify(data3),
            },
            url: '<?= route('simpanpemeriksaandokter') ?>',
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
                    ambilriwayatkunjungan()
                    reload_form_erm()
                }
            }
        })
    }
    $(".tampilriwayat").on('click', function(event) {
        kodekunjungan = $('#kodekunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('detail_riwayat_layanan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_tabel_riwayat_lyanan').html(response);
            }
        });
    });
    function reload_form_erm()
    {
        norm = $('#rmpasien').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                norm,kodekunjungan
            },
            url: '<?= route('ambil_index_erm') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v1').attr('Hidden',true);
                $('.v2').removeAttr('hidden',true);
                $('.v2').html(response);
            }
        });
    }
</script>

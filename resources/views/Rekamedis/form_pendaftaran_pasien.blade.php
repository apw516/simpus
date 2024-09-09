<button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace mr-1"></i> Kembali</button>
<style>
    .card {
        min-height: 500px;
    }
</style>
<div class="row">
    <div class="col-md-2">
        <div class="card card-primary card-outline mt-2">
            <div class="card-body box-profile">


                <h3 class="profile-username text-center">{{ $detail_pasien[0]->nama_pasien }}</h3>
                <ul class="list-group list-group-unbordered mb-3 text-dark">
                    <li class="list-group-item ">
                        <b>Nomor RM</b> <a class="float-right text-dark">{{ $detail_pasien[0]->no_rm }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nomor Identitas</b> <a
                            class="float-right text-dark">{{ $detail_pasien[0]->nomor_identitas }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tempat,Tanggal Lahir</b> <a
                            class="float-right text-dark">{{ $detail_pasien[0]->tempat_lahir }},{{ $detail_pasien[0]->tanggal_lahir }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Jenis Kelamin</b> <a class="float-right text-dark">
                            @if ($detail_pasien[0]->nama_pasien == '1')
                                Laki - Laki
                            @else
                                Perempuan
                            @endif
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Alamat</b> <a class="float-right text-dark">{{ $detail_pasien[0]->alamat }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary card-outline mt-2">
            <div class="card-header text-lg text-bold">Riwayat Kunjungan Pasien</div>
            <div class="card-body">
                <div class="v_riwayat_kunjungan">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mt-2">
            <div class="card-header bg-success text-lg text-bold">Form Pendaftaran</div>
            <div class="card-body">
                <form class="formpendaftaran">
                    <input hidden type="text" class="form-control" name="rmpasien" id="rmpasien"
                        value="{{ $rm }}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Tujuan</label>
                        <input type="text" class="form-control" id="namapoli" name="namapoli"
                            placeholder="Silahkan cari tujuan periksa ...">
                        <input hidden type="text" class="form-control" id="kodepoli" name="kodepoli">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Dokter</label>
                        <input type="text" class="form-control" id="namadokter" name="namadokter"
                            placeholder="silahkan pilih dokter">
                        <input hidden type="text" class="form-control" id="kodedokter" name="kodedokter">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tgl Masuk</label>
                        <input type="date" class="form-control" id="tglmasuk" name="tglmasuk"
                            value="{{ $now }}">
                    </div>
                    <button type="button" class="btn btn-success float-right" onclick="simpanpendaftaran()"><i
                            class="bi bi-floppy2-fill mr-1"></i>Daftar</button>
                    <button type="button" class="btn btn-warning float-right mr-1" onclick="kembali()"><i
                            class="bi bi-align-end mr-1"></i>Selesai</button>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#namapoli').autocomplete({
            source: "<?= route('cariunit') ?>",
            select: function(event, ui) {
                $('[id="namapoli"]').val(ui.item.label);
                $('[id="kodepoli"]').val(ui.item.kode);
            }
        });
        $('#namadokter').autocomplete({
            source: "<?= route('caridokter') ?>",
            select: function(event, ui) {
                $('[id="namadokter"]').val(ui.item.label);
                $('[id="kodedokter"]').val(ui.item.kode);
            }
        });
        ambilriwayatkunjungan()
    })

    function ambilriwayatkunjungan() {
        rm = $('#rmpasien').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('riwayatkunjungan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_kunjungan').html(response);
            }
        });
    }

    function kembali() {
        $('.v2').attr('Hidden', true);
        $('.v1').removeAttr('hidden', true);
    }

    function simpanpendaftaran() {
        Swal.fire({
            title: "Apakah data pendaftaran sudah diisi dengan benar ?",
            text: "Klik OK untuk simpan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                var data = $('.formpendaftaran').serializeArray();
                spinneron()
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                    },
                    url: '<?= route('simpanpendaftaran') ?>',
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
                            $('.formpendaftaran').find('input:text').val('');
                        }
                    }
                });
            }
        });

    }
</script>

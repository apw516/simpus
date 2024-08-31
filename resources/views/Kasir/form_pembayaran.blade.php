<button class="btn btn-danger" onclick="isback()"><i class="bi bi-backspace mr-2"></i> Kembali</button>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Data Tagihan</div>
            <div class="card-body">
                <table id="tabeltagihan" class="table table-bordered table-hover table-sm">
                    <thead>
                        <th>Nama Tarif</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Grand Total</th>
                        <th>Status Pembayaran</th>
                        <th>Status</th>
                        <th>Pilih</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->nama_tarif }}{{ $d->nama_barang }}</td>
                                <td>{{ $d->jumlah_layanan }}</td>
                                <td>{{ $d->tarif_2 }}</td>
                                <td>{{ $d->total_tarif }}</td>
                                <td>@if($d->status_layanan == 2)Sudah dibayar @endif</td>
                                <td>{{ $d->status_layanan_detail }}</td>
                                <td><button class="btn btn-success btn-sm pilihtagihan" iddetail="{{ $d->id_detail }}"
                                        id_header="{{ $d->id_header }}" nama_tarif="{{ $d->nama_tarif }}"
                                        tarif="{{ $d->tarif }}" grandtotal="{{ $d->total_tarif }}"
                                        qty="{{ $d->jumlah_layanan }}"><i class="bi bi-check2-square"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Data Yang akan dibayar</div>
            <div class="card-body">
                <form action="" method="post" class="form_tagihannya">
                    <div class="input_tagihan">
                        <div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-warning float-right" onclick="hitungpembayaran()"><i
                        class="bi bi-arrow-counterclockwise mr-1"></i> Hitung</button>
            </div>
        </div>
        <div class="form_gt mt-2"></div>
        <div class="formnotif">

        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabeltagihan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });

    function isback() {
        $('.v2').attr('hidden', true)
        $('.v1').removeAttr('hidden', true)
    }
    $(".pilihtagihan").on('click', function(event) {
        iddetail = $(this).attr('iddetail')
        id_header = $(this).attr('id_header')
        nama_tarif = $(this).attr('nama_tarif')
        tarif = $(this).attr('tarif')
        grandtotal = $(this).attr('grandtotal')
        qty = $(this).attr('qty')
        var wrapper = $(".input_tagihan");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Tarif / Tindakan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namatarif" value="' +
            nama_tarif +
            '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="idheader" value="' +
            id_header +
            '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="iddetail" value="' +
            iddetail +
            '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jlh</label><input readonly type="" class="form-control form-control-sm" id="" name="qty" value="' +
            qty +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
            tarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Grandtotal</label><input readonly type="" class="form-control form-control-sm" id="" name="grandtotal" value="' +
            grandtotal +
            '"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

    function hitungpembayaran() {
        var data = $('.form_tagihannya').serializeArray();
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('hitungpembayaran') ?>',
            error: function(response) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(response) {
                spinnerof()
                $('.form_gt').html(response);
            }
        });
    }
    function bayar()
    {
        var data2 = $('.form_tagihannya').serializeArray();
        var data = $('.formgtt').serializeArray();
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                data2: JSON.stringify(data2),
            },
            url: '<?= route('bayartagihan') ?>',
            error: function(response) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(response) {
                spinnerof()
                $('.formnotif').html(response);
            }
        });
    }
</script>

<table id="tabelmasterbarang" class="table table-sm table-bordered">
    <thead>
        <th>Nama Barang</th>
        <th>Nama Generik</th>
        <th>Dosis</th>
        <th>Aturan Pakai</th>
        <th>Satuan Besar</th>
        <th>Satuan Sedang</th>
        <th>Satuan Kecil</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($barang as $b)
            <tr>
                <td>{{ $b->nama_barang }}</td>
                <td>{{ $b->nama_generik }}</td>
                <td>{{ $b->dosis }}</td>
                <td>{{ $b->aturan_pakai }}</td>
                <td>{{ $b->satuan_besar }}</td>
                <td>{{ $b->satuan_sedang }}</td>
                <td>{{ $b->satuan_kecil }}</td>
                <td>
                    <button class="btn btn-info btn-sm detailobat" data-toggle="modal" data-target="#modaldetailobat"
                        idobat="{{ $b->id }}"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-success btn-sm inputstok" data-toggle="modal" data-target="#modalinputstok"
                        idobat="{{ $b->id }}"><i class="bi bi-database-add"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetailobat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_obat">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalinputstok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Stok Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_form_stok_obat">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanstok()" data-dismiss="modal">Simpan Stok</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabelmasterbarang").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });
    $(".inputstok").on('click', function(event) {
        idobat = $(this).attr('idobat')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idobat
            },
            url: '<?= route('ambil_form_stok_obat') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_form_stok_obat').html(response);
            }
        });
    });

    function simpanstok() {
        var data = $('.forminputstok').serializeArray();
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpastok') ?>',
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
                }
            }
        });
    }

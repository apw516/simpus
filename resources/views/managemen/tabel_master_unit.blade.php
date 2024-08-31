<table id="tabel_master_unit" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Kode Unit</th>
        <th>Nama Unit</th>
        <th>Status</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($unit as $td)
            <tr>
                <td>{{ $td->kode_unit }}</td>
                <td>{{ $td->nama_unit }}</td>
                <td>
                    @if($td->status == 1)AKTIF @endif
                    @if($td->status == 0)TIDAK AKTIF @endif
                </td>
                <td><button idunit="{{ $td->id }}" class="btn btn-warning btn-sm pilihunit" data-toggle="modal"
                        data-target="#modaldetailunit"><i class="bi bi-pencil-square"></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetailunit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_unit">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpaneditunit()">Simpan Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabel_master_unit").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihunit").on('click', function(event) {
        idunit = $(this).attr('idunit')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idunit
            },
            url: '<?= route('ambil_detail_unit') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_detail_unit').html(response);
            }
        });
    });
    function simpaneditunit()
    {
        var data = $('.formeditunit').serializeArray();
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpaeditunit') ?>',
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

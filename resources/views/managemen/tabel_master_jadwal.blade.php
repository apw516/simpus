<table id="tabeljadwalpoli" class="table table-sm table-hover table-bordered mt-3">
    <thead>
        <th>Hari</th>
        <th>Jam praktek</th>
        <th>Nama Poli</th>
        <th>Nama Dokter</th>
        <th>Status</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($jadwal as $j )
            <tr>
                <td>{{ $j->nama_hari }}</td>
                <td>{{ $j->jam_praktek }}</td>
                <td>{{ $j->nama_unit }}</td>
                <td>{{ $j->nama_dokter }}</td>
                <td>@if($j->status_jadwal == 1)Aktif @else Libur @endif</td>
                <td>
                    <button idjadwal="{{ $j->idjadwal }}" class="btn btn-warning btn-sm pilihjadwal" data-toggle="modal"
                        data-target="#modaleditjadwal"><i class="bi bi-pencil-square"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="modaleditjadwal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_jadwal">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpaneditjadwal()">Simpan Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabeljadwalpoli").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihjadwal").on('click', function(event) {
        idjadwal = $(this).attr('idjadwal')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idjadwal
            },
            url: '<?= route('ambil_detail_jadwal') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_detail_jadwal').html(response);
            }
        });
    });
function simpaneditjadwal(){
    var data = $('.formeditjadwal').serializeArray();
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpaneditjadwal') ?>',
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

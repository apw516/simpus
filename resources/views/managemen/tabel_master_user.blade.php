<table id="tabel_master_user" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama</th>
        <th>Username</th>
        <th>Unit</th>
        <th>Id pegawai</th>
        <th>Hak Akses</th>
        <th>Status</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($user as $u)
            <tr>
                <td>{{ $u->nama }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->nama_unit }}</td>
                <td>{{ $u->id_pegawai }}</td>
                <td>{{ $u->nama_akses }}</td>
                <td>
                    @if ($u->status_user == '1')
                        Aktif
                    @else
                        Tidak aktif
                    @endif
                </td>
                <td><button iduser="{{ $u->id_user }}" class="btn btn-warning btn-sm pilihuser" data-toggle="modal"
                        data-target="#modaldetailuser"><i class="bi bi-pencil-square"></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetailuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_user">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanedituser()">Simpan Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabel_master_user").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihuser").on('click', function(event) {
        id_user = $(this).attr('iduser')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id_user
            },
            url: '<?= route('ambil_detail_user') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_detail_user').html(response);
            }
        });
    });
    function simpanedituser() {
        var data = $('.formedituser').serializeArray();
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpaedituser') ?>',
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

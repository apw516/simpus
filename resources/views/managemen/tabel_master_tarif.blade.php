<table id="tabel_master_unit" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Kode Tarif</th>
        <th>Nama Tarif</th>
        <th>Tarif</th>
        <th>Status</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($tarif as $td)
            <tr>
                <td>{{ $td->id }}</td>
                <td>{{ $td->nama_tarif }}</td>
                <td>{{ $td->tarif }}</td>
                <td>
                    @if($td->status == 1)AKTIF @endif
                    @if($td->status == 0)TIDAK AKTIF @endif
                </td>
                <td><button idtarif="{{ $td->id }}" class="btn btn-warning btn-sm pilihtarif" data-toggle="modal"
                        data-target="#modaldetailtarif"><i class="bi bi-pencil-square"></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetailtarif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tarif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_tarif">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanedittarif()">Simpan Edit</button>
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
    $(".pilihtarif").on('click', function(event) {
        idtarif = $(this).attr('idtarif')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idtarif
            },
            url: '<?= route('ambil_detail_tarif') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_detail_tarif').html(response);
            }
        });
    });
    function simpanedittarif()
    {
        var data = $('.formedittarif').serializeArray();
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanedittarif') ?>',
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

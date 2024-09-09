<table class="mt-2 table table-sm table-hover table-bordered" id="tableriwayatpelayanan">
    <thead>
        <th>Tanggal Masuk</th>
        <th>Counter</th>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Tujuan</th>
        <th>Status Kunjungan</th>
        <th>Pic</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($data_pelayanan as $da)
            <tr>
                <td>{{ $da->tgl_entry_kunjungan }}</td>
                <td>{{ $da->counter }}</td>
                <td>{{ $da->no_rm }}</td>
                <td>{{ $da->nama_pasien }}</td>
                <td>{{ $da->nama_unit }}</td>
                <td>
                    @if ($da->status_kunjungan == 1)
                        Aktif
                    @elseif($da->status_kunjungan == 2)
                        Selesai
                    @elseif($da->status_kunjungan == 3)
                        Batal
                    @endif
                </td>
                <td>{{ $da->nama }}</td>
                <td>
                    <button kodekunjungan="{{ $da->id_kunjungan }}" class="btn btn-warning btn-sm mr-1 editkunjungan"
                        data-toggle="modal" data-target="#modaleditkunjungan"><i class="bi bi-pencil-square"></i></button>
                    <button kodekunjungan="{{ $da->id_kunjungan }}" class="btn btn-info btn-sm mr-1 detailkunjungan"
                        data-toggle="modal" data-target="#modaldetailkunjungan"><i
                            class="bi bi-info-circle"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modaleditkunjungan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_edit_kunjungan"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpaneditkunjungan()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaldetailkunjungan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_kunjungan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tableriwayatpelayanan").DataTable({
            "title": 'Riwayat Pelayan Pasien',
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
    });
    $(".editkunjungan").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('formeditkunjungan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_edit_kunjungan').html(response);
            }
        });
    });
    $(".detailkunjungan").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('detailkunjungan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_detail_kunjungan').html(response);
            }
        });
    });

    function simpaneditkunjungan() {
        var data = $('.formeditkunjungan').serializeArray();
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpaneditkunjungan') ?>',
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

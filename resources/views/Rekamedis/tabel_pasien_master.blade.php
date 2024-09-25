<table id="tabelpasien" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nomor Identitas</th>
        <th>NO RM</th>
        <th>Nama Pasien</th>
        <th>Jenis Kelamin</th>
        <th>Tgl Lahir</th>
        <th>Alamat</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($pasien as $p)
            <tr>
                <td>{{ $p->nomor_identitas }}</td>
                <td>{{ $p->no_rm }}</td>
                <td>{{ $p->nama_pasien }}</td>
                <td>
                    @if ($p->jenis_kelamin == 1)
                        Laki - Laki
                    @else
                        Perempuan
                    @endif
                </td>
                <td>{{ $p->tanggal_lahir }}</td>
                <td>{{ $p->alamat }}</td>
                <td>
                    <button norm="{{ $p->no_rm }}" class="btn btn-sm btn-info pilihpasien"><i
                            class="bi bi-journal-plus mr-1"></i> Berkas RM</button>
                    <button norm="{{ $p->no_rm }}" class="btn btn-sm btn-warning editpasien" data-toggle="modal"
                        data-target="#modaleditpasien"><i class="bi bi-pencil-square mr-1"></i> Edit Data</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaleditpasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_form_edit_pasien">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpaneditpasien()">Simpan Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabelpasien").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihpasien").on('click', function(event) {
        norm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                norm
            },
            url: '<?= route('ambilberkaserm') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v1').attr('Hidden', true);
                $('.v2').removeAttr('hidden', true);
                $('.v2').html(response);
            }
        });
    });
    $(".editpasien").on('click', function(event) {
        norm = $(this).attr('norm')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                norm
            },
            url: '<?= route('ambildetailpasien') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_form_edit_pasien').html(response);
            }
        });
    });

    function simpaneditpasien() {
        var data = $('.formeditpasienbaru').serializeArray();
        Swal.fire({
            title: "Apakah data pasien akan diedit ?",
            text: "Klik OK jika ya ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                spinneron()
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                    },
                    url: '<?= route('simpaneditpasien') ?>',
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
        });
    }
</script>

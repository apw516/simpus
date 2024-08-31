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
        @foreach ($pasien as $p )
            <tr>
                <td>{{ $p->NIK}}</td>
                <td>{{ $p->no_rm}}</td>
                <td>{{ $p->nama_pasien}}</td>
                <td>@if($p->jenis_kelamin == 1)Laki - Laki @else Perempuan @endif</td>
                <td>{{ $p->TGL_LAHIR}}</td>
                <td>{{ $p->alamat}}</td>
                <td>
                    <button norm="{{ $p->no_rm }}" class="btn btn-sm btn-info pilihpasien"><i class="bi bi-journal-plus mr-1"></i> Berkas RM</button>
                    <button norm="{{ $p->no_rm }}" class="btn btn-sm btn-warning editpasien"><i class="bi bi-pencil-square mr-1"></i> Edot Data</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
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
            url: '<?= route('ambilformpendaftaran') ?>',
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
    });
</script>

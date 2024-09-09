<table id="tabelpasien" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tanggal Masuk</th>
        <th>Counter</th>
        <th>No RM</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Status</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data_kunjungan as $d)
            <tr>
                <td>{{ $d->tgl_masuk }}</td>
                <td>{{ $d->counter }}</td>
                <td>{{ $d->no_rm }}</td>
                <td>{{ $d->nama_pasien }}</td>
                <td>
                    @if ($d->jenis_kelamin == 1)
                        Laki - Laki
                    @else
                        Perempuan
                    @endif
                </td>
                <td>{{ $d->alamat }}</td>
                <td>
                    @if ($d->status_pemeriksaan == 0)
                        Belum diperiksa dokter
                    @else
                        Sudah diperiksa doker
                    @endif
                </td>
                <td>
                    <button class="btn btn-success pilihpasien" norm="{{ $d->no_rm }}"
                        kodekunjungan="{{ $d->id_kunjungan }}"><i class="bi bi-box-arrow-in-right"></i></button>
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
        kodekunjungan = $(this).attr('kodekunjungan')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                norm,
                kodekunjungan
            },
            url: '<?= route('ambil_data_order') ?>',
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
</script>

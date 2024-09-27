<table class="table table-sm table-bordered">
    <thead>
        <th>Nama Obat</th>
        <th>Aturan Pakai</th>
        <th>Dosis</th>
        <th>QTY</th>
        <th>Sediaan</th>
        <th>Status</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->nama_barang }}</td>
                <td>{{ $d->aturan_pakai }}</td>
                <td>{{ $d->dosis }}</td>
                <td>{{ $d->jumlah_layanan }}</td>
                <td>{{ $d->sediaan }}</td>
                <td>
                    @if ($d->status_layanan == 1)
                        Belum diproses
                    @endif
                </td>
                <td>
                    @if ($d->status_layanan_detail == 'CLS')
                        Sudah dibayar
                    @else
                        <button type="button" class="btn btn-danger returobat" iddetail="{{ $d->id_detail }}">retur</button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(".returobat").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin akan retur obat ?",
            text: "Klik OK untuk simpan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                iddetail = $(this).attr('iddetail')
                spinneron()
                $.ajax({
                    async: true,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        iddetail
                    },
                    url: '<?= route('retur_tindakan') ?>',
                    error: function(data) {
                        spinnerof()
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
                            $('#modalriwayatresep').modal('toggle');
                        }
                    }
                });
            }
        });
    });
</script>

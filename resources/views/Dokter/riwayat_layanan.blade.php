<table class="table table-sm table-bordered">
    <thead>
        <th>Tgl masuk</th>
        <th>Counter</th>
        <th>NO RM</th>
        <th>Pasien</th>
        <th>Unit Tujuan</th>
        <th>Dokter Pemeriksa</th>
        <th>Status Kunjungan</th>
    </thead>
    <tbody>
        <tr>
            <td>{{ $data_pelayanan[0]->tgl_masuk }}</td>
            <td>{{ $data_pelayanan[0]->counter }}</td>
            <td>{{ $data_pelayanan[0]->no_rm }}</td>
            <td>{{ $data_pelayanan[0]->nama_pasien }}</td>
            <td>{{ $data_pelayanan[0]->nama_unit }}</td>
            <td>{{ $data_pelayanan[0]->nama_dokter }}</td>
            <td>
                @if ($data_pelayanan[0]->status_kunjungan == 1)
                    Aktif
                @elseif($data_pelayanan[0]->status_kunjungan == 2)
                    Selesai
                @elseif($data_pelayanan[0]->status_kunjungan == 2)
                    Bata
                @endif
            </td>
        </tr>
    </tbody>
</table>
<div class="card">
    <div class="card-header">Data Tagihan</div>
    <div class="card-body">
        <table id="tabeltagihan" class="table table-bordered table-hover table-sm">
            <thead>
                <th>Nama Tarif</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Grand Total</th>
                <th>Status</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->nama_tarif }}</td>
                        <td>{{ $d->jumlah_layanan }}</td>
                        <td>{{ $d->tarif }}</td>
                        <td>{{ $d->total_tarif }}</td>
                        <td>{{ $d->status_layanan_detail }}</td>
                        <td>
                           @if($d->status_layanan_detail == 'CLS')
                            Sudah dibayar
                           @else
                           <button class="btn btn-danger retur" iddetail="{{ $d->id_detail }}" data-dismiss="modal">retur</button>
                           @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(".retur").on('click', function(event) {
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
                }
            }
        });
    });
</script>

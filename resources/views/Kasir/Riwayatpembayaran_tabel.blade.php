<table id="tabelriwayatbayar" class="table table-sm table-bordered">
    <thead>
        <th>Tanggal entry</th>
        <th>Nomor RM</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tagihan</th>
        <th>Uang Bayar</th>
        <th>Kembalian</th>
    </thead>
    <tbody>
        @foreach ($data as $d )
            <tr>
                <td>{{ $d->tgl_resep }}</td>
                <td>{{ $d->no_rm }}</td>
                <td>{{ $d->nama_pasien }}</td>
                <td>{{ $d->alamat }}</td>
                <td>RP. {{ number_format($d->jumlah_tagihan, 2) }}</td>
                <td>RP. {{ number_format($d->jumlah_bayar, 2) }} </td>
                <td>RP. {{ number_format($d->kembalian, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
       $(function() {
        $("#tabelriwayatbayar").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });
</script>

<table class="table table-sm text-xs table-hover">
    <thead>
        <th>Nama Obat</th>
        <th>Tgl Stok</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Stok In</th>
        <th>Stok Out</th>
        <th>Stok last</th>
        <th>Stok Current</th>
    </thead>
    <tbody>
        @foreach ($data as $d )
            <tr>
                <td>{{ $d->nama_barang }}</td>
                <td>{{ $d->tglstok }}</td>
                <td> RP. {{ number_format($d->harga_beli, 2) }}</td>
                <td>RP. {{ number_format($d->harga_jual, 2) }}</td>
                <td>{{ $d->stok_in }}</td>
                <td>{{ $d->stok_out }}</td>
                <td>{{ $d->stok_last }}</td>
                <td>{{ $d->stok_current }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

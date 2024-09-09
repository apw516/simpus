@foreach ($kasirheader as $kh)
    <div class="card">
        <div class="card-header">ID HEADER : {{ $kh->id }} | TANGGAL : {{ $kh->tgl_entry }}</div>
        <div class="card-body">
            <table class="table table-sm table-bordered text-xs font-italic">
                <thead>
                    <th>Nama Tarif / Obat</th>
                    <th>Jumlah Layanan</th>
                    <th>Tarif</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    @foreach ($kasirdetail as $dk)
                        @if ($dk->idh == $kh->id)
                            <tr>
                                <td>{{ $dk->nama_tarif }} {{ $dk->nama_barang }}</td>
                                <td>{{ $dk->jumlah_layanan }}</td>
                                <td>RP. {{ number_format($dk->trfs, 2) }}</td>
                                <td>RP. {{ number_format($dk->total_tarif, 2) }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <table class="table table-sm text-xs table-bordered">
                <thead>
                    <th>Total Tagihan </th>
                    <th>Total Bayar</th>
                    <th>Total Kembalian</th>
                </thead>
                <tbody>
                    <tr>
                        <td>RP. {{ number_format($kh->jumlah_tagihan, 2) }}</td>
                        <td>RP. {{ number_format($kh->jumlah_bayar, 2) }}</td>
                        <td>RP. {{ number_format($kh->kembalian, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endforeach

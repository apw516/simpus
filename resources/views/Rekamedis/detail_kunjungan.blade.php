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
                <th>Nama Tarif / Obat</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Grand Total</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->nama_tarif }} {{ $d->nama_barang }}</td>
                        <td>{{ $d->jumlah_layanan }}</td>
                        <td>{{ $d->tarif_2 }}</td>
                        <td>{{ $d->total_tarif }}</td>
                        <td>{{ $d->status_layanan_detail }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--

@foreach ($header_tagihan as $hd)
    <div class="card">
        <div class="card-header bg-light">Kode header : {{ $hd->id }}
            <a class="float-right text-dark text-bold">Status Layanan:  @if ($hd->status_layanan == 1) Belum dibayar
                @elseif($hd->status_layanan == 1) Sudah dibayar
                @elseif($hd->status_layanan == 3) Retur
                @endif
            </a></div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <th>Nama Tarif</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach ($detail_tagihan as $dt)
                        @if ($dt->id_header == $hd->id)
                        <tr>
                            <td>{{ $dt->nama_tarif}}</td>
                            <td>{{ $dt->jumlah_layanan}}</td>
                            <td>{{ $dt->total_tarif}}</td>
                            <td>{{ $dt->status_layanan_detail}}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach --}}

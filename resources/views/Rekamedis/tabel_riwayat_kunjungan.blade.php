<table id="tabelriwayatkunjungan" class="table table-sm table-hover table-bordered">
    <thead>
        <th>Kunjungan Ke - </th>
        <th>Tgl Masuk</th>
        <th>Tgl Entry</th>
        <th>Nama Unit</th>
        <th>Nama Dokter</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($mt_kunjungan as $k )
            <tr>
                <td>{{ $k->counter}}</td>
                <td>{{ $k->tgl_masuk}}</td>
                <td>{{ $k->tgl_entry}}</td>
                <td>{{ $k->nama_unit}}</td>
                <td>{{ $k->nama_dokter}}</td>
                <td>@if($k->status == 1)Aktif @elseif($k->status == 2)Selesai @endif</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
       $("#tabelriwayatkunjungan").DataTable({
           "responsive": false,
           "lengthChange": false,
           "autoWidth": true,
           "pageLength": 8,
           "searching": true,
           "ordering": false,
       })
   });

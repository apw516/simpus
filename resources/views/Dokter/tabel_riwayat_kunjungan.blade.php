<table class="table table-sm table-bordered table-hover" id="tabelriwayatpasien">
    <thead>
        <th>Tgl masuk</th>
        <th>Unit</th>
        <th>Dokter</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data_store as $d)
            <tr>
                <td>{{ $d->tgl_masuk }}</td>
                <td>{{ $d->nama_unit }}</td>
                <td>{{ $d->nama_dokter }}</td>
                <td>
                    <button class="btn btn-info"><i class="bi bi-ticket-detailed"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayatpasien").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "ordering": false,
        })
    });

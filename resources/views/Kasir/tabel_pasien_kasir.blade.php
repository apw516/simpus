<table id="tabelriwayatkunjungan" class="table table-sm table-hover table-bordered">
    <thead>
        <th>Kunjungan Ke - </th>
        <th>Tgl Masuk</th>
        <th>Tgl Entry</th>
        <th>Nama Pasien</th>
        <th>Nama Unit</th>
        <th>Status</th>
        <th>action</th>
    </thead>
    <tbody>
        @foreach ($data_kunjungan as $k)
            <tr>
                <td>{{ $k->counter }}</td>
                <td>{{ $k->tgl_masuk }}</td>
                <td>{{ $k->tgl_entry }}</td>
                <td>{{ $k->nama_pasien }}</td>
                <td>{{ $k->nama_unit }}</td>
                <td>
                    @if ($k->status == 1)
                        Aktif
                    @elseif($k->status == 2)
                        Selesai
                    @endif
                </td>
                <td>
                    <button class="btn btn-success bayar" idkunjungan={{ $k->id_kunjungan }}><i
                            class="bi bi-cash-coin"></i></button>
                    <button class="btn btn-info ml-1 infoinvoice" idkunjungan={{ $k->id_kunjungan }}><i class="bi bi-receipt"></i></button>
                    <button class="btn btn-warning ml-1 infokasir" idkunjungan={{ $k->id_kunjungan }} data-toggle="modal"
                        data-target="#modalinfobayar"><i class="bi bi-info-square"></i></button>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modalinfobayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tagihan yang sudah dibayar </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_tagihan_selesai">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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

    $(".bayar").on('click', function(event) {
        idkunjungan = $(this).attr('idkunjungan')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idkunjungan
            },
            url: '<?= route('ambil_detail_pembayaran') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v1').attr('hidden', true)
                $('.v2').removeAttr('hidden', true)
                $('.v2').html(response);
            }
        });
    });

    $(".infoinvoice").on('click', function(event) {
        idkunjungan = $(this).attr('idkunjungan')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idkunjungan
            },
            url: '<?= route('ambil_detail_invoice') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v1').attr('hidden', true)
                $('.v2').removeAttr('hidden', true)
                $('.v2').html(response);
            }
        });
    });

    $(".infokasir").on('click', function(event) {
        idkunjungan = $(this).attr('idkunjungan')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idkunjungan
            },
            url: '<?= route('infoyangsudahdibayar') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_tagihan_selesai').html(response);
            }
        });
    });

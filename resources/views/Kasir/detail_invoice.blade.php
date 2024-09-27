<button class="btn btn-danger" onclick="isback()"><i class="bi bi-backspace mr-2"></i> Kembali</button>
<div class="card mt-4">
    <div class="card-header">Data Invoice</div>
    <div class="card-body">
        @foreach ($invoice_header as $h)
            <div class="card">
                <div class="card-header">Kode Invoice {{ $h->kode_invoice }} | Tanggal : {{ $h->tgl_invoice }} | Status :  @if($h->status == 2) Sudah dibayar @endif</div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped">
                        <thead class="bg-light">
                            <th>Nama Tarif</th>
                            <th>Qty</th>
                            <th>Tarif</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            @foreach ($invoice_detail as $ds)
                                @if ($h->id == $ds->id_header_inv)
                                    <tr>
                                        <td>{{ $ds->nama_tarif }}</td>
                                        <td>{{ $ds->qty }}</td>
                                        <td>RP. {{ number_format($ds->tarif, 2) }}</td>
                                        <td>RP. {{ number_format($ds->grandtotal, 2) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-center text-bold">Grandtotal</td>
                                <td>RP. {{ number_format($h->total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button @if($h->status == 2) disabled @endif type="button" class="btn btn-danger hapusinvoice" idinvoice="{{ $h->id }}"><i
                            class="bi bi-trash3 mr-1 ml-1"></i> Hapus</button>
                    <button @if($h->status == 2) disabled @endif type="button" class="btn btn-success float-right updateinvoice"
                        idinvoice="{{ $h->id }}"><i class="bi bi-cash-coin mr-1 ml-1"></i> Sudah Dibayar</button>
                    <button type="button" class="btn btn-info float-right cetakinvoice mr-1 ml-1"
                        kodeinvoice="{{ $h->kode_invoice }}"><i class="bi bi-printer mr-1 ml-1"></i> Cetak
                        Invoice</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function isback() {
        $('.v2').attr('hidden', true)
        $('.v1').removeAttr('hidden', true)
    }
    $(".hapusinvoice").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin akan hapus data invoice ?",
            text: "Klik OK untuk Hapus ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                idinvoice = $(this).attr('idinvoice')
                spinneron()
                $.ajax({
                    async: true,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        idinvoice
                    },
                    url: '<?= route('hapus_invoice') ?>',
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
            }
        });
    });
    $(".updateinvoice").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin akan data invoice sudah dibayar?",
            text: "Klik OK untuk Simpan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                idinvoice = $(this).attr('idinvoice')
                spinneron()
                $.ajax({
                    async: true,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        idinvoice
                    },
                    url: '<?= route('update_invoice') ?>',
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
            }
        });
    });
    $(".cetakinvoice").on('click', function(event) {
        kode = $(this).attr('kodeinvoice')
        window.open('cetakinvoice/' + kode);
    });
</script>

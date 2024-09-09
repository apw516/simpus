<button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace mr-1"></i> Kembali</button>

<div class="card mt-3">
    <div class="card-header">Detail Order</div>
    <div class="card-body">
        <form action="" class="formorder">
            @foreach ($data_order as $d)
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Nama Obat</label>
                        <input readonly type="text" class="form-control" id="namaobat" name="namaobat"
                            value="{{ $d->nama_barang }}">
                        <input readonly hidden type="text" class="form-control" id="kodeobat" name="kodeobat"
                            value="{{ $d->id_barang }}">
                        <input readonly hidden type="text" class="form-control" id="idheader" name="idheader"
                            value="{{ $d->idheader }}">
                        <input readonly hidden type="text" class="form-control" id="iddetail" name="iddetail"
                            value="{{ $d->iddetail }}">
                        <input readonly hidden type="text" class="form-control" id="kodekunjungan"
                            name="kodekunjungan" value="{{ $d->kode_kunjungan }}">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="inputEmail4">Jumlah</label>
                        <input type="text" class="form-control" id="qty" name="qty"
                            value="{{ $d->jumlah_layanan }}">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="inputEmail4">Dosis</label>
                        <input type="text" class="form-control" id="dosis" name="dosis"
                            value="{{ $d->dosis }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Aturan Pakai</label>
                        <textarea type="text" class="form-control" id="aturanpakai" name="aturanpakai">{{ $d->aturan_pakai }}</textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">Status</label>
                        <input readonly type="text" class="form-control" id="status_farmasi" name="status_farmasi" value="@if($d->status_farmasi == 1)Sudah dilayani @else belum dilayani @endif">
                    </div>
                </div>
            @endforeach
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-success float-right" onclick="layaniorderan()"><i class="bi bi-floppy mr-1 ml-1"></i>
            Simpan</button>
        <button class="btn btn-info float-right mr-1 ml-1" onclick="cetaknota()"><i class="bi bi-printer     mr-1 ml-1"></i>
            Cetak Nota</button>
    </div>
</div>

<script>
    function kembali() {
        $('.v2').attr('Hidden', true);
        $('.v1').removeAttr('hidden', true);
    }

    function layaniorderan() {
        Swal.fire({
            title: "Apakah data order sudah benar ?",
            text: "Klik OK jika sudah benar ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                var data2 = $('.formorder').serializeArray();
                spinneron()
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data2: JSON.stringify(data2)
                    },
                    url: '<?= route('simpanlayananorder') ?>',
                    error: function(data) {
                        spinnerof()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
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
                            location.reload()
                        }
                    }
                })
            }
        });
    }
    function cetaknota()
    {

    }
</script>

<div class="card">
    <div class="card-header text-bold">GRANDTOTAL</div>
    <div class="card-body">
        <form action="" class="formgtt">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Total Tagihan</label>
                        <input type="text" class="form-control" id="vgtt" name="vgtt"
                            placeholder="name@example.com" value="RP. {{ number_format($grandtotal, 2) }}">
                        <input hidden type="text" class="form-control" id="gtt" name="gtt"
                            placeholder="name@example.com" value="{{ $grandtotal }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Total Uang</label>
                        <input type="text" class="form-control" id="tu" name="tu"
                            placeholder="name@example.com">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success btnbayar" data-toggle="modal" data-target="#modalpembayaran"
                        style="margin-top:32px" onclick="bayar()"><i class="bi bi-arrow-counterclockwise mr-1" o></i>
                        Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalpembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah tagihan akan dibayar ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_total_bayar">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                <button type="button" class="btn btn-primary" onclick="bayar2()">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">Grandtotal</div>
    <div class="card-body">
        <form action="" class="formgtt">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Total Tagihan</label>
                        <input type="text" class="form-control" id="gtt" name="gtt"
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
                    <button type="button" class="btn btn-success" style="margin-top:32px" onclick="bayar()"><i
                            class="bi bi-arrow-counterclockwise mr-1" o></i> Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>

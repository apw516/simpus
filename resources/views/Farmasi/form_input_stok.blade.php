<form action="" class="forminputstok">
    <div class="form-group">
        <label for="exampleInputPassword1">Nama Obat</label>
        <input readonly type="text" class="form-control" id="namaobat" name="namaobat" value="{{ $namaobat }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Stok Masuk (Satuan Kecil)</label>
        <input type="text" class="form-control" id="jlh" name="jlh" aria-describedby="emailHelp">
        <input hidden type="text" class="form-control" id="idobat" name="idobat" value="{{ $idobat}}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Harga Beli (Satuan Kecil )</label>
        <input type="text" class="form-control" id="hargabeli" name="hargabeli">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Harga Jual (Satuan Kecil)</label>
        <input type="text" class="form-control" id="hargajuak" name="hargajual">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Expired Date</label>
        <input type="date" class="form-control" id="ed" name="ed">
    </div>
</form>

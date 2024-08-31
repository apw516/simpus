<form class="formeditunit">
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Unit</label>
        <input type="text" class="form-control" id="namaunit" name="namaunit" aria-describedby="emailHelp"
            value="{{ $unit[0]->nama_unit }}">
        <input hidden type="text" class="form-control" id="idunit" name="idunit" aria-describedby="emailHelp"
            value="{{ $unit[0]->id }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Status</label>
        <select class="form-control" id="status" name="status">
            <option @if ($unit[0]->status == 1) selected @endif value="1">Aktif</option>
            <option @if ($unit[0]->status == 0) selected @endif value="0">Tidak Aktif</option>
        </select>
    </div>
</form>

<form class="formedittarif">
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Tarif</label>
        <input type="text" class="form-control" id="namatarif" name="namatarif" aria-describedby="emailHelp"
            value="{{ $tarif[0]->nama_tarif }}">
        <input hidden type="text" class="form-control" id="idtarif" name="idtarif" aria-describedby="emailHelp"
            value="{{ $tarif[0]->id }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tarif</label>
        <input type="text" class="form-control" id="tarif" name="tarif" aria-describedby="emailHelp"
            value="{{ $tarif[0]->tarif }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Status</label>
        <select class="form-control" id="status" name="status">
            <option @if ($tarif[0]->status == 1) selected @endif value="1">Aktif</option>
            <option @if ($tarif[0]->status == 0) selected @endif value="0">Tidak Aktif</option>
        </select>
    </div>
</form>

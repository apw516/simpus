<form class="formeditpegawai">
    <div class="form-group">
        <label for="exampleInputEmail1">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" aria-describedby="emailHelp"
            value="{{ $pegawai[0]->nip }}">
        <input hidden readonly type="text" class="form-control" id="idpegawai" name="idpegawai"
            aria-describedby="emailHelp" value="{{ $pegawai[0]->id }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama"
            value="{{ $pegawai[0]->nama }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Jabatan</label>
        <input type="text" class="form-control" id="jabatan" name="jabatan"
            value="{{ $pegawai[0]->jabatan }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Status</label>
        <select class="form-control" id="status" name="status">
            <option @if ($pegawai[0]->status == 0) selected @endif value="0">Tidak Aktif</option>
            <option @if ($pegawai[0]->status == 1) selected @endif value="1">Aktif</option>
        </select>
    </div>
</form>

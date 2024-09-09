<form class="formeditpasienbaru">
    <div class="form-group">
        <label for="exampleInputEmail1">Nomor Identitas</label>
        <input type="text" class="form-control" id="nomoridentitas" name="nomoridentitas"
            aria-describedby="emailHelp" value="{{ $mt_pasien[0]->nomor_identitas}}">
        <input hidden type="text" class="form-control" id="norm" name="norm"
            aria-describedby="emailHelp" value="{{ $mt_pasien[0]->no_rm}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nomor Telepon</label>
        <input type="text" class="form-control" id="nomorhp" name="nomorhp"
            aria-describedby="emailHelp" value="{{ $mt_pasien[0]->nomor_telepon}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Lengkap</label>
        <input type="text" class="form-control" id="namalengkap" name="namalengkap"
            aria-describedby="emailHelp" value="{{ $mt_pasien[0]->nama_pasien}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Jenis Kelamin</label>
        <select class="form-control" id="jeniskelamin" name="jeniskelamin">
            <option value="1" @if($mt_pasien[0]->jenis_kelamin == 1) selected @endif>Laki Laki</option>
            <option value="2" @if($mt_pasien[0]->jenis_kelamin == 2) selected @endif>Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tempat lahir</label>
        <input type="text" class="form-control" id="tempatlahir" name="tempatlahir"
            aria-describedby="emailHelp" value="{{ $mt_pasien[0]->tempat_lahir}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal lahir</label>
        <input type="date" class="form-control" id="tanggallahir" name="tanggallahir"
            aria-describedby="emailHelp" value="{{ $mt_pasien[0]->tanggal_lahir}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Alamat</label>
        <textarea type="text" class="form-control" id="alamat" name="alamat" aria-describedby="emailHelp">{{ $mt_pasien[0]->alamat}}</textarea>
    </div>
</form>

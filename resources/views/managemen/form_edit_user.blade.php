<form class="formedituser">
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input readonly type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp"
            value="{{ $user[0]->nama }}">
        <input hidden readonly type="text" class="form-control" id="iduser" name="iduser"
            aria-describedby="emailHelp" value="{{ $user[0]->id_user }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input readonly type="text" class="form-control" id="username" name="username"
            value="{{ $user[0]->username }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">ID Pegawai</label>
        <input type="text" class="form-control" id="idpegawai" name="idpegawai"
            value="{{ $user[0]->id_pegawai }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Unit</label>
        <select class="form-control" id="unit" name="unit">
            @foreach ($unit as $unit)
                <option @if ($user[0]->kode_unit == $unit->kode_unit) selected @endif value="{{ $unit->kode_unit }}">
                    {{ $unit->nama_unit }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Hak Akses</label>
        <select class="form-control" id="hak_akses" name="hak_akses">
            @foreach ($hakakses as $h)
                <option @if ($user[0]->hak_akses == $h->kode_akses) selected @endif value="{{ $h->kode_akses }}">
                    {{ $h->nama_akses }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Status</label>
        <select class="form-control" id="status" name="status">
            <option @if ($user[0]->status == 0) selected @endif value="0">Tidak Aktif</option>
            <option @if ($user[0]->status == 1) selected @endif value="1">Aktif</option>
        </select>
    </div>
</form>

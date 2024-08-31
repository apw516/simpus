<form class="formeditjadwal">
    <div class="form-group">
        <label for="exampleInputEmail1">Pilih Poliklinik</label>
        <select class="form-control" id="unit" name="unit">
            <option value="0">Silahkan Pilih</option>
            @foreach ($unit as $p)
                <option value="{{ $p->id }}" @if ($jadwal[0]->kode_unit == $p->id) selected @endif>{{ $p->nama_unit }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Pilih Dokter</label>
        <select class="form-control" id="dokter" name="dokter">
            <option value="0">Silahkan Pilih</option>
            @foreach ($pegawai as $p)
                <option value="{{ $p->id }}" @if ($jadwal[0]->id_dokter == $p->id) selected @endif>
                    {{ $p->nama }}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputEmail1">Pilih Hari</label>
            <select class="form-control" id="hari" name="hari">
                <option value="0">Silahkan Pilih</option>
                @foreach ($hari as $h)
                    <option value="{{ $h->id }}" @if ($jadwal[0]->hari == $h->id) selected @endif>
                        {{ $h->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="1" @if($jadwal[0]->status == 1) selected @endif>Aktif</option>
                <option value="0" @if($jadwal[0]->status == 0) selected @endif>Libur</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Masukan Jam</label>
            <input type="text" class="form-control" id="jampraktek" name="jampraktek"
                placeholder="cth: 08:00 - 11:00" aria-describedby="emailHelp" value="{{ $jadwal[0]->jam_praktek }}">
            <input hidden type="text" class="form-control" id="idjadwal" name="idjadwal"
                placeholder="cth: 08:00 - 11:00" aria-describedby="emailHelp" value="{{ $jadwal[0]->id }}">
        </div>
</form>

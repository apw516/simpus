<form class="formeditobat">
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Obat</label>
        <input type="text" class="form-control" id="namaobat" name="namaobat"
            aria-describedby="emailHelp" value="{{ $mt_barang[0]->nama_barang }}">
        <input type="text" class="form-control" id="idobat" name="idobat"
            aria-describedby="emailHelp" value="{{ $mt_barang[0]->id }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Generik</label>
        <input type="text" class="form-control" id="namagenerik" name="namagenerik"
            aria-describedby="emailHelp"  value="{{ $mt_barang[0]->nama_generik }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Aturan Pakai</label>
        <input type="text" class="form-control" id="aturanpakai" name="aturanpakai"
            aria-describedby="emailHelp"  value="{{ $mt_barang[0]->aturan_pakai }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Dosis</label>
        <input type="text" class="form-control" id="dosis" name="dosis"
            aria-describedby="emailHelp"  value="{{ $mt_barang[0]->dosis }}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Sediaan</label>
        <select class="form-control" id="sediaan" name="sediaan">
            <option value="-">Silahkan Pilih</option>
            @foreach ($sediaan as $s)
                <option value="{{ $s->id }}" @if($mt_barang[0]->sediaan == $s->id) selected @endif>{{ $s->nama_sediaan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Satuan Besar</label>
        <select class="form-control" id="satuanbesar" name="satuanbesar">
            <option value="-">Silahkan Pilih</option>
            @foreach ($satuan as $s)
                <option value="{{ $s->kode_satuan }}" @if($mt_barang[0]->satuan_besar == $s->kode_satuan) selected @endif>{{ $s->nama_satuan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Satuan Sedang</label>
        <select class="form-control" id="satuansedang" name="satuansedang">
            <option value="-">Silahkan Pilih</option>
            @foreach ($satuan as $s)
                <option value="{{ $s->kode_satuan }}" @if($mt_barang[0]->satuan_sedang == $s->kode_satuan) selected @endif>{{ $s->nama_satuan }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Satuan Kecil</label>
        <select class="form-control" id="satuankecil" name="satuankecil">
            <option value="-">Silahkan Pilih</option>
            @foreach ($satuan as $s)
                <option value="{{ $s->kode_satuan }}" @if($mt_barang[0]->satuan_kecil == $s->kode_satuan) selected @endif>{{ $s->nama_satuan }}</option>
            @endforeach
        </select>
    </div>
</form>

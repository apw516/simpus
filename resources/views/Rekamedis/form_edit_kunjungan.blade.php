<form class="formeditkunjungan">
    <input hidden type="text" class="form-control" name="rmpasien" id="rmpasien"
        value="{{ $data_pelayanan[0]->no_rm }}">
    <div class="form-group">
        <label for="exampleInputEmail1">Pilih Tujuan</label>
        <input type="text" class="form-control" id="namapoli" name="namapoli"
            placeholder="Silahkan cari tujuan periksa ..." value="{{ $data_pelayanan[0]->nama_unit }}">
        <input hidden type="text" class="form-control" id="kodepoli" name="kodepoli" value="{{ $data_pelayanan[0]->kode_unit }}">
        <input hidden type="text" class="form-control" id="kode_kunjungan" name="kode_kunjungan" value="{{ $id_kunjungan }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Pilih Dokter</label>
        <input type="text" class="form-control" id="namadokter" name="namadokter"
            placeholder="silahkan pilih dokter" value="{{ $data_pelayanan[0]->nama_dokter }}">
        <input hidden type="text" class="form-control" id="kodedokter" name="kodedokter" value="{{ $data_pelayanan[0]->kode_dokter }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Tgl Masuk</label>
        <input type="date" class="form-control" id="tglmasuk" name="tglmasuk"
            value="{{ $data_pelayanan[0]->tgl_masuk}}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="1" @if($data_pelayanan[0]->status_kunjungan == 1) selected @endif>Aktif</option>
            <option value="2" @if($data_pelayanan[0]->status_kunjungan == 2) selected @endif>Selesai</option>
            <option value="3" @if($data_pelayanan[0]->status_kunjungan == 3) selected @endif>Batal</option>
          </select>

    </div>
</form>
<script>
     $(document).ready(function() {
        $('#namapoli').autocomplete({
            source: "<?= route('cariunit') ?>",
            select: function(event, ui) {
                $('[id="namapoli"]').val(ui.item.label);
                $('[id="kodepoli"]').val(ui.item.kode);
            }
        });
    })
     $(document).ready(function() {
        $('#namapoli').autocomplete({
            source: "<?= route('cariunit') ?>",
            select: function(event, ui) {
                $('[id="namapoli"]').val(ui.item.label);
                $('[id="kodepoli"]').val(ui.item.kode);
            }
        });
        $('#namadokter').autocomplete({
            source: "<?= route('caridokter') ?>",
            select: function(event, ui) {
                $('[id="namadokter"]').val(ui.item.label);
                $('[id="kodedokter"]').val(ui.item.kode);
            }
        });
    })

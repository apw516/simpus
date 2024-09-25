<button class="btn btn-danger" onclick="kembali()">
    <i class="bi bi-backspace mr-1"></i> Kembali</button>
<div class="card mt-2">
    <div class="card-header">Berkas Elektronik Rekamedis Pasien</div>
    <div class="card-body">
        Data Tidak ditemukan
    </div>
</div>
<script>
    function kembali() {
        $('.v2').attr('Hidden', true);
        $('.v1').removeAttr('hidden', true);
    }

    function printerm() {
        rm = $('#rm').val()
        window.open('cetakberkaserm/' + rm);
    }
</script>

<?php

namespace App\Http\Controllers;

use App\Models\Kasir_detail;
use App\Models\Kasir_header;
use App\Models\Layanan_detail;
use App\Models\Layanan_header;
use App\Models\ts_invoice_detail;
use App\Models\ts_invoice_header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends RekamedisController
{
    public function indexkasir()
    {
        $menu = 'kasir';
        $date = $this->get_date();
        return view('Kasir.index_data_pasien_kasir', compact([
            'menu',
            'date'
        ]));
    }
    public function caripasienkasir(request $request)
    {
        $data_kunjungan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join user c on a.pic = c.id
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.status != ? and date(a.tgl_entry) between ? and ? order by a.id desc', [3, $request->awal, $request->akhir]);
        return view('Kasir.tabel_pasien_kasir', compact([
            'data_kunjungan'
        ]));
    }
    public function ambil_detail_pembayaran(Request $request)
    {
        $kodekunjungan = $request->idkunjungan;
        $data = db::select('select *,c.id as id_detail,b.id as id_header,c.tarif as tarif_2 from mt_kunjungan a inner join ts_layanan_header b on a.id = b.kode_kunjungan inner join ts_layanan_detail c on b.id = c.id_header left outer join mt_tarif d on c.id_tarif = d.id
        left outer join mt_barang e on c.id_barang = e.id
        where a.id = ? and c.status_layanan_detail = ?', [$kodekunjungan, 'OPN']);
        return view('Kasir.form_pembayaran', compact([
            'data'
        ]));
    }
    public function ambil_detail_invoice(Request $request)
    {
        $kodekunjungan = $request->idkunjungan;
        $invoice_header = DB::select('select * from ts_invoice_header a where a.kode_kunjungan = ?', [$kodekunjungan]);
        $invoice_detail = DB::select('select * from ts_invoice_header a inner join ts_invoice_detail b on a.id = b. id_header_inv where a.kode_kunjungan = ?', [$kodekunjungan]);
        return view('Kasir.detail_invoice', compact([
            'invoice_header',
            'invoice_detail'
        ]));
    }
    public function hapus_invoice(Request $request)
    {
        DB::table('ts_invoice_header')->where('id', $request->idinvoice)->delete();
        DB::table('ts_invoice_detail')->where('id_header_inv', $request->idinvoice)->delete();
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil dihapus !'
        ];
        echo json_encode($data);
        die;
    }
    public function update_invoice(Request $request)
    {
        $idheader = $request->idinvoice;
        ts_invoice_header::where('id', $idheader)->update(['status' => 2]);
        $detail_invoice = db::select('select * from ts_invoice_detail where id_header_inv = ?', [$idheader]);
        $header_invoice = db::select('select * from ts_invoice_header where id = ?', [$idheader]);
        $kasir_header = [
            'kode_kunjungan' => $header_invoice[0]->kode_kunjungan,
            'jumlah_bayar' => $header_invoice[0]->total,
            'jumlah_tagihan' => $header_invoice[0]->total,
            'kembalian' => 0,
            'tgl_entry' => $this->get_now(),
            'pic' => auth()->user()->id
        ];
        $kh = Kasir_header::create($kasir_header);
        foreach ($detail_invoice as $di) {
            $kasir_detail = [
                'id_header' => $kh->id,
                'id_layanan_header' => $di->headerlayanan,
                'id_layanan_detail' => $di->detaillayanan,
                'total_tagihan' => $di->grandtotal,
                'tgl_entry' => $this->get_now(),
                'pic' => auth()->user()->id,
            ];
            $kD = Kasir_detail::create($kasir_detail);
            Layanan_header::where('id', $di->headerlayanan)->update(['status_layanan' => 2]);
            Layanan_detail::where('id', $di->detaillayanan)->update(['status_layanan_detail' => 'CLS']);
        }
        $data = [
            'kode' => 200,
            'message' => 'Invoice berhasil dibayar !'
        ];
        echo json_encode($data);
        die;
    }
    public function hitungpembayaran(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'grandtotal') {
                $array_tagihan[] = $dataSet;
            }
        }
        $grandtotal = 0;
        // dd($dataSet['grandtotal']);
        foreach ($array_tagihan as $dd) {
            $total = intval($dd['grandtotal']);
            $grandtotal = $grandtotal + $total;
        }
        return view('Kasir.grandtotal_kasir', compact([
            'grandtotal'
        ]));
    }
    public function bayartagihan(Request $request)
    {
        $data2 = json_decode($_POST['data2'], true);
        foreach ($data2 as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'grandtotal') {
                $array_tagihan[] = $dataSet;
            }
        }
        $data = json_decode($_POST['data'], true);
        $kembalian = 0;
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet2[$index] = $value;
            if ($index == 'tu') {
                $arrgtt[] = $dataSet2;
            }
        }
        $kunjungan = db::select('select * from ts_layanan_header where id =? ', [$array_tagihan[0]['idheader']]);
        foreach ($arrgtt as $ar) {
            $kembalian = $ar['tu'] - $ar['gtt'];
            $kasir_header = [
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'jumlah_bayar' => $ar['tu'],
                'jumlah_tagihan' => $ar['gtt'],
                'kembalian' => $kembalian,
                'tgl_entry' => $this->get_now(),
                'pic' => auth()->user()->id
            ];
        }
        $kh = Kasir_header::create($kasir_header);
        foreach ($array_tagihan as $at) {
            $kasir_detail = [
                'id_header' => $kh->id,
                'id_layanan_header' => $at['idheader'],
                'id_layanan_detail' => $at['iddetail'],
                'total_tagihan' => $at['grandtotal'],
                'tgl_entry' => $this->get_now(),
                'pic' => auth()->user()->id,
            ];
            $kD = Kasir_detail::create($kasir_detail);
            Layanan_header::where('id', $at['idheader'])->update(['status_layanan' => 2]);
            Layanan_detail::where('id', $at['iddetail'])->update(['status_layanan_detail' => 'CLS']);
        }
        return view('Kasir.notif');
    }
    public function buatinvoice(Request $request)
    {
        $data2 = json_decode($_POST['data'], true);
        foreach ($data2 as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'grandtotal') {
                $array_tagihan[] = $dataSet;
            }
        }
        $layanan_header = db::select('select * from ts_layanan_header where id = ?', [$array_tagihan[0]['idheader']]);
        $kunjungan = db::select('select * from mt_kunjungan where id = ?', [$layanan_header[0]->kode_kunjungan]);
        $mt_pasien = db::select('select * from mt_pasien where no_rm = ?', [$kunjungan[0]->no_rm]);
        $kode_invoice = $this->get_kode_invoice();
        $header_invoice = [
            'kode_invoice' => $this->get_kode_invoice(),
            'kode_kunjungan' => $kunjungan[0]->id,
            'nomor_rm' => $kunjungan[0]->no_rm,
            'nama_pasien' => $mt_pasien[0]->nama_pasien,
            'alamat_pasien' => $mt_pasien[0]->alamat,
            'tgl_invoice' => $this->get_now(),
            'status' => 1,
            'pic' => auth()->user()->id,
            'nama_pic' => auth()->user()->nama,
        ];
        $header = ts_invoice_header::create($header_invoice);
        $total_header = 0;
        foreach ($array_tagihan as $ar) {
            $data_detail = [
                'id_header_inv' => $header->id,
                'nama_tarif' => $ar['namatarif'],
                'headerlayanan' => $ar['idheader'],
                'detaillayanan' => $ar['iddetail'],
                'qty' => $ar['qty'],
                'tarif' => $ar['tarif'],
                'grandtotal' => $ar['grandtotal'],
            ];
            $detail = ts_invoice_detail::create($data_detail);
            $total_header = $total_header + $ar['grandtotal'];
        }
        $updateheader = [
            'total' => $total_header
        ];
        ts_invoice_header::where('id', $header->id)->update($updateheader);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !',
            'kode_invoice' => $kode_invoice
        ];
        echo json_encode($data);
        die;
    }
    public function get_kode_invoice()
    {
        $q = DB::select('SELECT id,kode_invoice,RIGHT(kode_invoice,6) AS kd_max  FROM ts_invoice_header
        WHERE DATE(tgl_invoice) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'INV' . date('ymd') . $kd;
    }
    public function hitungulang(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $kembalian = 0;
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet2[$index] = $value;
            if ($index == 'tu') {
                $arrgtt[] = $dataSet2;
            }
        }
        $kembalian = $arrgtt[0]['tu'] - $arrgtt[0]['gtt'];
        return view('Kasir.hitungakhir', compact([
            'arrgtt',
            'kembalian'
        ]));
    }
    public function infoyangsudahdibayar(Request $request)
    {
        $kodekunjungan = $request->idkunjungan;
        $kasirheader = db::select('select * from ts_transaksi_kasir_header where kode_kunjungan = ?', [$kodekunjungan]);
        $kasirdetail = db::select('select *,b.id_header as idh,c.tarif as trfs from ts_transaksi_kasir_header a
        inner join ts_transaksi_kasir_detail b on a.id = b.id_header
        inner join ts_layanan_detail c on b.id_layanan_detail = c.id
        left outer join mt_barang d on c.id_barang = d.id
        left outer join mt_tarif e on c.id_tarif = e.id
        where a.kode_kunjungan = ?', [$kodekunjungan]);
        return view('Kasir.laporan_yang_sudah_dibayar', compact([
            'kasirheader',
            'kasirdetail'
        ]));
    }
    public function cetaknota($id)
    {
        $kasirheader = db::select('select * from ts_transaksi_kasir_header where id = ?', [$id]);
        $kasirdetail = db::select('select *,b.id_header as idh,c.tarif as trfs from ts_transaksi_kasir_header a
        inner join ts_transaksi_kasir_detail b on a.id = b.id_header
        inner join ts_layanan_detail c on b.id_layanan_detail = c.id
        left outer join mt_barang d on c.id_barang = d.id
        left outer join mt_tarif e on c.id_tarif = e.id
        where a.id = ?', [$id]);
        return view('Kasir.cetakankasir', compact([
            'kasirheader',
            'kasirdetail'
        ]));
    }
    public function riwayatpembayaran()
    {
        $menu = 'riwayatpembayaran';
        $date = $this->get_date();
        return view('Kasir.Riwayatpembayaran', compact([
            'menu',
            'date'
        ]));
    }
    public function caririwayatpembayaran(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $data = db::select('SELECT * ,a.tgl_entry as tgl_resep FROM ts_transaksi_kasir_header a
        INNER JOIN mt_kunjungan b ON a.`kode_kunjungan` = b.id
        INNER JOIN mt_pasien c ON b.`no_rm` = c.no_rm
        WHERE DATE(a.tgl_entry) BETWEEN ? AND ?', [$awal, $akhir]);
        return view('Kasir.Riwayatpembayaran_tabel', compact([
            'data'
        ]));
    }
    public function cetakriwayatbayar($awal, $akhir)
    {
        $data = db::select('SELECT * ,a.tgl_entry as tgl_resep FROM ts_transaksi_kasir_header a
        INNER JOIN mt_kunjungan b ON a.`kode_kunjungan` = b.id
        INNER JOIN mt_pasien c ON b.`no_rm` = c.no_rm
        WHERE DATE(a.tgl_entry) BETWEEN ? AND ?', [$awal, $akhir]);
        return view('Kasir.cetakan_riwayat_bayar', compact([
            'data',
            'awal',
            'akhir'
        ]));
    }
    public function Cetakinvoice($kodeinvoice)
    {
        $invoice_header = DB::select('select * from ts_invoice_header a inner join ts_invoice_detail b on a.id = b. id_header_inv where a.kode_invoice = ?', [$kodeinvoice]);
        $mt_pasien = DB::select('select * from mt_pasien where no_rm =?', [$invoice_header[0]->nomor_rm]);
        return view('Kasir.cetakaninvoice', compact([
            'invoice_header',
            'mt_pasien'
        ]));
    }
}

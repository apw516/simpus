<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Layanan_detail;
use App\Models\sediaanobat;
use App\Models\stokobat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmasiController extends RekamedisController
{
    public function indexmasterobat()
    {
        $menu = 'masterobat';
        $date = $this->get_date();
        $satuan = db::select('select * from mt_satuan');
        $sediaan = db::select('select * from mt_sediaan');
        return view('Farmasi.index_masterobat', compact([
            'menu',
            'date',
            'satuan',
            'sediaan'
        ]));
    }
    public function indexmasterorder()
    {
        $menu = 'masterorder';
        $date = $this->get_date();
        return view('Farmasi.index_master_order', compact([
            'menu',
            'date'
        ]));
    }
    public function caripasienorder(Request $request)
    {
        $data_kunjungan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.status != ? and date(a.tgl_entry) between ? and ? order by a.id desc', [3, $request->awal, $request->akhir]);
        return view('Farmasi.tabel_pasien_order', compact([
            'data_kunjungan'
        ]));
    }
    public function cetakresep($kodekunjungan)
    {
        $data_order = db::select('select *,a.id as idheader,b.id as iddetail from ts_layanan_header a
        inner join ts_layanan_detail b on a.id = b.id_header
        inner join mt_barang c on b.id_barang = c.id
        where a.kode_kunjungan = ? and a.kode_unit = ? and a.status_layanan = ? and b.status_layanan_detail = ?', [$kodekunjungan, '2004', 2, 'CLS']);
        return view('Farmasi.cetakan_resep', compact([
            'data_order'
        ]));
    }
    public function ambil_data_order(Request $request)
    {
        $kode_kunjungan = $request->kodekunjungan;
        $data_order = db::select('select *,a.id as idheader,b.id as iddetail from ts_layanan_header a
        inner join ts_layanan_detail b on a.id = b.id_header
        inner join mt_barang c on b.id_barang = c.id
        where a.kode_kunjungan = ? and a.kode_unit = ? and a.status_layanan = ? and b.status_layanan_detail = ?', [$kode_kunjungan, '2004', 2, 'CLS']);
        return view('Farmasi.detail_order_farmasi', compact([
            'data_order','kode_kunjungan'
        ]));
    }
    public function ambilmasterbarang()
    {
        $barang = db::select('select * from mt_barang');
        return view('Farmasi.tabel_master_barang', compact([
            'barang',
        ]));
    }
    public function simpanobat(request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_barang = [
            'nama_barang' => $dataSet['namaobat'],
            'nama_generik' => $dataSet['namagenerik'],
            'aturan_pakai' => $dataSet['aturanpakai'],
            'dosis' => $dataSet['dosis'],
            'sediaan' => $dataSet['sediaan'],
            'satuan_besar' => $dataSet['satuanbesar'],
            'satuan_sedang' => $dataSet['satuansedang'],
            'satuan_kecil' => $dataSet['satuankecil'],
            'tgl_entry' => $this->get_now(),
            'pic' => auth()->user()->id,
        ];
        Barang::create($data_barang);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaneditbarang(request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_barang = [
            'nama_barang' => $dataSet['namaobat'],
            'nama_generik' => $dataSet['namagenerik'],
            'aturan_pakai' => $dataSet['aturanpakai'],
            'dosis' => $dataSet['dosis'],
            'sediaan' => $dataSet['sediaan'],
            'satuan_besar' => $dataSet['satuanbesar'],
            'satuan_sedang' => $dataSet['satuansedang'],
            'satuan_kecil' => $dataSet['satuankecil'],
            'tgl_entry' => $this->get_now(),
            'pic' => auth()->user()->id,
        ];
        barang::where('id', $dataSet['idobat'])->update($data_barang);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function ambil_detail_obat(Request $request)
    {
        $namaobat = $request->namaobat;
        $idobat = $request->idobat;
        $mt_barang = db::select('select * from mt_barang where id =?',[$idobat]);
        $satuan = db::select('select * from mt_satuan');
        $sediaan = db::select('select * from mt_sediaan');
        return view('Farmasi.detail_obat',compact([
            'mt_barang','satuan','sediaan'
        ]));
    }
    public function ambil_form_stok_obat(Request $request)
    {
        $namaobat = $request->namaobat;
        $idobat = $request->idobat;
        return view('Farmasi.form_input_stok', compact([
            'idobat','namaobat'
        ]));
    }
    public function simpastok(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $stok = db::select('select * from kartu_stok_obat where id_obat = ? and id = (select max(id) from kartu_stok_obat where id_obat = ?)', [$dataSet['idobat'], $dataSet['idobat']]);
        if (count($stok) > 0) {
            $stokcurrent = $stok[0]->stok_current + $dataSet['jlh'];
            $stoklast = $stok[0]->stok_current;
        } else {
            $stokcurrent = $dataSet['jlh'];
            $stoklast = 0;
        }
        $datastok = [
            'id_obat' => $dataSet['idobat'],
            'stok_current' => $stokcurrent,
            'stok_last' => $stoklast,
            'stok_in' => $dataSet['jlh'],
            'harga_beli' => $dataSet['hargabeli'],
            'harga_jual' => $dataSet['hargajual'],
            'tglentry' => $this->get_now(),
            'pic' => auth()->user()->id,
        ];
        stokobat::create($datastok);
        $idobat = $dataSet['idobat'];
        $exp = $dataSet['ed'];

        $cek_sediaan = db::select('select * from kartu_persediaan_obat where id_barang = ? and tgl_expired = ?', [$idobat, $exp]);
        if (count($cek_sediaan) > 0) {
            $data_sediaan = [
                'last_update' => $this->get_now(),
                'stok_in' => $dataSet['jlh'],
                'stok_current' => $cek_sediaan[0]->stok_current + $dataSet['jlh'],
                'stok_last' => $cek_sediaan[0]->stok_current
            ];
            sediaanobat::where('id', $cek_sediaan[0]->id)->update($data_sediaan);
        } else {
            $data_sediaan = [
                'id_barang' => $idobat,
                'tgl_entry' => $this->get_now(),
                'last_update' => $this->get_now(),
                'stok_last' => 0,
                'stok_in' => $dataSet['jlh'],
                'stok_current' => $dataSet['jlh'],
                'tgl_expired' => $exp,
                'pic' => auth()->user()->id,
            ];
            sediaanobat::Create($data_sediaan);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanlayananorder(Request $request)
    {
        $data2 = json_decode($_POST['data2'], true);
        foreach ($data2 as $nama2) {
            $index2 = $nama2['name'];
            $value2 = $nama2['value'];
            $dataSet2[$index2] = $value2;
            if ($index2 == 'status_farmasi') {
                $array_layanan[] = $dataSet2;
            }
        }
        foreach ($array_layanan as $ar) {
            $stok = db::select('select * from kartu_stok_obat where id_obat = ? and id = (select max(id) from kartu_stok_obat where id_obat = ? )', [$ar['kodeobat'], $ar['kodeobat']]);
            if (count($stok) == 0) {
                $data = [
                    'kode' => 500,
                    'message' => 'Stok ' . $ar['namaobat'] . 'Tidak ada !'
                ];
                echo json_encode($data);
                die;
            }
        }
        foreach ($array_layanan as $ar) {
            if (trim($ar['status_farmasi']) == 'belum dilayani') {
                $stok = db::select('select * from kartu_stok_obat where id_obat = ? and id = (select max(id) from kartu_stok_obat where id_obat = ? )', [$ar['kodeobat'], $ar['kodeobat']]);
                if ($stok)
                    $stok_last = $stok[0]->stok_current;
                $stok_out = $ar['qty'];
                $stok_current = $stok_last - $stok_out;
                $data_stok = [
                    'nomor_dokumen' => $ar['iddetail'],
                    'id_obat' => $ar['kodeobat'],
                    'stok_last' => $stok_last,
                    'stok_in' => 0,
                    'stok_out' => $stok_out,
                    'stok_current' => $stok_current,
                    'harga_beli' => $stok[0]->harga_beli,
                    'harga_jual' => $stok[0]->harga_jual,
                    'tglentry' => $this->get_now(),
                    'pic' => auth()->user()->id,
                ];
                stokobat::create($data_stok);
                Layanan_detail::whereRaw('id = ?', array($ar['iddetail']))->update(['status_farmasi' => 1]);
            }
        }
        $data = [
            'kode' => 200,
            'message' => 'Data order berhasil dilayani !'
        ];
        echo json_encode($data);
        die;
    }
    public function info_stok_obat(Request $request)
    {
        $id = $request->idobat;
        $data = db::select('select *,a.id as idstok,a.tglentry as tglstok from kartu_stok_obat a
        inner join mt_barang b on a.id_obat = b.id
        where a.id_obat = ? order by idstok desc limit 10',[$id]);
        return view('Farmasi.tabel_info_stok',compact([
            'data'
        ]));
    }
}

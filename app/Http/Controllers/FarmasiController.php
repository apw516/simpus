<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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
    public function ambil_form_stok_obat(Request $request)
    {
        $idobat = $request->idobat;
        return view('Farmasi.form_input_stok',compact([
            'idobat'
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
        $stok = db::select('select * from kartu_stok_obat where id_obat = ? and id = (select max(id) from kartu_stok_obat where id_obat = ?)',[$dataSet['idobat'],$dataSet['idobat']]);
        if(count($stok) > 0){
            $stokcurrent = $stok[0]->stok_current + $dataSet['jlh'];
            $stoklast = $stok[0]->stok_current;
        }else{
            $stokcurrent = $dataSet['jlh'];
            $stoklast = 0;
        }
        $datastok = [
            'id_obat'=> $dataSet['idobat'],
            'stok_current'=> $stokcurrent,
            'stok_last'=> $stoklast,
            'stok_in'=> $dataSet['jlh'],
            'harga_beli'=>$dataSet['hargabeli'],
            'harga_jual'=>$dataSet['hargajual'],
            'tglentry'=>$this->get_now(),
            'pic'=>auth()->user()->id,
        ];
        stokobat::create($datastok);
        $idobat = $dataSet['idobat'];
        $exp = $dataSet['ed'];

        $cek_sediaan = db::select('select * from kartu_persediaan_obat where id_barang = ? and tgl_expired = ?',[$idobat,$exp]);
        if(count($cek_sediaan) > 0)
        {
            $data_sediaan = [
                'last_update' => $this->get_now(),
                'stok_in' => $dataSet['jlh'],
                'stok_current' => $cek_sediaan[0]->stok_current + $dataSet['jlh'],
                'stok_last' => $cek_sediaan[0]->stok_current
            ];
            sediaanobat::where('id', $cek_sediaan[0]->id)->update($data_sediaan);
        }else{
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
}

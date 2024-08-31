<?php

namespace App\Http\Controllers;

use App\Models\Kasir_detail;
use App\Models\Kasir_header;
use App\Models\Layanan_detail;
use App\Models\Layanan_header;
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
        where a.id = ? and c.status_layanan_detail = ?', [$kodekunjungan,'OPN']);
        return view('Kasir.form_pembayaran', compact([
            'data'
        ]));
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
        foreach($array_tagihan as $dd){
            $total = intval($dd['grandtotal']);
            $grandtotal = $grandtotal + $total;
        }
        return view('Kasir.grandtotal_kasir',compact([
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

        foreach($arrgtt as $ar){
            $kembalian = $ar['tu'] - $ar['gtt'];
            $kasir_header = [
                'jumlah_bayar' => $ar['tu'],
                'jumlah_tagihan' => $ar['gtt'],
                'kembalian' => $kembalian,
                'tgl_entry' => $this->get_now(),
                'pic' => auth()->user()->id
            ];
        }
        $kh = Kasir_header::create($kasir_header);
        foreach($array_tagihan as $at){
            $kasir_detail = [
                'id_header' => $kh->id,
                'id_layanan_header' => $at['idheader'],
                'id_layanan_detail' => $at['iddetail'],
                'total_tagihan' => $at['grandtotal'],
                'tgl_entry' => $this->get_now(),
                'pic' => auth()->user()->id,
            ];
            $kD = Kasir_detail::create($kasir_detail);
            Layanan_header::where('id',$at['idheader'])->update(['status_layanan'=>2]);
            Layanan_detail::where('id',$at['iddetail'])->update(['status_layanan_detail'=>'CLS']);
        }
       return view('Kasir.notif');
    }
}

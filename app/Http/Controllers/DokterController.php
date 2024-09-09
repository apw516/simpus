<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kunjungan;
use App\Models\Layanan_detail;
use App\Models\Layanan_header;

class DokterController extends RekamedisController
{
    public function indexdokter()
    {
        $menu = 'indexdokter';
        $date = $this->get_date();
        return view('Dokter.index_dokter', compact([
            'menu',
            'date'
        ]));
    }
    public function caripasiendokter(Request $request)
    {
        $data_kunjungan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.status != ? and date(a.tgl_entry) between ? and ? order by a.id desc', [3, $request->awal, $request->akhir]);
        return view('Dokter.tabel_pasien_dokter', compact([
            'data_kunjungan'
        ]));
    }
    public function ambil_index_erm(Request $request)
    {
        $rm = $request->norm;
        $kodekunjungan = $request->kodekunjungan;
        $mt_pasien = DB::select('select * from mt_pasien where no_rm = ?', [$rm]);
        $data_now = DB::select('select * from mt_kunjungan where no_rm = ? and id = (select max(id) as id from mt_kunjungan where no_rm = ?)', [$rm, $rm]);
        $data_store = DB::select('select * from mt_kunjungan where no_rm = ? ', [$rm]);
        $tarif = DB::select('select * from mt_tarif where status = ?', [1]);
        $barang = DB::select('select *,a.id as id_barang from mt_barang a inner join mt_sediaan b on a.sediaan = b.id');
        return view('Dokter.index_erm', compact([
            'data_now',
            'data_store',
            'mt_pasien',
            'kodekunjungan',
            'tarif',
            'barang'
        ]));
    }
    public function ambilriwayatkunjungan(Request $request)
    {
        $rm = $request->rm;
        $data_store = DB::select('select * from mt_kunjungan where no_rm = ? order by id desc', [$rm]);
        return view('Dokter.tabel_riwayat_kunjungan', compact([
            'data_store'
        ]));
    }
    public function simpanpemeriksaandokter(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $data2 = json_decode($_POST['data2'], true);
        $data3 = json_decode($_POST['data3'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $idkunjungan = $dataSet['kodekunjungan'];
        foreach ($data2 as $nama2) {
            $index2 = $nama2['name'];
            $value2 = $nama2['value'];
            $dataSet2[$index2] = $value2;
            if ($index2 == 'tarif') {
                $array_layanan[] = $dataSet2;
            }
        }
        foreach ($data3 as $nama3) {
            $index3 = $nama3['name'];
            $value3 = $nama3['value'];
            $dataSet3[$index3] = $value3;
            if ($index3 == 'qty') {
                $array_layanan_obat[] = $dataSet3;
            }
        }

        $data_pemeriksaan = [
            'status_pemeriksaan' => 1,
            'Subject' => trim($dataSet['subject']),
            'Object' => trim($dataSet['object']),
            'Assesment' => trim($dataSet['assesment']),
            'Planning' => trim($dataSet['planning']),
            'tgl_periksa' => $this->get_now(),
        ];
        Kunjungan::whereRaw('id = ?', array($idkunjungan))->update($data_pemeriksaan);
        if (count($data2) > 0) {
            $ts_kunjungan = DB::select('select * from mt_kunjungan where id = ?', [$idkunjungan]);
            $data_header = [
                'kode_kunjungan' => $idkunjungan,
                'tgl_entry' => $this->get_now(),
                'status_layanan' => '1',
                'pic' => auth()->user()->id,
                'total_retur' => 0,
                'kode_unit' => $ts_kunjungan[0]->kode_unit
            ];
            $layanan_header = Layanan_header::create($data_header);
            $total_header = 0;
            foreach ($array_layanan as $as) {
                $data_detail = [
                    'id_header' => $layanan_header->id,
                    'jumlah_layanan' => '1',
                    'tarif' => $as['tarif'],
                    'total_tarif' => $as['tarif'],
                    'pic' => auth()->user()->id,
                    'tgl_entry' => $this->get_now(),
                    'id_tarif' => $as['idtarif']
                ];
                $total_header = $total_header + $as['tarif'];
                $layanan_detail = Layanan_detail::create($data_detail);
            }
            Layanan_header::whereRaw('id = ?', array($layanan_header->id))->update([
                'total_tagihan' => $total_header
            ]);
        }

        //obat
        if (count($data3) > 0) {
            $data_header = [
                'kode_kunjungan' => $idkunjungan,
                'tgl_entry' => $this->get_now(),
                'status_layanan' => '1',
                'pic' => auth()->user()->id,
                'total_retur' => 0,
                'kode_unit' => '2004'
            ];
            $layanan_header_farmasi = Layanan_header::create($data_header);
            $total_header = 0;
            foreach ($array_layanan_obat as $af) {
                $mt_barang = DB::select('select * from kartu_stok_obat where id_obat = ? and id = (select max(id) from kartu_stok_obat where id_obat = ?)', [$af['idobat'],$af['idobat']]);
                $harga_jual = $mt_barang[0]->harga_jual;
                $data_detail = [
                    'id_header' => $layanan_header_farmasi->id,
                    'jumlah_layanan' => $af['qty'],
                    'tarif' => $harga_jual,
                    'total_tarif' => $harga_jual * $af['qty'],
                    'pic' => auth()->user()->id,
                    'tgl_entry' => $this->get_now(),
                    'id_barang' => $af['idobat'],
                    'aturan_pakai' => $af['aturanpakai']
                ];
                $total = $harga_jual * $af['qty'];
                $total_header = $total_header + $total;
                $layanan_detail = Layanan_detail::create($data_detail);
            }
            Layanan_header::whereRaw('id = ?', array($layanan_header_farmasi->id))->update([
                'total_tagihan' => $total_header
            ]);
        }

        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function detail_riwayat_layanan(request $request)
    {
        $id_kunjungan = $request->kodekunjungan;
        $data_pelayanan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join user c on a.pic = c.id
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.id = ?', [$id_kunjungan]);

        $data = db::select('select *,c.id as id_detail,b.id as id_header from mt_kunjungan a inner join ts_layanan_header b on a.id = b.kode_kunjungan inner join ts_layanan_detail c on b.id = c.id_header inner join mt_tarif d on c.id_tarif = d.id where a.id = ? and c.status_layanan_detail != ?', [$id_kunjungan, 'RET']);

        $mt_pegawai = DB::select('select * from mt_pegawai');
        $mt_pegawai = DB::select('select * from mt_unit');
        return view('Dokter.riwayat_layanan', compact([
            'data_pelayanan',
            'id_kunjungan',
            'data'
        ]));
    }
    public function detail_riwayat_resep(request $request)
    {
        $id_kunjungan = $request->kodekunjungan;
        $data_pelayanan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join user c on a.pic = c.id
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.id = ?', [$id_kunjungan]);

        $data = db::select('select *,c.id as id_detail,b.id as id_header from mt_kunjungan a inner join ts_layanan_header b on a.id = b.kode_kunjungan inner join ts_layanan_detail c on b.id = c.id_header inner join mt_barang d on c.id_barang = d.id where a.id = ? and c.status_layanan_detail != ? and b.kode_unit = ?', [$id_kunjungan, 'RET','2004']);
        // dd($data);
        $mt_pegawai = DB::select('select * from mt_pegawai');
        $mt_pegawai = DB::select('select * from mt_unit');
        return view('Dokter.riwayat_resep', compact([
            'data_pelayanan',
            'id_kunjungan',
            'data'
        ]));
    }
    public function retur_tindakan(Request $request)
    {
        $iddetail = $request->iddetail;
        $ts_layanan_detail = db::select('select * from ts_layanan_detail where id = ?', [$iddetail]);
        if ($ts_layanan_detail[0]->status_layanan_detail == 'RET') {
            $data = [
                'kode' => 500,
                'message' => 'Data sudah diretur !'
            ];
            echo json_encode($data);
            die;
        }
        $data_detail = [
            'jumlah_retur' => 1,
            'total_tarif' => 0,
            'status_layanan_detail' => 'RET'
        ];
        Layanan_detail::where('id', $iddetail)->update($data_detail);

        $ts_layanan_detail_2 = db::select('select * from ts_layanan_detail where id_header = ? and status_layanan_detail = ?', [$ts_layanan_detail[0]->id_header, 'OPN']);

        $ts_layanan_header = db::select('select * from ts_layanan_header where id = ?', [$ts_layanan_detail[0]->id_header]);

        if (count($ts_layanan_detail_2) > 0) {
            $total_header = $ts_layanan_header[0]->total_tagihan;
            $total_header_new = $total_header - $ts_layanan_detail[0]->tarif;
            $total_retur = $ts_layanan_header[0]->total_retur + 1;
            $data_header = [
                'total_tagihan' => $total_header_new,
                'total_retur' => $total_retur,
            ];
        } else {
            $ts_layanan_detail_2 = db::select('select * from ts_layanan_detail where id_header = ? and status_layanan_detail = ?', [$ts_layanan_detail[0]->id_header, 'RET']);
            $total_retur = count($ts_layanan_detail_2);
            $data_header = [
                'status_layanan' => 3,
                'total_tagihan' => 0,
                'total_retur' => $total_retur,
            ];
        }
        Layanan_header::where('id', $ts_layanan_detail[0]->id_header)->update($data_header);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil diretur !'
        ];
        echo json_encode($data);
        die;
    }
}

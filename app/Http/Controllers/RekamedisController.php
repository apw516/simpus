<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Layanan_detail;
use App\Models\Layanan_header;
use App\Models\Pasien;
use App\Models\Tarif_header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekamedisController extends Controller
{
    public function index_pendaftaran()
    {
        $menu = 'pendaftaran';
        return view('Rekamedis.index_pendaftaran', compact([
            'menu'
        ]));
    }
    public function index_riwayat_pelayanan()
    {
        $menu = 'riwayat_pelayanan';
        $date = $this->get_date();
        return view('Rekamedis.index_riwayat_pelayanan', compact([
            'menu',
            'date'
        ]));
    }
    public function masterpasien()
    {
        $menu = 'masterpasien';
        $date = $this->get_date();
        return view('Rekamedis.index_master_pasien', compact([
            'menu',
            'date'
        ]));
    }
    public function caripasien(Request $request)
    {
        $rm = $request->rm;
        $nik = $request->nomorid;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $pasien = DB::select("CALL WSP_PANGGIL_DATAPASIEN('$rm','$nama','$alamat','$nik')");
        return view('Rekamedis.tabel_pasien', compact([
            'pasien'
        ]));
    }
    public function mastercaripasien(Request $request)
    {
        $rm = $request->rm;
        $nik = $request->nomorid;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $pasien = DB::select("CALL WSP_PANGGIL_DATAPASIEN('$rm','$nama','$alamat','$nik')");
        return view('Rekamedis.tabel_pasien_master', compact([
            'pasien'
        ]));
    }
    public function caririwayatpelayanan(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $filter = $request->filter;
        if ($filter == 1) {
            $data_pelayanan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join user c on a.pic = c.id
        inner join mt_pasien d on a.no_rm = d.no_rm
        where date(a.tgl_entry) between ? and ? order by a.id desc', [$awal, $akhir]);
        } else {
            $data_pelayanan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join user c on a.pic = c.id
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.pic = ? and date(a.tgl_entry) between ? and ? order by a.id desc', [auth()->user()->id, $awal, $akhir]);
        }
        return view('Rekamedis.table_riwayat_pelayanan', compact([
            'data_pelayanan'
        ]));
    }
    public function ambildetailpasien(request $request)
    {
        $norm = $request->norm;
        $mt_pasien = db::select('select * from mt_pasien where no_rm = ?',[$norm]);
        return view('Rekamedis.form_edit_pasien', compact([
            'mt_pasien'
        ]));
    }
    public function formeditkunjungan(request $request)
    {
        $id_kunjungan = $request->kodekunjungan;
        $data_pelayanan = DB::select('select *,a.kode_unit as unit_k,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join user c on a.pic = c.id
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.id = ?', [$id_kunjungan]);
        $mt_pegawai = DB::select('select * from mt_pegawai');
        $mt_pegawai = DB::select('select * from mt_unit');
        return view('Rekamedis.form_edit_kunjungan', compact([
            'data_pelayanan',
            'id_kunjungan'
        ]));
    }
    public function detailkunjungan(request $request)
    {
        $id_kunjungan = $request->kodekunjungan;
        $data_pelayanan = DB::select('select *,a.id as id_kunjungan,a.pic as pic_kunjungan,a.status as status_kunjungan,a.tgl_entry as tgl_entry_kunjungan from mt_kunjungan a
        inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join user c on a.pic = c.id
        inner join mt_pasien d on a.no_rm = d.no_rm
        where a.id = ?', [$id_kunjungan]);
        $data = db::select('select *,c.id as id_detail,b.id as id_header,c.tarif as tarif_2 from mt_kunjungan a inner join ts_layanan_header b on a.id = b.kode_kunjungan inner join ts_layanan_detail c on b.id = c.id_header
        LEFT OUTER JOIN mt_tarif d ON c.`id_tarif` = d.`id`
        LEFT OUTER JOIN mt_barang e ON c.`id_barang` = e.`id`
        where a.id = ? and c.status_layanan_detail != ?', [$id_kunjungan,'RET']);

        $mt_pegawai = DB::select('select * from mt_pegawai');
        $mt_pegawai = DB::select('select * from mt_unit');
        return view('Rekamedis.detail_kunjungan', compact([
            'data_pelayanan',
            'id_kunjungan','data'
        ]));
    }
    public function ambilformpendaftaran(Request $request)
    {
        $rm = $request->norm;
        $detail_pasien = db::select('select * from mt_pasien where no_rm = ?', [$rm]);
        $now = $this->get_date();
        return view('Rekamedis.form_pendaftaran_pasien', compact([
            'rm',
            'now',
            'detail_pasien'
        ]));
    }
    public function riwayatkunjungan(Request $request)
    {
        $rm = $request->rm;
        $mt_kunjungan = db::select('select * from mt_kunjungan where no_rm = ? and status != ?', [$rm, '3']);
        return view('Rekamedis.tabel_riwayat_kunjungan', compact([
            'mt_kunjungan'
        ]));
    }
    public function caridokter(request $request)
    {
        $result = DB::table('mt_pegawai')->where('nama', 'LIKE', '%' . $request['term'] . '%')->where('status', '=', '1')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->id,
                );
            echo json_encode($arr_result);
        }
    }
    public function simpanpendaftaran()
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $cek_rm = DB::select('select * from mt_kunjungan where no_rm = ? and status != ?', [$dataSet['rmpasien'], '3']);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] + 1;
        }
        if ($dataSet['kodepoli'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Tujuan kunjungan belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        $datakunjungan = [
            'counter' => $counter,
            'no_rm' => $dataSet['rmpasien'],
            'tgl_masuk' => $dataSet['tglmasuk'],
            'tgl_entry' => $this->get_now(),
            'nama_unit' => $dataSet['namapoli'],
            'kode_unit' => $dataSet['kodepoli'],
            'nama_dokter' => $dataSet['namadokter'],
            'kode_dokter' => $dataSet['kodedokter'],
            'status' => '1',
            'pic' => auth()->user()->id
        ];
        $kunjungan = Kunjungan::create($datakunjungan);
        if ($dataSet['kodepoli'] > 1000 && $dataSet['kodepoli'] < 2000) {
            $tarif = db::select('select * from mt_tarif where id = ?', [1]);
            $data_header = [
                'kode_kunjungan' => $kunjungan->id,
                'tgl_entry' => $this->get_now(),
                'status_layanan' => '1',
                'total_tagihan' => $tarif[0]->tarif,
                'pic' => auth()->user()->id,
                'total_retur' => 0,
                'kode_unit' => $dataSet['kodepoli']
            ];
            $layanan_header = Layanan_header::create($data_header);
            $data_detail = [
                'id_header' => $layanan_header->id,
                'jumlah_layanan' => '1',
                'tarif' => $tarif[0]->tarif,
                'total_tarif' => $tarif[0]->tarif,
                'pic' => auth()->user()->id,
                'tgl_entry' => $this->get_now(),
                'id_tarif' => 1
            ];
            $layanan_detail = Layanan_detail::create($data_detail);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaneditkunjungan()
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $dataupdate = [
            'nama_unit' => $dataSet['namapoli'],
            'kode_unit' => $dataSet['kodepoli'],
            'nama_dokter' => $dataSet['namadokter'],
            'kode_dokter' => $dataSet['kodedokter'],
            'tgl_masuk' => $dataSet['tglmasuk'],
            'status' => $dataSet['status'],
        ];
        $idkunjungan = $dataSet['kode_kunjungan'];
        Kunjungan::whereRaw('id = ?', array($idkunjungan))->update($dataupdate);

        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanpasienbaru()
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_pasien = [
            'no_rm' => $this->get_rm(),
            'nama_pasien' => $dataSet['namalengkap'],
            'jenis_kelamin' => $dataSet['jeniskelamin'],
            'tempat_lahir' => $dataSet['tempatlahir'],
            'tanggal_lahir' => $dataSet['tanggallahir'],
            'nomor_identitas' => $dataSet['nomoridentitas'],
            'nomor_telepon' => $dataSet['nomorhp'],
            'alamat' => $dataSet['alamat'],
            'pic' => auth()->user()->id,
            'tgl_entry' => $this->get_now()
        ];
        Pasien::create($data_pasien);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaneditpasien()
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $norm = $dataSet['norm'];
        $data_pasien = [
            'nama_pasien' => $dataSet['namalengkap'],
            'jenis_kelamin' => $dataSet['jeniskelamin'],
            'tempat_lahir' => $dataSet['tempatlahir'],
            'tanggal_lahir' => $dataSet['tanggallahir'],
            'nomor_identitas' => $dataSet['nomoridentitas'],
            'nomor_telepon' => $dataSet['nomorhp'],
            'alamat' => $dataSet['alamat'],
            'pic' => auth()->user()->id,
            'tgl_entry' => $this->get_now()
        ];
        Pasien::whereRaw('no_rm = ?', array($norm))->update($data_pasien);

        Pasien::create($data_pasien);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function get_rm()
    {
        $y = DB::select('SELECT MAX(RIGHT(no_rm,6)) AS kd_max FROM mt_pasien');
        if ($y[0]->kd_max >= 999999) {
            $y = DB::select('SELECT MAX(RIGHT(no_rm,6)) AS kd_max FROM mt_pasien where LEFT(no_rm,2) = ?', ['01']);
            if (count($y) > 0) {
                foreach ($y as $k) {
                    $tmp = ((int) $k->kd_max) + 1;
                    $kd = sprintf("%06s", $tmp);
                }
            } else {
                $kd = "000001";
            }
            date_default_timezone_set('Asia/Jakarta');
            return '01' . $kd;
        } else {
            if (count($y) > 0) {
                foreach ($y as $k) {
                    $tmp = ((int) $k->kd_max) + 1;
                    $kd = sprintf("%06s", $tmp);
                }
            } else {
                $kd = "0001";
            }
            date_default_timezone_set('Asia/Jakarta');
            return date('y') . $kd;
        }
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function ambilberkaserm(request $request)
    {
        $rm = $request->norm;
        $kunjungan = db::select('select * from mt_kunjungan where no_rm = ? order by counter desc',[$rm]);
        foreach($kunjungan as $k){
            $header = db::select('select * from ts_layanan_header a inner join ts_layanan_detail b on a.id = b.id_header
            left outer join mt_tarif c on b.id_tarif = c.id
            left outer join mt_barang d on b.id_barang = d.id
            where a.kode_kunjungan = ?',[$k->id]);
        }
        $mt_pasien = db::select('select * from mt_pasien where no_rm = ?',[$rm]);
        return view('Rekamedis.berkas_erm',compact([
            'kunjungan','mt_pasien','header'
        ]));
    }
}

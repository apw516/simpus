<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pegawai;
use App\Models\Tarif_header;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagemenController extends Controller
{
    public function masteruser()
    {
        $menu = 'masteruser';
        return view('managemen.index_master_user', compact([
            'menu'
        ]));
    }
    public function masterunit()
    {
        $menu = 'masterunit';
        return view('managemen.index_master_unit', compact([
            'menu'
        ]));
    }
    public function mastertarif()
    {
        $menu = 'mastertarif';
        return view('managemen.index_master_tarif', compact([
            'menu'
        ]));
    }
    public function masterpegawai()
    {
        $menu = 'masterpegawai';
        return view('managemen.index_master_pegawai', compact([
            'menu'
        ]));
    }
    public function masterjadwal()
    {
        $menu = 'masterjadwal';
        $hari = db::select('select * from mt_hari');
        $pegawai = db::select('select * from mt_pegawai');
        $unit = db::select('select * from mt_unit');
        return view('managemen.index_master_jawal_poliklinik', compact([
            'menu',
            'hari',
            'pegawai',
            'unit'
        ]));
    }
    public function ambilmasteruser()
    {
        $user = DB::select('select *,a.id as id_user from user a inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join mt_hak_akses c on a.hak_akses = c.kode_akses');
        return view('managemen.tabel_master_user', compact([
            'user'
        ]));
    }
    public function ambilmasterunit()
    {
        $unit = DB::select('select * from mt_unit');
        return view('managemen.tabel_master_unit', compact([
            'unit'
        ]));
    }
    public function ambilmastertarif()
    {
        $tarif = DB::select('select * from mt_tarif');
        return view('managemen.tabel_master_tarif', compact([
            'tarif'
        ]));
    }
    public function ambilmasterpegawai()
    {
        $pegawai = DB::select('select * from mt_pegawai');
        return view('managemen.tabel_master_pegawai', compact([
            'pegawai'
        ]));
    }
    public function ambilmasterjadwal()
    {
        $jadwal = DB::select('select *,a.id as idjadwal,b.nama as nama_hari
        ,c.nama_unit as nama_unit
        ,d.nama as nama_dokter
        ,a.status as status_jadwal
        from mt_jadwal_poliklinik a
        inner join mt_hari b on a.hari = b.id
        inner join mt_unit c on a.kode_unit = c.id
        inner join mt_pegawai d on a.id_dokter = d.id
        ');
        return view('managemen.tabel_master_jadwal', compact([
            'jadwal'
        ]));
    }
    public function ambil_detail_user(Request $request)
    {
        $id = $request->id_user;
        $user = DB::select('select *,a.id as id_user from user a inner join mt_unit b on a.kode_unit = b.kode_unit
        inner join mt_hak_akses c on a.hak_akses = c.kode_akses where a.id = ?', [$id]);
        $hakakses = db::select('select * from mt_hak_akses');
        $unit = db::select('select * from mt_unit');
        return view('managemen.form_edit_user', compact([
            'user',
            'hakakses',
            'unit'
        ]));
    }
    public function ambil_detail_unit(Request $request)
    {
        $id = $request->idunit;
        $unit = DB::select('select * from mt_unit where id = ?', [$id]);
        return view('managemen.form_edit_unit', compact([
            'unit'
        ]));
    }
    public function ambil_detail_tarif(Request $request)
    {
        $id = $request->idtarif;
        $tarif = DB::select('select * from mt_tarif where id = ?', [$id]);
        return view('managemen.form_edit_tarif', compact([
            'tarif'
        ]));
    }
    public function ambil_detail_pegawai(Request $request)
    {
        $id = $request->idpegawai;
        $pegawai = DB::select('select * from mt_pegawai where id = ?', [$id]);
        return view('managemen.form_edit_pegawai', compact([
            'pegawai'
        ]));
    }
    public function ambil_detail_jadwal(Request $request)
    {
        $id = $request->idjadwal;
        $jadwal = DB::select('select * from mt_jadwal_poliklinik where id = ?', [$id]);
        $hari = db::select('select * from mt_hari');
        $pegawai = db::select('select * from mt_pegawai');
        $unit = db::select('select * from mt_unit');
        return view('managemen.form_edit_jadwal', compact([
            'jadwal','hari','pegawai','unit'
        ]));
    }
    public function simpaedituser(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_user = [
            'kode_unit' => $dataSet['unit'],
            'hak_akses' => $dataSet['hak_akses'],
            'status' => $dataSet['status'],
            'id_pegawai' => $dataSet['idpegawai'],
        ];
        $id = $dataSet['iduser'];
        User::where('id', $id)->update($data_user);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaeditunit(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_unit = [
            'nama_unit' => $dataSet['namaunit'],
            'status' => $dataSet['status'],
        ];
        $id = $dataSet['idunit'];
        Unit::where('id', $id)->update($data_unit);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanedittarif(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_Tariff = [
            'nama_tarif' => $dataSet['namatarif'],
            'tarif' => $dataSet['tarif'],
            'status' => $dataSet['status'],
        ];
        $id = $dataSet['idtarif'];
        Tarif_header::where('id', $id)->update($data_Tariff);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaeditpegawai(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_pegawai = [
            'nama' => $dataSet['nama'],
            'nip' => $dataSet['nip'],
            'jabatan' => $dataSet['jabatan'],
            'status' => $dataSet['status'],
        ];
        $id = $dataSet['idpegawai'];
        Pegawai::where('id', $id)->update($data_pegawai);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaneditjadwal(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $datajadwal = [
            'kode_unit' => $dataSet['unit'],
            'id_dokter' => $dataSet['dokter'],
            'hari' => $dataSet['hari'],
            'status' => $dataSet['status'],
            'jam_praktek' => $dataSet['jampraktek']
        ];
        $id = $dataSet['idjadwal'];
        Jadwal::where('id', $id)->update($datajadwal);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanunit(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $jenisunit = $dataSet['jenisunit'];
        $max = db::select('select max(kode_unit) as max_kode from mt_unit where jenis_unit = ?',[$jenisunit]);
        $kode_unit = $max[0]->max_kode;
        $new_kode_unit = $kode_unit+1;
        $dataunit = [
            'kode_unit' => $new_kode_unit,
            'nama_unit' => $dataSet['namaunit'],
            'jenis_unit' => $jenisunit
        ];
        Unit::create($dataunit);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpantarif(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $dataunit = [
            'nama_tarif' => $dataSet['namatarif'],
            'tarif' => $dataSet['tarif'],
            'status' => $dataSet['status'],
        ];
        Tarif_header::create($dataunit);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanpegawai(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $dataunit = [
            'nip' => $dataSet['nip'],
            'nama' => $dataSet['namapegawai'],
            'jabatan' => $dataSet['jabatan']
        ];
        Pegawai::create($dataunit);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanjadwal(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $datajadwal = [
            'kode_unit' => $dataSet['unit'],
            'id_dokter' => $dataSet['dokter'],
            'hari' => $dataSet['hari'],
            'jam_praktek' => $dataSet['jampraktek']
        ];
        Jadwal::create($datajadwal);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function carihari(Request $request)
    {
        $result = DB::table('mt_hari')->where('nama', 'LIKE', '%' . $request['term'] . '%')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->id,
                );
            echo json_encode($arr_result);
        }
    }
}

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ManagemenController;
use App\Http\Controllers\RekamedisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [AuthController::class, 'Index'])->name('/login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('Register', [AuthController::class, 'Register'])->name('/register');
Route::post('Register', [AuthController::class, 'store'])->name('register');
Route::get('logout', [AuthController::class, 'Logout'])->name('logout');
Route::get('cariunit', [AuthController::class, 'cari_unit'])->name('cariunit');

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


//managemen
Route::get('/masteruser', [ManagemenController::class, 'masteruser'])->middleware('auth')->name('masteruser');
Route::get('/masterunit', [ManagemenController::class, 'masterunit'])->middleware('auth')->name('masterunit');
Route::get('/mastertarif', [ManagemenController::class, 'mastertarif'])->middleware('auth')->name('mastertarif');
Route::get('/masterpegawai', [ManagemenController::class, 'masterpegawai'])->middleware('auth')->name('masterpegawai');
Route::get('/masterjadwal', [ManagemenController::class, 'masterjadwal'])->middleware('auth')->name('masterjadwal');


Route::post('/ambilmasteruser', [ManagemenController::class, 'ambilmasteruser'])->middleware('auth')->name('ambilmasteruser');
Route::post('/ambilmasterunit', [ManagemenController::class, 'ambilmasterunit'])->middleware('auth')->name('ambilmasterunit');
Route::post('/ambilmastertarif', [ManagemenController::class, 'ambilmastertarif'])->middleware('auth')->name('ambilmastertarif');
Route::post('/ambilmasterpegawai', [ManagemenController::class, 'ambilmasterpegawai'])->middleware('auth')->name('ambilmasterpegawai');
Route::post('/ambilmasterjadwal', [ManagemenController::class, 'ambilmasterjadwal'])->middleware('auth')->name('ambilmasterjadwal');

Route::post('/ambil_detail_user', [ManagemenController::class, 'ambil_detail_user'])->middleware('auth')->name('ambil_detail_user');
Route::post('/ambil_detail_unit', [ManagemenController::class, 'ambil_detail_unit'])->middleware('auth')->name('ambil_detail_unit');
Route::post('/ambil_detail_tarif', [ManagemenController::class, 'ambil_detail_tarif'])->middleware('auth')->name('ambil_detail_tarif');
Route::post('/ambil_detail_pegawai', [ManagemenController::class, 'ambil_detail_pegawai'])->middleware('auth')->name('ambil_detail_pegawai');
Route::post('/ambil_detail_jadwal', [ManagemenController::class, 'ambil_detail_jadwal'])->middleware('auth')->name('ambil_detail_jadwal');

Route::post('/simpaedituser', [ManagemenController::class, 'simpaedituser'])->middleware('auth')->name('simpaedituser');
Route::post('/simpaeditunit', [ManagemenController::class, 'simpaeditunit'])->middleware('auth')->name('simpaeditunit');
Route::post('/simpanunit', [ManagemenController::class, 'simpanunit'])->middleware('auth')->name('simpanunit');
Route::post('/simpantarif', [ManagemenController::class, 'simpantarif'])->middleware('auth')->name('simpantarif');
Route::post('/simpanedittarif', [ManagemenController::class, 'simpanedittarif'])->middleware('auth')->name('simpanedittarif');
Route::post('/simpanpegawai', [ManagemenController::class, 'simpanpegawai'])->middleware('auth')->name('simpanpegawai');
Route::post('/simpaeditpegawai', [ManagemenController::class, 'simpaeditpegawai'])->middleware('auth')->name('simpaeditpegawai');
Route::post('/simpanjadwal', [ManagemenController::class, 'simpanjadwal'])->middleware('auth')->name('simpanjadwal');
Route::post('/simpaneditjadwal', [ManagemenController::class, 'simpaneditjadwal'])->middleware('auth')->name('simpaneditjadwal');
Route::get('/carihari', [ManagemenController::class, 'carihari'])->middleware('auth')->name('carihari');

//REKAMEDIS
Route::get('/pendaftaran', [RekamedisController::class, 'index_pendaftaran'])->middleware('auth')->name('pendaftaran');
Route::get('/masterpasien', [RekamedisController::class, 'masterpasien'])->middleware('auth')->name('masterpasien');
Route::get('/riwayatpelayanan', [RekamedisController::class, 'index_riwayat_pelayanan'])->middleware('auth')->name('riwayatpelayanan');
Route::post('/simpanpasienbaru', [RekamedisController::class, 'simpanpasienbaru'])->middleware('auth')->name('simpanpasienbaru');
Route::post('/simpaneditpasien', [RekamedisController::class, 'simpaneditpasien'])->middleware('auth')->name('simpaneditpasien');
Route::post('/caripasien', [RekamedisController::class, 'caripasien'])->middleware('auth')->name('caripasien');
Route::post('/mastercaripasien', [RekamedisController::class, 'mastercaripasien'])->middleware('auth')->name('mastercaripasien');
Route::post('/ambilformpendaftaran', [RekamedisController::class, 'ambilformpendaftaran'])->middleware('auth')->name('ambilformpendaftaran');
Route::post('/simpanpendaftaran', [RekamedisController::class, 'simpanpendaftaran'])->middleware('auth')->name('simpanpendaftaran');
Route::post('/riwayatkunjungan', [RekamedisController::class, 'riwayatkunjungan'])->middleware('auth')->name('riwayatkunjungan');
Route::post('/caririwayatpelayanan', [RekamedisController::class, 'caririwayatpelayanan'])->middleware('auth')->name('caririwayatpelayanan');
Route::get('caridokter', [RekamedisController::class, 'caridokter'])->name('caridokter');
Route::post('/formeditkunjungan', [RekamedisController::class, 'formeditkunjungan'])->middleware('auth')->name('formeditkunjungan');
Route::post('/simpaneditkunjungan', [RekamedisController::class, 'simpaneditkunjungan'])->middleware('auth')->name('simpaneditkunjungan');
Route::post('/detailkunjungan', [RekamedisController::class, 'detailkunjungan'])->middleware('auth')->name('detailkunjungan');
Route::post('/ambildetailpasien', [RekamedisController::class, 'ambildetailpasien'])->middleware('auth')->name('ambildetailpasien');
Route::post('/ambilberkaserm', [RekamedisController::class, 'ambilberkaserm'])->middleware('auth')->name('ambilberkaserm');
Route::get('/cetakriwayatpelayanan/{awal}/{akhir}/{filter}', [RekamedisController::class, 'cetakriwayatpelayanan']); //formpasien_bpjs
Route::get('/cetakberkaserm/{rm}', [RekamedisController::class, 'cetakberkaserm']); //formpasien_bpjs

//ERM
Route::get('/indexdokter', [DokterController::class, 'indexdokter'])->middleware('auth')->name('indexdokter');
Route::post('/caripasiendokter', [DokterController::class, 'caripasiendokter'])->middleware('auth')->name('caripasiendokter');
Route::post('/ambil_index_erm', [DokterController::class, 'ambil_index_erm'])->middleware('auth')->name('ambil_index_erm');
Route::post('/ambilriwayatkunjungan', [DokterController::class, 'ambilriwayatkunjungan'])->middleware('auth')->name('ambilriwayatkunjungan');
Route::post('/simpanpemeriksaandokter', [DokterController::class, 'simpanpemeriksaandokter'])->middleware('auth')->name('simpanpemeriksaandokter');
Route::post('/detail_riwayat_layanan', [DokterController::class, 'detail_riwayat_layanan'])->middleware('auth')->name('detail_riwayat_layanan');
Route::post('/detail_riwayat_resep', [DokterController::class, 'detail_riwayat_resep'])->middleware('auth')->name('detail_riwayat_resep');
Route::post('/retur_tindakan', [DokterController::class, 'retur_tindakan'])->middleware('auth')->name('retur_tindakan');


//Kasir
Route::get('/indexkasir', [KasirController::class, 'indexkasir'])->middleware('auth')->name('indexkasir');
Route::get('/riwayatpembayaran', [KasirController::class, 'riwayatpembayaran'])->middleware('auth')->name('riwayatpembayaran');
Route::post('/caririwayatpembayaran', [KasirController::class, 'caririwayatpembayaran'])->middleware('auth')->name('caririwayatpembayaran');
Route::post('/caripasienkasir', [KasirController::class, 'caripasienkasir'])->middleware('auth')->name('caripasienkasir');
Route::post('/ambil_detail_pembayaran', [KasirController::class, 'ambil_detail_pembayaran'])->middleware('auth')->name('ambil_detail_pembayaran');
Route::post('/ambil_detail_invoice', [KasirController::class, 'ambil_detail_invoice'])->middleware('auth')->name('ambil_detail_invoice');
Route::post('/ambil_tagihan_detail', [KasirController::class, 'ambil_tagihan_detail'])->middleware('auth')->name('ambil_tagihan_detail');
Route::post('/hitungpembayaran', [KasirController::class, 'hitungpembayaran'])->middleware('auth')->name('hitungpembayaran');
Route::post('/hitungulang', [KasirController::class, 'hitungulang'])->middleware('auth')->name('hitungulang');
Route::post('/bayartagihan', [KasirController::class, 'bayartagihan'])->middleware('auth')->name('bayartagihan');
Route::post('/buatinvoice', [KasirController::class, 'buatinvoice'])->middleware('auth')->name('buatinvoice');
Route::post('/hapus_invoice', [KasirController::class, 'hapus_invoice'])->middleware('auth')->name('hapus_invoice');
Route::post('/update_invoice', [KasirController::class, 'update_invoice'])->middleware('auth')->name('update_invoice');

Route::post('/infoyangsudahdibayar', [KasirController::class, 'infoyangsudahdibayar'])->middleware('auth')->name('infoyangsudahdibayar');
Route::get('/cetaknota/{id}', [KasirController::class, 'cetaknota']); //formpasien_bpjs
Route::get('/cetakriwayatbayar/{awal}/{akhir}', [KasirController::class, 'cetakriwayatbayar']); //formpasien_bpjs
Route::get('/cetakinvoice/{kodeinvoice}', [KasirController::class, 'Cetakinvoice']); //formpasien_bpjs


//farmasi
Route::get('/cetakresep/{id}', [FarmasiController::class, 'cetakresep']); //formpasien_bpjs
Route::get('/masterobat', [FarmasiController::class, 'indexmasterobat'])->middleware('auth')->name('masterobat');
Route::get('/masterorder', [FarmasiController::class, 'indexmasterorder'])->middleware('auth')->name('masterorder');
Route::post('/ambilmasterbarang', [FarmasiController::class, 'ambilmasterbarang'])->middleware('auth')->name('ambilmasterbarang');
Route::post('/simpanobat', [FarmasiController::class, 'simpanobat'])->middleware('auth')->name('simpanobat');
Route::post('/simpaneditbarang', [FarmasiController::class, 'simpaneditbarang'])->middleware('auth')->name('simpaneditbarang');
Route::post('/info_stok_obat', [FarmasiController::class, 'info_stok_obat'])->middleware('auth')->name('info_stok_obat');
Route::post('/ambil_form_stok_obat', [FarmasiController::class, 'ambil_form_stok_obat'])->middleware('auth')->name('ambil_form_stok_obat');
Route::post('/simpastok', [FarmasiController::class, 'simpastok'])->middleware('auth')->name('simpastok');
Route::post('/caripasienorder', [FarmasiController::class, 'caripasienorder'])->middleware('auth')->name('caripasienorder');
Route::post('/ambil_data_order', [FarmasiController::class, 'ambil_data_order'])->middleware('auth')->name('ambil_data_order');
Route::post('/simpanlayananorder', [FarmasiController::class, 'simpanlayananorder'])->middleware('auth')->name('simpanlayananorder');
Route::post('/ambil_detail_obat', [FarmasiController::class, 'ambil_detail_obat'])->middleware('auth')->name('ambil_detail_obat');

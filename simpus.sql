/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - simpus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`simpus` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `simpus`;

/*Table structure for table `kartu_persediaan_obat` */

DROP TABLE IF EXISTS `kartu_persediaan_obat`;

CREATE TABLE `kartu_persediaan_obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `stok_in` double DEFAULT 0,
  `stok_last` double DEFAULT 0,
  `stok_out` double DEFAULT 0,
  `stok_current` double DEFAULT 0,
  `tgl_expired` date DEFAULT NULL,
  `pic` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `kartu_stok_obat` */

DROP TABLE IF EXISTS `kartu_stok_obat`;

CREATE TABLE `kartu_stok_obat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_dokumen` int(225) DEFAULT 0,
  `id_obat` int(225) DEFAULT NULL,
  `stok_last` double DEFAULT 0,
  `stok_in` double DEFAULT 0,
  `stok_out` double DEFAULT 0,
  `stok_current` double DEFAULT 0,
  `harga_beli` double DEFAULT 0,
  `harga_jual` double DEFAULT 0,
  `tglentry` datetime DEFAULT NULL,
  `pic` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_barang` */

DROP TABLE IF EXISTS `mt_barang`;

CREATE TABLE `mt_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) DEFAULT NULL,
  `nama_generik` varchar(255) DEFAULT NULL,
  `aturan_pakai` text DEFAULT NULL,
  `dosis` varchar(255) DEFAULT NULL,
  `sediaan` varchar(255) DEFAULT NULL,
  `satuan_besar` varchar(122) DEFAULT NULL,
  `satuan_sedang` varchar(122) DEFAULT NULL,
  `satuan_kecil` varchar(122) DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  `pic` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_hak_akses` */

DROP TABLE IF EXISTS `mt_hak_akses`;

CREATE TABLE `mt_hak_akses` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `kode_akses` int(12) DEFAULT NULL,
  `nama_akses` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_hari` */

DROP TABLE IF EXISTS `mt_hari`;

CREATE TABLE `mt_hari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_jadwal_poliklinik` */

DROP TABLE IF EXISTS `mt_jadwal_poliklinik`;

CREATE TABLE `mt_jadwal_poliklinik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_unit` varchar(255) DEFAULT NULL,
  `nama_unit` varchar(255) DEFAULT NULL,
  `id_dokter` varchar(255) DEFAULT NULL,
  `nama_dokter` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '1',
  `hari` varchar(255) DEFAULT NULL,
  `id_hari` varchar(255) DEFAULT NULL,
  `jam_praktek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_kunjungan` */

DROP TABLE IF EXISTS `mt_kunjungan`;

CREATE TABLE `mt_kunjungan` (
  `counter` int(12) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_rm` varchar(12) DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `nama_unit` varchar(255) DEFAULT NULL,
  `kode_unit` varchar(255) DEFAULT NULL,
  `nama_dokter` varchar(255) DEFAULT NULL,
  `kode_dokter` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `pic` int(3) DEFAULT NULL,
  `status_pemeriksaan` int(1) DEFAULT 0,
  `Subject` text DEFAULT NULL,
  `Object` text DEFAULT NULL,
  `Assesment` text DEFAULT NULL,
  `Planning` text DEFAULT NULL,
  `tgl_periksa` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_pasien` */

DROP TABLE IF EXISTS `mt_pasien`;

CREATE TABLE `mt_pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_rm` varchar(255) DEFAULT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `jenis_kelamin` int(2) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nomor_identitas` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `pic` int(2) DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_pegawai` */

DROP TABLE IF EXISTS `mt_pegawai`;

CREATE TABLE `mt_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `tgl_entry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_satuan` */

DROP TABLE IF EXISTS `mt_satuan`;

CREATE TABLE `mt_satuan` (
  `kode_satuan` varchar(3) NOT NULL,
  `nama_satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Table structure for table `mt_sediaan` */

DROP TABLE IF EXISTS `mt_sediaan`;

CREATE TABLE `mt_sediaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sediaan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Table structure for table `mt_tarif` */

DROP TABLE IF EXISTS `mt_tarif`;

CREATE TABLE `mt_tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tarif` varchar(255) DEFAULT NULL,
  `tarif` double DEFAULT 0,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `mt_unit` */

DROP TABLE IF EXISTS `mt_unit`;

CREATE TABLE `mt_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(125) DEFAULT NULL,
  `kode_unit` varchar(25) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `jenis_unit` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `ts_layanan_detail` */

DROP TABLE IF EXISTS `ts_layanan_detail`;

CREATE TABLE `ts_layanan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_header` int(255) DEFAULT NULL,
  `jumlah_layanan` double DEFAULT 0,
  `tarif` double DEFAULT 0,
  `total_tarif` double DEFAULT 0,
  `jumlah_retur` double DEFAULT 0,
  `pic` int(255) DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  `status_layanan_detail` varchar(12) DEFAULT 'OPN',
  `id_tarif` int(225) DEFAULT NULL,
  `id_barang` int(225) DEFAULT NULL,
  `aturan_pakai` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `ts_layanan_header` */

DROP TABLE IF EXISTS `ts_layanan_header`;

CREATE TABLE `ts_layanan_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kunjungan` int(255) DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  `status_layanan` int(1) DEFAULT NULL,
  `total_tagihan` double DEFAULT 0,
  `pic` int(5) DEFAULT NULL,
  `total_retur` double DEFAULT 0,
  `kode_unit` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `ts_transaksi_kasir_detail` */

DROP TABLE IF EXISTS `ts_transaksi_kasir_detail`;

CREATE TABLE `ts_transaksi_kasir_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_header` int(12) DEFAULT NULL,
  `id_layanan_header` int(12) DEFAULT NULL,
  `id_layanan_detail` int(12) DEFAULT NULL,
  `total_tagihan` double DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  `pic` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `ts_transaksi_kasir_header` */

DROP TABLE IF EXISTS `ts_transaksi_kasir_header`;

CREATE TABLE `ts_transaksi_kasir_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah_bayar` double DEFAULT NULL,
  `jumlah_tagihan` double DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `tgl_entry` datetime DEFAULT NULL,
  `pic` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `kode_unit` varchar(255) DEFAULT NULL,
  `hak_akses` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `tanggal_entry` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_pegawai` int(12) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/* Procedure structure for procedure `WSP_PANGGIL_DATAPASIEN` */

/*!50003 DROP PROCEDURE IF EXISTS  `WSP_PANGGIL_DATAPASIEN` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `WSP_PANGGIL_DATAPASIEN`(RM VARCHAR(15),NAMA VARCHAR(100),ALAMAT VARCHAR(200),NIK VARCHAR(200))
BEGIN

SET @param_norm = RM;
SET @param_NIK= NIK;
SET @param_nama= NAMA;
SET @param_alamat= ALAMAT;


DROP TEMPORARY TABLE IF EXISTS CariPasien;

CREATE TEMPORARY TABLE CariPasien
(id varchar(200), no_rm VARCHAR(200)
,nama_pasien VARCHAR(200),NIK VARCHAR(200),alamat VARCHAR(200),TGL_LAHIR DATE,jenis_kelamin VARCHAR(1));
INSERT INTO Caripasien
(id,no_rm,nama_pasien,NIK,alamat,TGL_LAHIR,jenis_kelamin)
SELECT DISTINCT 
id as id
     ,a.no_rm AS no_rm
     ,UPPER(a.nama_pasien) AS nama_pasien
     ,IFNULL(a.nomor_identitas,'') AS nomor_identitas
     ,a.alamat as alamat
	,DATE(tanggal_lahir) AS TGL_LAHIR
	,jenis_kelamin
FROM mt_pasien a
WHERE a.nama_pasien LIKE CONCAT('%',@param_nama,'%') #and a.no_rm not in ('','000000')
     AND no_rm LIKE CONCAT ('%',@param_norm,'%')
     AND a.alamat LIKE CONCAT ('%',@param_alamat,'%')
     AND a.nomor_identitas LIKE CONCAT ('%',@param_NIK,'%')
     
     #AND inacbg5YEAR(tgl_lahir) LIKE CONCAT ('%',@param_thnlahir,'%')
LIMIT 100
;

SELECT AA.*
FROM CariPasien AA   
WHERE #nik LIKE CONCAT ('%',@param_NIK,'%')
     #and no_asuransi like CONCAT ('%',@param_nobpjs,'%')
#     and 
     alamat LIKE CONCAT ('%',@param_alamat,'%')
     AND aa.NIK LIKE CONCAT ('%',@param_NIK,'%')
     AND no_rm NOT IN ('00000000','09000000','10000001','')
     AND nama_pasien <> ''
     #AND thn_lahir LIKE CONCAT ('%',@param_thnlahir,'%')
ORDER BY id DESC
;
  
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

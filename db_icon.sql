-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_icon.master_group_user
CREATE TABLE IF NOT EXISTS `master_group_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KD_GROUPUSER` varchar(50) DEFAULT NULL,
  `NAMA_GROUPUSER` varchar(50) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASFMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.master_group_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_group_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_group_user` ENABLE KEYS */;

-- Dumping structure for table db_icon.master_inventory
CREATE TABLE IF NOT EXISTS `master_inventory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KD_INVENTORY` varchar(50) DEFAULT NULL,
  `NAMA_INVENTORY` varchar(100) DEFAULT NULL,
  `JENIS` varchar(50) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.master_inventory: ~3 rows (approximately)
/*!40000 ALTER TABLE `master_inventory` DISABLE KEYS */;
INSERT INTO `master_inventory` (`ID`, `KD_INVENTORY`, `NAMA_INVENTORY`, `JENIS`, `CREATED_TIME`, `CREATED_BY`, `LASTMODIFIED_TIME`, `LASTMODIFIED_BY`, `ROW_STATUS`) VALUES
	(5, 'INV202208-00001', 'Switch Huawei', 'switch', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(6, 'INV202208-00002', 'Switch BDCOM', 'switch', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(7, 'INV202208-00003', 'Modem T-Link', 'modem', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(8, 'INV202208-00004', 'Roll kabel FO 200m', 'kabel', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(9, 'INV202208-00005', 'Roll kabel FO 150m', 'kabel', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(10, 'INV202208-00006', 'Belden RJ45', 'konektor', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(11, 'INV202208-00007', 'Sleeve Protector', 'switch', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(12, 'INV202208-00008', 'Patchcord 10m', 'kabel', '2022-08-11 00:00:00', NULL, NULL, NULL, 0),
	(13, 'INV202208-00009', 'Mikrotik RB2011', 'router', '2022-08-11 00:00:00', NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `master_inventory` ENABLE KEYS */;

-- Dumping structure for table db_icon.master_inventory_stock
CREATE TABLE IF NOT EXISTS `master_inventory_stock` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KD_INVENTORY` varchar(50) DEFAULT NULL,
  `STOCK` int(11) DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.master_inventory_stock: ~1 rows (approximately)
/*!40000 ALTER TABLE `master_inventory_stock` DISABLE KEYS */;
INSERT INTO `master_inventory_stock` (`ID`, `KD_INVENTORY`, `STOCK`, `ROW_STATUS`, `CREATED_TIME`, `CREATED_BY`, `LASTMODIFIED_TIME`, `LASTMODIFIED_BY`) VALUES
	(1, 'K123', 5, 0, NULL, NULL, NULL, NULL),
	(5, 'OKEOKE', 4, 0, '2022-07-23 00:00:00', NULL, NULL, NULL),
	(6, 'OKE21', 6, 0, '2022-07-26 00:00:00', NULL, NULL, NULL),
	(7, 'INV202208-00009', 6, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(8, 'INV202208-00008', 9, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(9, 'INV202208-00007', 24, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(10, 'INV202208-00006', 30, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(11, 'INV202208-00005', 17, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(12, 'INV202208-00004', 23, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(13, 'INV202208-00003', 30, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(14, 'INV202208-00002', 5, 0, '2022-08-11 00:00:00', NULL, NULL, NULL),
	(15, 'INV202208-00001', 5, 0, '2022-08-11 00:00:00', NULL, NULL, NULL);
/*!40000 ALTER TABLE `master_inventory_stock` ENABLE KEYS */;

-- Dumping structure for table db_icon.master_pelanggan
CREATE TABLE IF NOT EXISTS `master_pelanggan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_PELANGGAN` varchar(50) NOT NULL,
  `NAMA` varchar(250) NOT NULL DEFAULT '',
  `NIK` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(250) DEFAULT '',
  `NO_TELEPON` varchar(50) DEFAULT NULL,
  `ALAMAT` varchar(250) DEFAULT '',
  `BANDWITH` varchar(250) NOT NULL DEFAULT '',
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `DELETED_TIME` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.master_pelanggan: ~5 rows (approximately)
/*!40000 ALTER TABLE `master_pelanggan` DISABLE KEYS */;
INSERT INTO `master_pelanggan` (`ID`, `NO_PELANGGAN`, `NAMA`, `NIK`, `EMAIL`, `NO_TELEPON`, `ALAMAT`, `BANDWITH`, `CREATED_TIME`, `CREATED_BY`, `LASTMODIFIED_TIME`, `LASTMODIFIED_BY`, `DELETED_TIME`) VALUES
	(1, 'P12312', 'Hasi Dudrajat', '982391283123', 'hadisu@gmail.com', '08123123', 'askdjsa', '40 Mbps', NULL, NULL, NULL, NULL, NULL),
	(2, 'PEL202207-00007', 'Rahman Rakhim', '6483472998', 'rahman@gmail.com', 'kj', 'kn', '10 Mbps', NULL, NULL, NULL, NULL, NULL),
	(3, 'PEL202207-00008', 'Roki Putirai', '63637897237', 'roki.p@gmail.com', 'l;m', ';l', '40 Mbps', NULL, NULL, NULL, NULL, NULL),
	(4, 'PEL202207-00009', 'Dwi Normansyah', '6357162836', 'dwinorm@gmail.com', '0865763829', 'Jl Gotong Royong, RO Ulin No.91', '100 Mbps', NULL, NULL, NULL, NULL, NULL),
	(5, 'PEL202207-00010', 'Monica', '6372', 'monica@gmail.com', '0813403276', 'Jln. Sungai sipai', '10 Mbps', '2022-07-27 00:00:00', NULL, NULL, NULL, NULL),
	(6, 'PEL202208-00001', 'Indra Riyadi', '6372061209980001', 'indrariyadi@gmail.com', '081253627788', 'Jln. Panglima Batur, Komp Amaco, No : 27', '30 Mbps', '2022-08-11 21:10:22', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `master_pelanggan` ENABLE KEYS */;

-- Dumping structure for table db_icon.master_teknisi
CREATE TABLE IF NOT EXISTS `master_teknisi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_PEGAWAI` varchar(50) DEFAULT NULL,
  `NAMA` varchar(250) DEFAULT NULL,
  `JABATAN` varchar(50) DEFAULT NULL,
  `FOTO` varchar(100) DEFAULT NULL,
  `ALAMAT` text,
  `EMAIL` varchar(50) DEFAULT NULL,
  `NO_TELEPON` varchar(50) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `DELETED_TIME` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.master_teknisi: ~5 rows (approximately)
/*!40000 ALTER TABLE `master_teknisi` DISABLE KEYS */;
INSERT INTO `master_teknisi` (`ID`, `NO_PEGAWAI`, `NAMA`, `JABATAN`, `FOTO`, `ALAMAT`, `EMAIL`, `NO_TELEPON`, `CREATED_TIME`, `CREATED_BY`, `LASMODIFIED_TIME`, `LASTMODIFIED_BY`, `DELETED_TIME`) VALUES
	(31, 'TEK202207-00001', 'Bayu Hadi Sudrajat', 'Teknisi', NULL, 'Komp Griya Mustika Permai Blok O no 91', 'bayuhadisudrajat@gmail.com', '082253736473', NULL, NULL, NULL, NULL, NULL),
	(33, 'TEK202207-00002', 'Dwi Normansyah', 'Teknisi', NULL, 'Jalan Gotong Royong', 'dwinorm@gmail.com', '08653758123', NULL, NULL, NULL, NULL, NULL),
	(34, 'TEK202207-00003', 'Rizky Adriansyah', 'Teknisi', NULL, 'Kalua Besar', 'IkyCuy@gmail.com', '08731823712', NULL, NULL, NULL, NULL, NULL),
	(36, 'TEK202207-00004', 'Along', 'Teknisi', NULL, 'Puruk Cahu', 'pahlong@gmail.com', '087923418292', NULL, NULL, NULL, NULL, NULL),
	(37, 'TEK202207-00005', 'Ganang Hadi Prasetyo', 'Teknisi', NULL, 'Kalua', 'khairisyahyulianifirlia@gmail.com', '0983128391237', NULL, NULL, NULL, NULL, NULL),
	(38, 'TEK202207-00006', 'Alfu', 'Teknisi', NULL, 'Jln. Baru no 40', 'Alfurin@gmail.com', '08125034657', NULL, NULL, NULL, NULL, NULL),
	(39, 'TEK202208-00001', 'Erwin saga', 'Teknisi', NULL, 'Komp, Perumahan Seribu, Blok 4, no :13', 'erwinsaga@gmail.com', '081245278909', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `master_teknisi` ENABLE KEYS */;

-- Dumping structure for table db_icon.master_user
CREATE TABLE IF NOT EXISTS `master_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(250) NOT NULL,
  `KD_GROUPUSER` varchar(50) DEFAULT NULL,
  `KD_IDENTIFIKASI` varchar(50) NOT NULL DEFAULT '0',
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.master_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `master_user` DISABLE KEYS */;
INSERT INTO `master_user` (`ID`, `USERNAME`, `PASSWORD`, `KD_GROUPUSER`, `KD_IDENTIFIKASI`, `CREATED_TIME`, `CREATED_BY`, `LASTMODIFIED_TIME`, `LASTMODIFIED_BY`, `ROW_STATUS`) VALUES
	(0, 'bayu', 'bayu', 'Teknisi', '0', NULL, NULL, NULL, NULL, 0),
	(1, 'admin', 'admin', 'Admin', '0', NULL, NULL, NULL, NULL, 0),
	(3, 'dwi', 'dwi', 'Pelanggan', 'PEL202207-00009', NULL, NULL, NULL, NULL, 0),
	(4, 'rokhim123', 'rokhim123', 'Pelanggan', 'PEL202207-00007', '2022-08-04 22:11:25', NULL, NULL, NULL, 0),
	(5, 'indra', 'indra', 'Pelanggan', 'PEL202208-00001', '2022-08-11 21:12:16', NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `master_user` ENABLE KEYS */;

-- Dumping structure for table db_icon.setup_docno
CREATE TABLE IF NOT EXISTS `setup_docno` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `KD_DOCNO` varchar(50) DEFAULT NULL,
  `KETERANGAN` varchar(250) DEFAULT NULL,
  `TAHUN` int(11) DEFAULT NULL,
  `BULAN` int(11) DEFAULT NULL,
  `URUTAN` int(11) DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.setup_docno: ~4 rows (approximately)
/*!40000 ALTER TABLE `setup_docno` DISABLE KEYS */;
INSERT INTO `setup_docno` (`ID`, `KD_DOCNO`, `KETERANGAN`, `TAHUN`, `BULAN`, `URUTAN`, `CREATED_BY`, `CREATED_TIME`, `LASTMODIFIED_BY`, `LASTMODIFIED_TIME`, `ROW_STATUS`) VALUES
	(3, 'TEK', 'Penomoran Kode Teknisi', 2022, 7, 6, NULL, NULL, NULL, NULL, NULL),
	(4, 'PEL', 'Penomoran Kode Pelanggan', 2022, 7, 10, NULL, NULL, NULL, NULL, NULL),
	(5, 'LAP', 'Penomoran Kode Laporan', 2022, 7, 5, NULL, NULL, NULL, NULL, NULL),
	(6, 'BW', 'Penomoran Kode Perubahan Bandwith', 2022, 7, 2, NULL, NULL, NULL, NULL, NULL),
	(7, 'LAP', 'Penomoran Kode Laporan', 2022, 8, 1, NULL, NULL, NULL, NULL, NULL),
	(8, 'BW', 'Penomoran Kode Perubahan Bandwith', 2022, 8, 1, NULL, NULL, NULL, NULL, NULL),
	(9, 'PEL', 'Penomoran Kode Pelanggan', 2022, 8, 1, NULL, NULL, NULL, NULL, NULL),
	(10, 'TEK', 'Penomoran Kode Teknisi', 2022, 8, 1, NULL, NULL, NULL, NULL, NULL),
	(11, 'INV', 'Penomoran Kode Inventory', 2022, 8, 9, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `setup_docno` ENABLE KEYS */;

-- Dumping structure for table db_icon.trans_laporanmasuk
CREATE TABLE IF NOT EXISTS `trans_laporanmasuk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_LAPORAN` varchar(50) DEFAULT NULL,
  `ID_PELAPOR` varchar(50) DEFAULT NULL,
  `KETERANGAN` text,
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `DELETED_TIME` datetime DEFAULT NULL,
  `JENIS` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.trans_laporanmasuk: ~7 rows (approximately)
/*!40000 ALTER TABLE `trans_laporanmasuk` DISABLE KEYS */;
INSERT INTO `trans_laporanmasuk` (`ID`, `NO_LAPORAN`, `ID_PELAPOR`, `KETERANGAN`, `CREATED_TIME`, `CREATED_BY`, `LASTMODIFIED_TIME`, `LASTMODIFIED_BY`, `DELETED_TIME`, `JENIS`) VALUES
	(12, 'LAP202207-00001', 'PEL202207-00007', 'oke oke', '2022-06-28 14:17:25', NULL, NULL, NULL, NULL, '3'),
	(13, 'LAP202207-00002', 'PEL202207-00009', 'Jaringan Lelet', '2022-06-28 19:25:01', NULL, NULL, NULL, NULL, 'Jaringan Lelet'),
	(14, 'LAP202207-00003', 'PEL202207-00009', 'Jaringan lelet sekali', '2022-07-30 15:34:57', NULL, NULL, NULL, NULL, 'Jaringan Lelet'),
	(15, 'LAP202207-00004', 'PEL202207-00008', 'Internet Tidak bisa digunakan dari kemarin', '2022-07-30 15:35:14', NULL, NULL, NULL, NULL, 'Internet Tidak Bisa Digunakan'),
	(16, 'LAP202207-00005', 'PEL202207-00010', 'Lampu router mati setelat pemadaman listrik', '2022-07-30 15:35:35', NULL, NULL, NULL, NULL, 'Router mati'),
	(17, 'BW202207-00002', 'PEL202207-00009', 'Perubahan bandwith menjadi : 50mbps', '2022-08-31 19:39:37', NULL, NULL, NULL, NULL, 'Perubahan bandwith'),
	(18, 'LAP202208-00001', 'PEL202207-00009', 'Kabel tertimpa dahan pohon yang jatuh setelah hujan', '2022-08-11 20:15:37', NULL, NULL, NULL, NULL, 'Internet Tidak Bisa Digunakan'),
	(19, 'BW202208-00001', 'PEL202207-00009', 'Perubahan bandwith menjadi : 100mbps', '2022-08-11 20:51:59', NULL, NULL, NULL, NULL, 'Perubahan bandwith');
/*!40000 ALTER TABLE `trans_laporanmasuk` ENABLE KEYS */;

-- Dumping structure for table db_icon.trans_penanganan
CREATE TABLE IF NOT EXISTS `trans_penanganan` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_PENANGANAN` varchar(50) DEFAULT NULL,
  `STATUS_PENANGANAN` smallint(6) DEFAULT NULL,
  `JENIS_PENANGANAN` varchar(50) DEFAULT NULL,
  `NO_LAPORAN` varchar(50) DEFAULT NULL,
  `CATATAN` varchar(500) DEFAULT NULL,
  `KETERANGAN` varchar(500) DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.trans_penanganan: ~7 rows (approximately)
/*!40000 ALTER TABLE `trans_penanganan` DISABLE KEYS */;
INSERT INTO `trans_penanganan` (`ID`, `NO_PENANGANAN`, `STATUS_PENANGANAN`, `JENIS_PENANGANAN`, `NO_LAPORAN`, `CATATAN`, `KETERANGAN`, `ROW_STATUS`, `CREATED_TIME`, `CREATED_BY`, `LASTMODIFIED_BY`, `LASTMODIFIED_TIME`) VALUES
	(44, '20220729001', 2, 'laporan', 'LAP202207-00001', 'Tersambar Petir', ' ', 1, '2022-07-29 19:18:48', NULL, NULL, NULL),
	(45, '20220730001', 1, 'maintenance', '', NULL, 'Perbaikan Jaringan Bulanan', 1, '2022-07-30 07:56:47', NULL, NULL, NULL),
	(46, '20220730002', 1, 'maintenance', '', NULL, 'Kabel putus di sungai danau', 1, '2022-07-30 14:53:47', NULL, NULL, NULL),
	(50, '20220810001', 2, 'perubahan bandwith', 'BW202207-00002', NULL, 'Perubahan bandwith pelanggan PEL202207-00009 menjadi 50 Mbps', NULL, NULL, NULL, NULL, NULL),
	(51, '20220810002', 2, 'laporan', 'LAP202207-00003', 'oke', ' ', 1, '2022-08-10 21:25:53', NULL, NULL, NULL),
	(52, '20220810003', 1, 'laporan', 'LAP202207-00005', NULL, ' ', 1, '2022-08-10 21:29:20', NULL, NULL, NULL),
	(53, '20220811001', 2, 'laporan', 'LAP202208-00001', 'Kabel sudah ditarik dari terminal fiber terdekat menuju rumah pelanggan', ' ', 1, '2022-08-11 20:18:21', NULL, NULL, NULL),
	(54, '20220811002', 2, 'perubahan bandwith', 'BW202208-00001', NULL, 'Perubahan bandwith pelanggan PEL202207-00009 menjadi 100 Mbps', NULL, NULL, NULL, NULL, NULL),
	(55, '20220811003', 2, 'maintenance', '', 'Maintenance telah selesai dilakukan pada server room icon+', 'Perbaikan bulanan, agar layanan internet lebih handal', 1, '2022-08-11 20:59:15', NULL, NULL, NULL);
/*!40000 ALTER TABLE `trans_penanganan` ENABLE KEYS */;

-- Dumping structure for table db_icon.trans_penanganan_detail_inventory
CREATE TABLE IF NOT EXISTS `trans_penanganan_detail_inventory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_PENANGANAN` varchar(50) DEFAULT NULL,
  `KD_INVENTORY` varchar(50) DEFAULT NULL,
  `JLH_DIPAKAI` int(11) DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.trans_penanganan_detail_inventory: ~4 rows (approximately)
/*!40000 ALTER TABLE `trans_penanganan_detail_inventory` DISABLE KEYS */;
INSERT INTO `trans_penanganan_detail_inventory` (`ID`, `NO_PENANGANAN`, `KD_INVENTORY`, `JLH_DIPAKAI`, `CREATED_BY`, `CREATED_TIME`, `LASTMODIFIED_BY`, `LASTMODIFIED_TIME`, `ROW_STATUS`) VALUES
	(10, '20220729001', 'OKEOKE', 2, NULL, '2022-07-29 19:19:19', NULL, NULL, 0),
	(11, '20220729001', 'OKE21', 1, NULL, '2022-07-29 19:19:19', NULL, NULL, 0),
	(12, '20220810002', 'OKEOKE', 1, NULL, '2022-08-11 20:37:43', NULL, NULL, 0),
	(13, '20220811001', 'OKE21', 1, NULL, '2022-08-11 20:47:12', NULL, NULL, 0),
	(14, '20220811003', 'K123', 8, NULL, '2022-08-11 21:06:53', NULL, NULL, 0);
/*!40000 ALTER TABLE `trans_penanganan_detail_inventory` ENABLE KEYS */;

-- Dumping structure for table db_icon.trans_penanganan_detail_teknisi
CREATE TABLE IF NOT EXISTS `trans_penanganan_detail_teknisi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_PENANGANAN` varchar(50) DEFAULT NULL,
  `KD_TEKNISI` varchar(50) DEFAULT NULL,
  `PERAN` varchar(50) DEFAULT NULL,
  `ROW_STATUS` smallint(6) DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT NULL,
  `CREATED_BY` varchar(50) DEFAULT NULL,
  `LASTMODIFIED_TIME` datetime DEFAULT NULL,
  `LASTMODIFIED_BY` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- Dumping data for table db_icon.trans_penanganan_detail_teknisi: ~6 rows (approximately)
/*!40000 ALTER TABLE `trans_penanganan_detail_teknisi` DISABLE KEYS */;
INSERT INTO `trans_penanganan_detail_teknisi` (`ID`, `NO_PENANGANAN`, `KD_TEKNISI`, `PERAN`, `ROW_STATUS`, `CREATED_TIME`, `CREATED_BY`, `LASTMODIFIED_TIME`, `LASTMODIFIED_BY`) VALUES
	(50, '20220729001', 'TEK202207-00002', 'Penanggung Jawab', 0, '2022-07-29 19:18:48', NULL, NULL, NULL),
	(51, '20220729001', 'TEK202207-00004', 'Teknisi', 0, '2022-07-29 19:18:48', NULL, NULL, NULL),
	(52, '20220730001', 'TEK202207-00001', 'Penanggung Jawab', 0, '2022-07-30 07:56:47', NULL, NULL, NULL),
	(53, '20220730002', 'TEK202207-00003', 'Penanggung Jawab', 0, '2022-07-30 14:53:47', NULL, NULL, NULL),
	(54, '20220811001', 'TEK202207-00001', 'Penanggung Jawab', 0, '2022-08-11 20:18:21', NULL, NULL, NULL),
	(55, '20220811001', 'TEK202207-00006', 'Teknisi', 0, '2022-08-11 20:18:21', NULL, NULL, NULL),
	(56, '20220811003', 'TEK202207-00001', 'Penanggung Jawab', 0, '2022-08-11 20:59:15', NULL, NULL, NULL),
	(57, '20220811003', 'TEK202207-00005', 'Teknisi', 0, '2022-08-11 20:59:15', NULL, NULL, NULL);
/*!40000 ALTER TABLE `trans_penanganan_detail_teknisi` ENABLE KEYS */;

-- Dumping structure for procedure db_icon.SP_LAPORAN_GANGGUAN_INSERT
DELIMITER //
CREATE PROCEDURE `SP_LAPORAN_GANGGUAN_INSERT`()
BEGIN

END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

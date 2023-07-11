<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PostModel;
use App\Models\PostCategoryModel;

class DataPenanganan extends Model
{
	
	public function getPenanganan(){
		$db = \Config\Database::connect();
		$query = "SELECT A.NO_PENANGANAN,B.NO_LAPORAN, A.STATUS_PENANGANAN,A.JENIS_PENANGANAN, A.CREATED_TIME,C.NAMA , '-' PERAN FROM trans_penanganan A
					LEFT JOIN trans_laporanmasuk B ON A.NO_LAPORAN = B.NO_LAPORAN
					LEFT JOIN master_pelanggan C ON C.NO_PELANGGAN = B.ID_PELAPOR
					ORDER BY A.CREATED_TIME DESC";
		$sql = $db->query($query);
		return $sql->getResult();
	}
	
	
	public function getPenangananTeknisi($teknisi){
		$db = \Config\Database::connect();
		$query = "SELECT TPT.NO_PENANGANAN, TPT.KD_TEKNISI, TPT.PERAN, TP.NO_LAPORAN, TL.NO_LAPORAN, MP.NAMA NAMA_PELAPOR, TP.CREATED_TIME, TP.STATUS_PENANGANAN, TP.JENIS_PENANGANAN  FROM trans_penanganan_detail_teknisi TPT
					LEFT JOIN trans_penanganan TP ON TP.NO_PENANGANAN = TPT.NO_PENANGANAN
					LEFT JOIN trans_laporanmasuk TL ON TL.NO_LAPORAN = TP.NO_LAPORAN
					LEFT JOIN master_pelanggan MP ON MP.NO_PELANGGAN = TL.ID_PELAPOR
					WHERE TPT.KD_TEKNISI = '".$teknisi."' 
					ORDER BY TP.CREATED_TIME DESC";
		$sql = $db->query($query);
		return $sql->getResult();
		
	}
	public function getPenangananExcel(){
		$db = \Config\Database::connect();
		$query = "SELECT TP.NO_PENANGANAN,TP.NO_LAPORAN,C.NAMA NAMA_PELANGGAN,TP.JENIS_PENANGANAN, TP.CREATED_TIME,TP.LASTMODIFIED_TIME, TP.STATUS_PENANGANAN,
					CASE WHEN TPT.NO_PENANGANAN IS NULL
						THEN NULL 
					ELSE CAST(CONCAT('[',
				GROUP_CONCAT(JSON_OBJECT('KD_TEKNISI', TPT.KD_TEKNISI)),     
						']') AS JSON) END TEKNISI,
						
				CASE WHEN TPI.NO_PENANGANAN IS NULL
						THEN NULL 
					ELSE  CAST(CONCAT('[',
				GROUP_CONCAT(JSON_OBJECT('KD_INVENTORY', TPI.KD_INVENTORY)),     
				']') AS JSON) END INVENTORY,
				TP.KETERANGAN
					FROM trans_penanganan TP
					LEFT JOIN trans_laporanmasuk B ON TP.NO_LAPORAN = B.NO_LAPORAN
					LEFT JOIN master_pelanggan C ON C.NO_PELANGGAN = B.ID_PELAPOR
					LEFT JOIN trans_penanganan_detail_teknisi TPT ON TPT.NO_PENANGANAN = TP.NO_PENANGANAN
					LEFT JOIN trans_penanganan_detail_inventory TPI ON TPI.NO_PENANGANAN = TP.NO_PENANGANAN
					GROUP BY TP.NO_PENANGANAN, TP.NO_LAPORAN,TP.STATUS_PENANGANAN,TP.JENIS_PENANGANAN, TP.CREATED_TIME,C.NAMA,TP.KETERANGAN,TP.LASTMODIFIED_TIME";
		$sql = $db->query($query);
		return $sql->getResult();
	}

	public function simpanPenanganan($id_laporan, $detail, $jenis, $keterangan, $tipe_pengerjaan){
		$db      = \Config\Database::connect();
		$this->db->transStart();
		$no_penanganan = $this->generateIdPenanganan();
		$tgl = date('dmY');
		$sql = "INSERT INTO trans_penanganan (NO_PENANGANAN,STATUS_PENANGANAN,JENIS_PENANGANAN, KETERANGAN, NO_LAPORAN, CREATED_TIME,ROW_STATUS, TIPE_PENGERJAAN) VALUES ('".$no_penanganan."',1,'".$jenis."','".$keterangan."','".$id_laporan."',CURRENT_TIMESTAMP(),0,'".$tipe_pengerjaan."') ";
		$this->db->query($sql);


		for ($i = 0; $i < count($detail); $i++) {
			$sql2 = "INSERT INTO trans_penanganan_detail_teknisi (NO_PENANGANAN,KD_TEKNISI,PERAN,ROW_STATUS,CREATED_TIME) VALUES('".$no_penanganan."','".$detail[$i]['nama']."','".$detail[$i]['peran']."','0',CURRENT_TIMESTAMP())";
			$this->db->query($sql2);
		}
		$this->db->transComplete();
		$hasil = $this->db->transStatus();
		// return $hasil;

		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return $hasil;
		} else {
			$this->db->transCommit();
			return $hasil;
		}
		
	}

	public function detaiPenanganan($no_penanganan){
		$db = \Config\Database::connect();
		$query = "SELECT TP.*, MT.NAMA TEKNISI, MP.NO_TELEPON,TPT.KD_TEKNISI,'-' INVENTORY,MP.ALAMAT,TPT.PERAN,0 STOCK,MP.NAMA NAMA_PELAPOR FROM trans_penanganan TP
				LEFT JOIN trans_penanganan_detail_teknisi TPT ON TPT.NO_PENANGANAN = TP.NO_PENANGANAN
				LEFT JOIN master_teknisi MT ON MT.NO_PEGAWAI = TPT.KD_TEKNISI
				LEFT JOIN trans_penanganan_detail_inventory TPI ON TPI.NO_PENANGANAN = TP.NO_PENANGANAN
				LEFT JOIN trans_laporanmasuk TL ON TL.NO_LAPORAN = TP.NO_LAPORAN
				LEFT JOIN master_pelanggan MP ON MP.NO_PELANGGAN = TL.ID_PELAPOR
				WHERE TP.NO_PENANGANAN = '".$no_penanganan."'
				UNION
				SELECT TP.*, '-' TEKNISI,MP.NO_TELEPON,'-' KD_TEKNISI, MI.NAMA_INVENTORY INVENTORY,MP.ALAMAT,'-' PERAN,TPI.JLH_DIPAKAI STOCK,MP.NAMA NAMA_PELAPOR FROM trans_penanganan TP
				LEFT JOIN trans_penanganan_detail_teknisi TPT ON TPT.NO_PENANGANAN = TP.NO_PENANGANAN
				LEFT JOIN trans_penanganan_detail_inventory TPI ON TPI.NO_PENANGANAN = TP.NO_PENANGANAN
				LEFT JOIN master_inventory MI ON MI.KD_INVENTORY = TPI.KD_INVENTORY
				LEFT JOIN trans_laporanmasuk TL ON TL.NO_LAPORAN = TP.NO_LAPORAN
				LEFT JOIN master_pelanggan MP ON MP.NO_PELANGGAN = TL.ID_PELAPOR
				WHERE TP.NO_PENANGANAN = '".$no_penanganan."'";
		$sql = $db->query($query);
		$data = $sql->getResult();
		if (count($data) == 0) {
			$result["status"]	= FALSE;
			$result["message"] 	= "Belum ada data / data tidak di temukan";
			$result["totaldata"] = 0;
			$result["param"]	= $db->getLastQuery();
		} else {
			$result["status"]	= TRUE;
			$result["message"] 	= $data;
			$result["param"]	= $db->getLastQuery();
			$ttr = count($data);//$this->total_record();
			// $ttr = $this->total_record();
			$result["totaldata"] = $ttr;
		}
		return $result;

	}
	
	public function getMaintenance(){
		$db = \Config\Database::connect();
		$query = "SELECT TP.NO_PENANGANAN,TP.KETERANGAN, TP.CATATAN, TP.JENIS_PENANGANAN, TP.STATUS_PENANGANAN, TP.TIPE_PENGERJAAN, CASE WHEN TPT.NO_PENANGANAN IS NULL
						THEN NULL 
						ELSE CAST(CONCAT('[',
						GROUP_CONCAT(JSON_OBJECT('KD_TEKNISI', MT.NAMA )),     
						']') AS JSON) END TEKNISI
				FROM trans_penanganan TP 
				LEFT JOIN trans_penanganan_detail_teknisi TPT ON TPT.NO_PENANGANAN = TP.NO_PENANGANAN
				LEFT JOIN master_teknisi MT ON MT.NO_PEGAWAI = TPT.KD_TEKNISI
				WHERE JENIS_PENANGANAN = 'maintenance'
				GROUP BY TP.NO_PENANGANAN, TP.CATATAN, TP.JENIS_PENANGANAN, TP.STATUS_PENANGANAN, TP.TIPE_PENGERJAAN, TP.KETERANGAN";
		$sql = $db->query($query);
        return $sql->getResult();
	}

	public function generateIdPenanganan()
    {

        $db      = \Config\Database::connect();
        $kode = $db->table('trans_penanganan')
            ->select('RIGHT(NO_PENANGANAN,3) as no_urut', false)
            ->select('LEFT(NO_PENANGANAN,8) as tanggal_input', false)
            ->select('NO_PENANGANAN')
            ->orderBy('NO_PENANGANAN', 'DESC')
            ->limit(1)->get()->getRowArray();

        $kode1 = isset($kode['no_urut']) ? $kode['no_urut'] : '';
        $kode2 = isset($kode['tanggal_input']) ? $kode['tanggal_input'] : '';
        if ($kode1 == null) {
            $no = 1;
        } else {
            if ($kode2 == date('Ymd')) {
                $no = intval($kode1) + 1;
            } else {
                $no = 1;
            }
        }
		// $kodebaku = "G";

        $tgl = date('Ymd');
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $no_penanganan = $tgl . $batas;
        return $no_penanganan;
    }

	public function simpanPenangananSelesai($no_penanganan,$detail, $catatan){
		$db      = \Config\Database::connect();
		$this->db->transStart();
		$tgl = date('dmY');
		$sql = " UPDATE trans_penanganan SET STATUS_PENANGANAN = 2, CATATAN = '".$catatan."' WHERE NO_PENANGANAN = '".$no_penanganan."'";
		$this->db->query($sql);
		for ($i = 0; $i < count($detail); $i++) {
			$sql2 = "INSERT INTO trans_penanganan_detail_inventory (NO_PENANGANAN,KD_INVENTORY,JLH_DIPAKAI,ROW_STATUS,CREATED_TIME) VALUES('".$no_penanganan."','".$detail[$i]['kd_inventory']."','".$detail[$i]['stock']."','0',CURRENT_TIMESTAMP())";
			$this->db->query($sql2);
			$sql3 = "UPDATE master_inventory_stock SET STOCK = STOCK - ".$detail[$i]['stock']." WHERE KD_INVENTORY = '".$detail[$i]['kd_inventory']."'";
			$this->db->query($sql3);
		}
		$this->db->transComplete();
		$hasil = $this->db->transStatus();
		return $hasil;
	}

	public function detailpekerjaanTeknisi($kd_teknisi){
		$db      = \Config\Database::connect();
		$query = "SELECT 
				TPT.*, 
				TP.JENIS_PENANGANAN, 
				TP.NO_PENANGANAN, 
				TP.KETERANGAN, 
				TP.CREATED_TIME TGL_PENANGANAN, 
				MP.NAMA,
				MT.NAMA NAMA_TEKNISI
			FROM 
				trans_penanganan_detail_teknisi TPT 
				LEFT JOIN trans_penanganan TP ON TP.NO_PENANGANAN = TPT.NO_PENANGANAN 
				LEFT JOIN trans_laporanmasuk TL ON TL.NO_LAPORAN = TP.NO_LAPORAN 
				LEFT JOIN master_pelanggan MP ON MP.NO_PELANGGAN = TL.ID_PELAPOR
				LEFT JOIN master_teknisi MT ON MT.NO_PEGAWAI = TPT.KD_TEKNISI 
				WHERE TPT.KD_TEKNISI = '".$kd_teknisi."'";
		$sql = $db->query($query);
		$data = $sql->getResult();
		if (count($data) == 0) {
			$result["status"]	= FALSE;
			$result["message"] 	= "Belum ada data / data tidak di temukan";
			$result["totaldata"] = 0;
			$result["param"]	= $db->getLastQuery();
		} else {
			$result["status"]	= TRUE;
			$result["message"] 	= $data;
			$result["param"]	= $db->getLastQuery();
			$ttr = count($data);//$this->total_record();
			// $ttr = $this->total_record();
			$result["totaldata"] = $ttr;
		}
		return $result;
	}
}
?>
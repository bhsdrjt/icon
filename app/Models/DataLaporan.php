<?php

namespace App\Models;

use CodeIgniter\Model;

class DataLaporan extends Model
{
	public function getLaporanMasuk($param){
		$db = \Config\Database::connect();
        if($param['jenis'] == 0){
            $jenis = "AND X.KETERANGAN != 'Perubahan bandwith menjadi : 50mbps'";
        }else{
            $jenis = "AND X.KETERANGAN = 'Perubahan bandwith menjadi : 50mbps'";
        }
		$query = "SELECT X.NO_LAPORAN, C.NAMA,X.ID_PELAPOR,X.KETERANGAN,X.CREATED_TIME,X.STATUS,X.JENIS FROM (SELECT 
                                *, 
                                CASE WHEN (
                                SELECT 
                                    B.STATUS_PENANGANAN 
                                FROM 
                                    trans_penanganan B 
                                WHERE 
                                    A.NO_LAPORAN = B.NO_LAPORAN
                                ) IS NULL THEN 0 ELSE (
                                SELECT 
                                    B.STATUS_PENANGANAN 
                                FROM 
                                    trans_penanganan B 
                                WHERE 
                                    A.NO_LAPORAN = B.NO_LAPORAN
                                ) END STATUS 
                            FROM 
                                trans_laporanmasuk A) X 
                        LEFT JOIN master_pelanggan C ON C.NO_PELANGGAN = X.ID_PELAPOR
                        WHERE X.STATUS  = '".$param['status']."' AND  YEAR(X.CREATED_TIME) = '".$param['tahun']."' AND MONTH(X.CREATED_TIME) = '".$param['bulan']."' ".$jenis." 
                        ";
		$sql = $db->query($query);
        $data = $sql->getResult();
		if (count($data) == 0) {
			$result["status"]	= FALSE;
			$result["message"] 	= "Belum ada data / data tidak di temukan";
			$result["totaldata"] = 0;
			$result["param"]	= $db->getLastQuery();
		} else {
			$result["status"]	= TRUE;
			$result["message"] 	= "Belum berhasil ditemukan";
			$result["param"]	= $db->getLastQuery();
			$ttr = count($data);//$this->total_record();
			// $ttr = $this->total_record();
			$result["totaldata"] = $ttr;
		}
        $result["data"]	= $data;
		return $result;
	}
    public function getTahun(){
        $db = \Config\Database::connect();
        $query = "SELECT YEAR(CREATED_TIME) TAHUN, MONTH(CREATED_TIME) BULAN FROM trans_laporanmasuk ORDER BY CREATED_TIME DESC LIMIT 1";
        $sql = $db->query($query);
        return $sql->getResult();
        
    }

	public function getLaporanPelanggan($no_pelanggan){
		$db = \Config\Database::connect();
		$query = "SELECT X.NO_LAPORAN, C.NAMA,C.NO_PELANGGAN,X.KETERANGAN,X.CREATED_TIME,X.STATUS,X.JENIS FROM (SELECT 
                        *, 
                        CASE WHEN (
                        SELECT 
                            B.STATUS_PENANGANAN 
                        FROM 
                            trans_penanganan B 
                        WHERE 
                            A.NO_LAPORAN = B.NO_LAPORAN
                        ) IS NULL THEN 0 ELSE (
                        SELECT 
                            B.STATUS_PENANGANAN 
                        FROM 
                            trans_penanganan B 
                        WHERE 
                            A.NO_LAPORAN = B.NO_LAPORAN
                        ) END STATUS 
                    FROM 
                        trans_laporanmasuk A) X 
                LEFT JOIN master_pelanggan C ON C.NO_PELANGGAN = X.ID_PELAPOR
                WHERE  C.NO_PELANGGAN = '".$no_pelanggan."'";
		$sql = $db->query($query);
        return $sql->getResult();
	}
    
    public function getdetailLaporan($no_laporan){
        $db = \Config\Database::connect();
        $query = "SELECT X.NO_LAPORAN, C.NAMA,C.NIK,C.BANDWITH,C.ALAMAT, X.KETERANGAN,X.CREATED_TIME,X.STATUS FROM (SELECT 
                                *, 
                                CASE WHEN (
                                SELECT 
                                    B.STATUS_PENANGANAN 
                                FROM 
                                    trans_penanganan B 
                                WHERE 
                                    A.NO_LAPORAN = B.NO_LAPORAN
                                ) IS NULL THEN 0 ELSE (
                                SELECT 
                                    B.STATUS_PENANGANAN 
                                FROM 
                                    trans_penanganan B 
                                WHERE 
                                    A.NO_LAPORAN = B.NO_LAPORAN
                                ) END STATUS 
                            FROM 
                                trans_laporanmasuk A) X 
                        LEFT JOIN master_pelanggan C ON C.NO_PELANGGAN = X.ID_PELAPOR
                        WHERE X.NO_LAPORAN = '".$no_laporan."' ";
        $sql = $db->query($query);
        return $sql->getResult();
    }

    public function saveLaporan($laporan){
        $db = \Config\Database::connect();
        $this->db->transStart();
        $tgl = date('dmY');
        $query = "INSERT INTO trans_laporanmasuk (NO_LAPORAN,ID_PELAPOR,KETERANGAN,JENIS,CREATED_TIME) VALUES ('".$laporan['no_laporan']."','".$laporan['id_pelanggan']."','".$laporan['keterangan']."','".$laporan['jenis_gangguan']."',CURRENT_TIMESTAMP())";
        $sql = $db->query($query);
        $this->db->transComplete();
		$hasil = $this->db->transStatus() ;
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return $hasil;
		} else {
			$this->db->transCommit();
			return $hasil;
		}
    }

    public function savePerubahanBandwith($laporan){
        $db = \Config\Database::connect();
        $this->db->transStart();
        $tgl = date('dmY');
        $query = "INSERT INTO trans_laporanmasuk (NO_LAPORAN,ID_PELAPOR,KETERANGAN,JENIS,CREATED_TIME) VALUES ('".$laporan['no_laporan']."','".$laporan['id_pelanggan']."','Perubahan bandwith menjadi : ".$laporan['bandwith']."','Perubahan bandwith',CURRENT_TIMESTAMP())";
        $sql = $db->query($query);
        $this->db->transComplete();
		$hasil = $this->db->transStatus() ;
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return $hasil;
		} else {
			$this->db->transCommit();
			return $hasil;
		}
    }

    // public function buatIdTeknisi()
    // {
    //     $db      = \Config\Database::connect();
    //     $kode = $db->table('tb_icon_user')
    //         ->select('RIGHT(id_icon,3) as id_icon', false)
    //         ->orderBy('id_icon', 'DESC')
    //         ->limit(1)->get()->getRowArray();

    //     $kode1 = isset($kode['id_icon']) ? $kode['id_icon'] : '';
    //     if ($kode1 == null) {
    //         $no = 1;
    //     } else {
    //         $no = intval($kode1) + 1;
    //     }
    //     $kodebaku = "U";
    //     $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
    //     $id_icon = $kodebaku . $batas;
    //     return $id_icon;
    // }
}

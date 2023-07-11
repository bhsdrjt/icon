<?php

namespace App\Models;

use CodeIgniter\Model;

class DataDocno extends Model
{
	public function cekDocno($param){
		$db = \Config\Database::connect();

		$queryada = "SELECT CASE WHEN (SELECT URUTAN FROM setup_docno  WHERE KD_DOCNO = '".$param['kd_docno']."' AND TAHUN = '".$param['tahun']."' AND BULAN = '".$param['bulan']."' LIMIT 1 ) IS NULL THEN 0 ELSE ( SELECT URUTAN FROM  setup_docno WHERE KD_DOCNO = '".$param['kd_docno']."' AND TAHUN = '".$param['tahun']."' AND BULAN = '".$param['bulan']."' LIMIT 1) END ADA";
		$ada = $db->query($queryada)->getRow();
		if((int)$ada->ADA ==0){
			$query = "INSERT INTO setup_docno (KD_DOCNO,URUTAN,TAHUN,BULAN,KETERANGAN) VALUES ('".$param['kd_docno']."',1,'".$param['tahun']."','".$param['bulan']."','".$param['keterangan']."')";
			$sql = $db->query($query);
		}else{
			$query = "UPDATE setup_docno SET URUTAN = URUTAN + 1 WHERE KD_DOCNO = '".$param['kd_docno']."' AND TAHUN = '".$param['tahun']."' AND BULAN = '".$param['bulan']."'";
			$sql = $db->query($query);
		}
        return (int)$ada->ADA;
	}
}
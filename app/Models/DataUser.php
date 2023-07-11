<?php

namespace App\Models;

use CodeIgniter\Model;

class DataUser extends Model
{

	public function cekUser($username){
		$db = \Config\Database::connect();
		$query = "SELECT USERNAME, PASSWORD,KD_GROUPUSER,KD_IDENTIFIKASI FROM master_user WHERE USERNAME = '".$username."' AND ROW_STATUS = 0 LIMIT 1";
		$sql = $db->query($query);
        return $sql->getResult();
	}
	public function simpanUser($param){
		if(substr($param['id_register'],0,3) == 'PEL'){
			$id_pengenal = "Pelanggan";
		}else{
			$id_pengenal = "Teknisi";
		}
		$db = \Config\Database::connect();
		$this->db->transStart();
		$query = "INSERT INTO master_user (USERNAME, PASSWORD,KD_GROUPUSER,KD_IDENTIFIKASI, CREATED_TIME, ROW_STATUS) VALUES ('".$param['username']."','".$param['password']."','".$id_pengenal."','".$param['id_register']."',CURRENT_TIMESTAMP(),0)";
		$sql = $db->query($query);
		$hasil = $this->db->transStatus() ;
		if ($this->db->transStatus() === false) {
			$this->db->transRollback();
			return $hasil;
		} else {
			$this->db->transCommit();
			return $hasil;
		}
	}
}
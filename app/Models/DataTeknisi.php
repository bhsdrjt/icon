<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTeknisi extends Model
{
    protected $table      = 'master_teknisi';
    
    public function getTeknisi()
    {
        $db = \Config\Database::connect();
		$query = "SELECT * FROM master_teknisi";
		$sql = $db->query($query);
        return $sql->getResult();
    }

    public function saveTeknisi($param)
    {
        $db = \Config\Database::connect();
        $this->db->transStart();
        $query = "INSERT INTO master_teknisi (NO_PEGAWAI,NAMA,JABATAN,ALAMAT,EMAIL,NO_TELEPON) VALUES ('".$param['no_pegawai']."','".$param['nama']."','".$param['jabatan']."','".$param['alamat']."','".$param['email']."','".$param['no_telp']."')";
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


    public function buatIdTeknisi()
    {
        $db      = \Config\Database::connect();
        $kode = $db->table('tb_icon_user')
            ->select('RIGHT(id_icon,3) as id_icon', false)
            ->orderBy('id_icon', 'DESC')
            ->limit(1)->get()->getRowArray();

        $kode1 = isset($kode['id_icon']) ? $kode['id_icon'] : '';
        if ($kode1 == null) {
            $no = 1;
        } else {
            $no = intval($kode1) + 1;
        }
        $kodebaku = "U";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $id_icon = $kodebaku . $batas;
        return $id_icon;
    }

    public function cekID($id_pelanggan)
    {
        $db = \Config\Database::connect();
        $query = "SELECT * FROM master_teknisi WHERE NO_PEGAWAI = '".$id_pelanggan."' LIMIT 1";
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

    function hapus_data($id){
        $db = \Config\Database::connect();
        $this->db->transStart();
        $query = "DELETE FROM master_teknisi WHERE ID = '".$id."'";
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

}

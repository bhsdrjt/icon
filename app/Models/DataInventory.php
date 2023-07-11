<?php

namespace App\Models;

use CodeIgniter\Model;

class DataInventory extends Model
{
	protected $table      = 'master_inventory';
    // protected $primaryKey = 'id_icon';
    // protected $allowedFields = [
    //     'id_icon', 'nama_icon', 'jk_icon', 'no_hape_icon', 'umur_icon', 'alamat_icon', 'password', 'id_role_icon'
    // ];

    
    public function getInventory()
    {
        $db = \Config\Database::connect();
		$query = "SELECT *, CASE WHEN (SELECT STOCK FROM master_inventory_stock B WHERE A.KD_INVENTORY = B.KD_INVENTORY) IS NULL THEN 0 ELSE (SELECT STOCK FROM master_inventory_stock B WHERE A.KD_INVENTORY = B.KD_INVENTORY) END STOCK FROM master_inventory A";
		$sql = $db->query($query);
        return $sql->getResult();
    }
    public function saveInventory($inventory)
    {
        $db = \Config\Database::connect();
        $date = date('Y-m-d');
        $this->db->transStart();
        $query = "INSERT INTO master_inventory (KD_INVENTORY,NAMA_INVENTORY,JENIS,CREATED_TIME,ROW_STATUS) VALUES ('".$inventory['no_inv']."','".$inventory['nama_inventory']."','".$inventory['jenis_inventory']."','".$date."','0')";
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

    public function cekStock($id){
        $db = \Config\Database::connect();
        $query = "SELECT * FROM master_inventory_stock WHERE KD_INVENTORY = '".$id."' AND ROW_STATUS = 0";
        $sql = $db->query($query);
        $data = $sql->getNumRows();
        return $data;
    }
    
    public function saveStock($stock){
        $db = \Config\Database::connect();
        $date = date('Y-m-d');
        $this->db->transStart();
        $query = "INSERT INTO master_inventory_stock (KD_INVENTORY,STOCK,CREATED_TIME,ROW_STATUS) VALUES ('".$stock['kd_inventory_stock']."','".$stock['stock']."','".$date."','0')";
        $sql = $db->query($query);
        $this->db->transComplete();
		$result['status'] = $this->db->transStatus();;
        $result['param'] = $this->db->getLastQuery();
        return $result;
    }

    public function updateStock($stock){
        $db = \Config\Database::connect();
        $date = date('Y-m-d');
        $this->db->transStart();
        $query = "UPDATE master_inventory_stock SET STOCK = '".$stock['stock']."' WHERE KD_INVENTORY = '".$stock['kd_inventory_stock']."'";
        $sql = $db->query($query);
        $this->db->transComplete();
        $result['status'] = $this->db->transStatus();;
        $result['param'] = $this->db->getLastQuery();
        return $result;
    }

}
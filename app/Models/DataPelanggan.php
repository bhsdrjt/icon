<?php

namespace App\Models;

use CodeIgniter\Model;

class DataPelanggan extends Model
{
    protected $table      = 'master_pelanggan';
    protected $primaryKey = 'ID';

    // protected $allowedFields = ['id_pelanggan', 'nama_pelanggan', 'no_hape_pelanggan', 'jk_pelanggan', 'kecepatan', 'alamat'];
    // protected $allowedFields = ['id_pelanggan', 'nama_pelanggan', 'no_hape_pelanggan', 'jk_pelanggan', 'kecepatan', 'alamat'];


    public function getPelanggan()
    {
        $db = \Config\Database::connect();
		$query = "SELECT * FROM master_pelanggan";
		$sql = $db->query($query);
        return $sql->getResult();
    }
    public function buatIdPelanggan()
    {
        $db      = \Config\Database::connect();
        $kode = $db->table('tb_pelanggan')
            ->select('RIGHT(id_pelanggan,3) as id_pelanggan', false)
            ->orderBy('id_pelanggan', 'DESC')
            ->limit(1)->get()->getRowArray();

        $kode1 = isset($kode['id_pelanggan']) ? $kode['id_pelanggan'] : '';
        if ($kode1 == null) {
            $no = 1;
        } else {
            $no = intval($kode1) + 1;
        }
        $kodebaku = "P";
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $id_gangguan = $kodebaku . $batas;
        return $id_gangguan;
    }
    public function savePelanggan($param)
    {
        $db = \Config\Database::connect();
        $this->db->transStart();
        $query = "INSERT INTO master_pelanggan (NO_PELANGGAN,NAMA,NIK,ALAMAT,EMAIL,NO_TELEPON, BANDWITH,CREATED_TIME) VALUES ('".$param['no_pelanggan']."','".$param['nama']."','".$param['nik']."','".$param['alamat']."','".$param['email']."','".$param['no_telp']."','".$param['bandwith']."',CURRENT_TIMESTAMP())";
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

    
    
    public function simpan_perubahanBandwith($param){
        $db = \Config\Database::connect();
        $this->db->transStart();
        $query = "UPDATE master_pelanggan SET BANDWITH = '".$param['bandwith']."' WHERE NO_PELANGGAN = '".$param['id_pelanggan']."'";
        $sql = $db->query($query);
        $no_penanganan = $this->generateIdPenanganan();
        $query2 = "INSERT INTO trans_penanganan (NO_PENANGANAN, STATUS_PENANGANAN, JENIS_PENANGANAN, NO_LAPORAN, KETERANGAN) VALUES ('".$no_penanganan."', 2, 'perubahan bandwith', '".$param['id_laporan']."', 'Perubahan bandwith pelanggan ".$param['id_pelanggan']." menjadi ".$param['bandwith']."')";
        $sql2 = $db->query($query2);
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

    function hapus_data($id){
        $db = \Config\Database::connect();
        $this->db->transStart();
        $query = "DELETE FROM master_pelanggan WHERE ID = '".$id."'";
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

    public function cekID($id_pelanggan)
    {
        $db = \Config\Database::connect();
        $query = "SELECT * FROM master_pelanggan WHERE NO_PELANGGAN = '".$id_pelanggan."' LIMIT 1";
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
}

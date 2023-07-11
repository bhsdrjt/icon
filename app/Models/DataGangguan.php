<?php

namespace App\Models;

use CodeIgniter\Model;

class DataGangguan extends Model
{
    protected $table      = 'tb_gangguan';
    protected $primaryKey = 'id_gangguan';
    protected $useTimestamps = true;
    protected $createdField = 'tgl_lapor';
    protected $updatedField = false;
    protected $allowedFields = ['id_gangguan', 'id_pelanggan', 'id_icon', 'status_gangguan', 'jenis_gangguan', 'tgl_selesai', 'keterangan', 'balasan'];

    // // protected $allowedFields = ['id_pelanggan', 'nama_pelanggan', 'no_hape_pelanggan', 'jk_pelanggan', 'kecepatan', 'alamat'];
    // protected $allowedFields = ['id_pelanggan', 'nama_pelanggan', 'no_hape_pelanggan', 'jk_pelanggan', 'kecepatan', 'alamat'];


    public function getGangguan($id_gangguan = false)
    {

        // Hasil: SELECT * FROM biodata

        if ($id_gangguan == false) {
            return $this->select('*')->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan')->where('status_gangguan =', 'Belum Diproses')->findAll();
        }
        return $this->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan')->where(['id_gangguan' => $id_gangguan])->first();
    }

    public function getGangguanTeknisiDetail($id_gangguan = false)
    {

        // Hasil: SELECT * FROM biodata

        if ($id_gangguan == false) {
            return $this->select('*')->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan')->join('tb_icon_user', 'tb_icon_user.id_icon = tb_gangguan.id_icon')->where('status_gangguan =', 'Belum Diproses')->findAll();
        }
        return $this->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan')->join('tb_icon_user', 'tb_icon_user.id_icon = tb_gangguan.id_icon')->where(['id_gangguan' => $id_gangguan])->first();
    }

    public function getGangguanTeknisi($id_icon)
    {
        // 
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_gangguan');
        $builder->select('*');
        $builder->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan');
        $builder->Where('id_icon =', $id_icon);
        $builder->Where('status_gangguan =', "Sedang Ditangani");
        $query = $builder->get();
        return $query->getResult();
    }

    public function getGangguanSelesai()
    {
        // 
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_gangguan');
        $builder->select('*');
        $builder->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan');
        $builder->join('tb_icon_user', 'tb_icon_user.id_icon = tb_gangguan.id_icon');
        $builder->Where('status_gangguan =', "Selesai");
        $query = $builder->get();
        return $query->getResult();
    }

    public function getGangguanDitangani()
    {
        // 
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_gangguan');
        $builder->select('*');
        $builder->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan');
        $builder->join('tb_icon_user', 'tb_icon_user.id_icon = tb_gangguan.id_icon');
        $builder->Where('status_gangguan =', "Sedang Ditangani");
        $query = $builder->get();
        return $query->getResult();
    }

    public function getGangguanTeknisiSelesai($id_icon)
    {
        // 
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_gangguan');
        $builder->select('*');
        $builder->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan');

        $builder->Where('id_icon =', $id_icon);
        $builder->Where('status_gangguan =', "Selesai");
        $query = $builder->get();
        return $query->getResult();
    }



    public function buatIdGangguan()
    {

        $db      = \Config\Database::connect();
        $kode = $db->table('tb_gangguan')
            ->select('RIGHT(id_gangguan,3) as no_urut', false)
            ->select('LEFT(id_gangguan,8) as tanggal_input', false)
            ->select('id_gangguan')
            ->orderBy('id_gangguan', 'DESC')
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


        $tgl = date('Ymd');
        $batas = str_pad($no, 3, "0", STR_PAD_LEFT);
        $id_gangguan = $tgl . $batas;
        return $id_gangguan;
    }

    public function hitung1()
    {
        // $db      = \Config\Database::connect();
        // // $kode = $db->table('tb_gangguan');
        // // $kode = $db->countAllResults();
        // // $kode = $db->Where('status_gangguan =', "Sedang Ditangani");
        // // $query = $kode->get();
        // // return $query;
        // $builder = $db->countAllResults(); // Produces an integer, like 25
        // $builder->$db->Where('status_gangguan =', "Sedang Ditangani");
        // $builder->from('my_table');
        // echo $builder->countAllResults();
    }
}

<?php

namespace App\Controllers;

use App\Models\DataGangguan;
use App\Models\DataPElanggan;

class Beranda extends BaseController
{

    protected $DataGangguan;
    protected $DataPelanggan;

    public function __construct()
    {
        $this->DataGangguan = new DataGangguan();
        $this->DataPelanggan = new DataPelanggan();
        $session = \Config\Services::session();
    }
    public function home()
    {
        $data = [
            'title' => 'Beranda',
            'aktif' => '1'
        ];
        return view('Beranda/home_v', $data);
    }
    public function buatLaporan()
    {
        session();
        $data = [
            'title' => 'Buat Laporan',
            'aktif' => '2',
            'validation' => \Config\Services::validation()
        ];
        echo view('Beranda/buatLaporan_v', $data);
    }

    
    public function statusLaporan()
    {
        session();
        $data = [
            'title' => 'Kontak',
            'aktif' => '3',
            'validation' => \Config\Services::validation()
        ];

        echo view('Beranda/statusLaporan_v', $data);
    }

    public function search()
    {
        $cari = $this->request->getVar('cari');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'cari' => [
                'label' => 'ID Gangguan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ],
            ]
        ]);

        if (!$valid) {
            $sessError = [
                'errID' => $validation->getError('id')
            ];
            session()->setFlashdata($sessError);
            // return redirect()->to('/Login/index');
        } else {

            $cekid = $this->DataGangguan_m->find($cari);
            if ($cekid == null) {
                $sessError = [
                    'errID' => 'ID Gangguan tidak terdaftar'
                ];
                session()->setFlashdata($sessError);
                return redirect()->to('/Beranda/statusLaporan');
            } else if ($cekid['id_icon'] == null) {


                $id_gangguan = $cari;
                $status = $cekid['status_gangguan'];
                $balasan = $cekid['balasan'];
                // ];
                session()->setflashdata('id', $id_gangguan);
                session()->setflashdata('status', $status);
                session()->setflashdata('balasan', $balasan);
                // session()->set_flashdata('cari', $id_gangguan);
                return redirect()->to('/Beranda/statusLaporan');
            } else {

                $cekid2 = $this->DataGangguan_m->join('tb_icon_user', 'tb_icon_user.id_icon = tb_gangguan.id_icon')->find($cari);

                $id_gangguan = $cari;
                $status = $cekid2['status_gangguan'];
                $nama_teknisi = $cekid2['nama_icon'];
                $balasan = $cekid2['balasan'];
                $hape = $cekid2['no_hape_icon'];
                // ];
                session()->setflashdata('id', $id_gangguan);
                session()->setflashdata('status', $status);
                session()->setflashdata('balasan', $balasan);
                session()->setflashdata('teknisi', $nama_teknisi);
                session()->setflashdata('hape', $hape);
                // session()->set_flashdata('cari', $id_gangguan);
                return redirect()->to('/Beranda/statusLaporan');
            }
        }
    }
}

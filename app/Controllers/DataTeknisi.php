<?php

namespace App\Controllers;

// use App\Models\DataTeknisi_m;
use App\Models\DataRole_m;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataTeknisi extends BaseController
{
    protected $DataTeknisi_m;
    protected $DataRole_m;

    public function __construct()
    {
        // $this->DataTeknisi_m = new DataTeknisi_m();
        $this->DataRole_m = new DataRole_m();
    }

    public function tabelTeknisi()
    {
        $data = [
            'Teknisi' => $this->DataTeknisi_m->getIcon()
        ];
        return view('Admin/tabelTeknisi_v', $data);
    }

    public function tambahTeknisi()
    {
        session();
        $data = [
            'title' => 'Tambah Pelanggan',
            'role' => $this->DataRole_m->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        echo view('Admin/tambahTeknisi_v', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());
        if (!$this->validate([
            'nama_teknisi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Teknisi Harus Diisi.',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomer Handphone Harus Diisi'
                    // 'numeric' => 'Masukan Nomor Handphone Yang Benar'
                ],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role Harus Diisi'
                ]
            ],
            'no_hape' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No HandPhone Harus Diisi'
                ]
            ],
            'umur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Umur Harus Diisi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus Diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/DataTeknisi/tambahTeknisi')->withInput()->with('validation', $validation);
        }
        $this->DataTeknisi_m->insert([
            'id_icon' => $this->DataTeknisi_m->buatIdTeknisi(),
            'nama_icon' => $this->request->getVar('nama_teknisi'),
            'password' => $this->request->getVar('password'),
            'id_role_icon' => $this->request->getVar('role'),
            'no_hape_icon' => $this->request->getVar('no_hape'),
            'jk_icon' => $this->request->getVar('jk'),
            'umur_icon' => $this->request->getVar('umur'),
            'alamat_icon' => $this->request->getVar('alamat')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/DataTeknisi/tabelTeknisi');
        // dd($this->DataPelanggan_m->buatIdPelanggan())   ;

    }
    public function downloadExcel()
    {
        // $mhs_obj = new MahasiswaModel(); //buat aobjek baru dari model
        // $mhs = $mhs_obj->findAll(); //query menampilkn semua data pada tabel mahasiswa
        $data = $this->DataTeknisi_m->getTeknisi();
        $fileName = 'Data-Teknisi.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //format dalam excel nantinya
        $sheet->setCellValue('A1', 'DATA TEKNISI ICONNET');
        $sheet->setCellValue('A2', 'ID');
        $sheet->setCellValue('B2', 'NAMA');
        $sheet->setCellValue('C2', 'ROLE');
        $sheet->setCellValue('D2', 'NOHP');
        $sheet->setCellValue('E2', 'UMUR');
        $sheet->setCellValue('F2', 'JK');
        $sheet->setCellValue('G2', 'ALAMAT');
        $rows = 3;

        //menggabungkan data atribut kedalam cell excel
        foreach ($data as $val) {
            $sheet->setCellValue('A' . $rows, $val->id_icon);
            $sheet->setCellValue('B' . $rows, $val->nama_icon);
            $sheet->setCellValue('C' . $rows, $val->id_role_icon);
            $sheet->setCellValue('D' . $rows, $val->no_hape_icon);
            $sheet->setCellValue('E' . $rows, $val->umur_icon);
            $sheet->setCellValue('F' . $rows, $val->jk_icon);
            $sheet->setCellValue('G' . $rows, $val->alamat_icon);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
        $filepath = $fileName;
        $writer->save($filepath);

        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush();
        readfile($filepath);
        exit;
        return redirect()->to('/DataTeknisi/tabelTeknisi');
    }
}

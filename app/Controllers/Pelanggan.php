<?php

namespace App\Controllers;


use App\Models\DataPelanggan;
use App\Models\DataDocno;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pelanggan extends BaseController
{
    protected $DataPelanggan;
    protected $DataDocno;

    public function __construct()
    {
        $this->DataPelanggan = new DataPelanggan();
        $this->DataTeknisi = new DataTeknisi();
        $this->DataDocno = new DataDocno();
    }

    public function MasterPelanggan(){
        return view('Admin/Pelanggan/list_Pelanggan');
    }
    public function getPelanggan(){
        $data = $this->DataPelanggan->getPelanggan();
        echo json_encode($data);
    }

    public function savePelanggan(){
        $param = array(
            'kd_docno' => 'PEL',
            'bulan' => date('m'),
            'tahun' => date('Y'),
            'keterangan'=> 'Penomoran Kode Pelanggan'
        );
        $cekDocno = $this->DataDocno->cekDocno($param);
        // var_dump($cekDocno);exit;
        if($cekDocno == 0){
            $no_pelanggan = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-00001";
        }else{
            $no = $cekDocno +1;
            $no_pelanggan = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-".str_pad($no, 5, '0', STR_PAD_LEFT);
        }
        $pelanggan = $_POST;
        $pelanggan['no_pelanggan'] = $no_pelanggan;
        $hasil = $this->DataPelanggan->savePelanggan($pelanggan);
        // var_dump($hasil);
        if($hasil){
			echo json_encode(array(
				'status'=>'true',
				'message'=>'Data berhasil disimpan'));
		}else{
			echo json_encode(array(
				'status'=>'false',
				'message'=>'Data gagal disimpan'));
		}
    }

    public function hapusPelanggan(){
        $id = $this->request->getPost('id');
        $hasil = $this->DataPelanggan->hapus_data($id);
		if($hasil){
			echo json_encode(array(
				'status'=>'true',
				'message'=>'Data berhasil disimpan'));
		}else{
			echo json_encode(array(
				'status'=>'false',
				'message'=>'Data gagal disimpan'));
		}

    }

    public function ExcelPelanggan(){
		$data = $this->DataPelanggan->getPelanggan();

		$fileName = 'Data-Pelanggan.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //format dalam excel nantinya
        $sheet->setCellValue('A1', 'DATA PELANGGAN')->mergeCells("A1:I1");
		
		
		
        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'NO PELANGGAN');
        $sheet->setCellValue('C2', 'NAMA');
        $sheet->setCellValue('D2', 'NIK');
        $sheet->setCellValue('E2', 'EMAIL');
        $sheet->setCellValue('F2', 'NO_TELEPON');
        $sheet->setCellValue('G2', 'ALAMAT');
        $sheet->setCellValue('H2', 'BANDWITH');
        $sheet->setCellValue('I2', 'TANGGAL DAFTAR');
        $rows = 3;

        //menggabungkan data atribut kedalam cell excel
        foreach ($data as $val) {
	
			$no = 1;
            $sheet->setCellValue('A' . $rows, $no)->getColumnDimension('A')->setWidth(10);
            $sheet->setCellValue('B' . $rows, $val->NO_PELANGGAN)->getColumnDimension('B')->setWidth(22);
            $sheet->setCellValue('C' . $rows, $val->NAMA)->getColumnDimension('C')->setWidth(50);
            $sheet->setCellValue('D' . $rows, $val->NIK)->getColumnDimension('D')->setWidth(23);
            $sheet->setCellValue('E' . $rows, $val->EMAIL)->getColumnDimension('E')->setWidth(23);
            $sheet->setCellValue('F' . $rows, $val->NO_TELEPON)->getColumnDimension('F')->setWidth(28);
            $sheet->setCellValue('G' . $rows, $val->ALAMAT)->getColumnDimension('G')->setWidth(50);
            $sheet->setCellValue('H' . $rows, $val->BANDWITH)->getColumnDimension('H')->setWidth(26);
            $sheet->setCellValue('I' . $rows, $val->CREATED_TIME)->getColumnDimension('I')->setWidth(30);
            // $sheet->setCellValue('G' . $rows, $val->alamat_icon);
            $rows++;
			$no++;
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
        return redirect()->to('/Pelanggan/MasterPelanggan');
	}


    // public function tabelPelanggan()
    // {
    //     // $pelanggan = $this->DataPelanggan_m->findAll();
    //     $data = [
    //         'pelanggan' => $this->DataPelanggan_m->getPelanggan()
    //     ];
    //     return view('Admin/tabelPelanggan_v', $data);
    // }

    // public function tambahPelanggan()
    // {
    //     session();
    //     $data = [
    //         'title' => 'Tambah Pelanggan',
    //         'validation' => \Config\Services::validation()
    //     ];
    //     echo view('Admin/tambahPelanggan_v', $data);
    // }

    // public function detail($id_pelanggan)
    // {
    //     // $pelanggan = $this->DataPelanggan_m->getPelanggan($id_pelanggan);
    //     $data = [
    //         'title' => 'Detail Pelanggan',
    //         'pelanggan' => $this->DataPelanggan_m->getPelanggan($id_pelanggan)
    //     ];

    //     return view('Admin/detailPelanggan_v', $data);

    //     if (empty($data['pelanggan'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Pelanggan dengan kode ' . $id_pelanggan . ' tidak ditemukan');
    //     }
    //     // return view('Admin/detailPelanggan_v', $data);
    //     echo $id_pelanggan;
    // }

    // public function save()
    // {
    //     // dd($this->request->getVar());
    //     if (!$this->validate([
    //         'nama_pelanggan' => [
    //             'rules'  => 'required',
    //             'errors' => [
    //                 'required' => 'Nama Pelanggan Harus Diisi.',
    //             ],
    //         ],
    //         'no_hape_pelanggan' => [
    //             'rules' => 'required', 'numeric',
    //             'errors' => [
    //                 'required' => 'Nomer Handphone Harus Diisi',
    //                 'numeric' => 'Masukan Nomor Handphone Yang Benar'
    //             ],
    //         ],
    //         'kecepatan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Kecepatan Pelanggan Harus Diisi'
    //             ]
    //         ],
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Alamat Pelanggan Harus Diisi'
    //             ]
    //         ]
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         return redirect()->to('/DataPelanggan/tambahPelanggan')->withInput()->with('validation', $validation);
    //     }
    //     $this->DataPelanggan_m->insert([
    //         'id_pelanggan' => $this->DataPelanggan_m->buatIdPelanggan(),
    //         'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
    //         'no_hape_pelanggan' => $this->request->getVar('no_hape_pelanggan'),
    //         'jk_pelanggan' => $this->request->getVar('jk'),
    //         'kecepatan' => $this->request->getVar('kecepatan'),
    //         'alamat' => $this->request->getVar('alamat')
    //     ]);
    //     session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
    //     return redirect()->to('/DataPelanggan/tabelPelanggan');
    //     dd($this->DataPelanggan_m->buatIdPelanggan());
    // }

    // public function delete($id_pelanggan)
    // {
    //     $this->DataPelanggan_m->delete($id_pelanggan);
    //     session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
    //     return redirect()->to('DataPelanggan/tabelPelanggan');
    // }

    // public function edit($id_pelanggan)
    // {
    //     $data = [
    //         'title' => 'Detail Pelanggan',
    //         'pelanggan' => $this->DataPelanggan_m->getPelanggan($id_pelanggan),
    //         'validation' => \Config\Services::validation()
    //     ];
    //     return view('Admin/editPelanggan_v', $data);
    // }

    // public function update($id_pelanggan)
    // {
    //     if (!$this->validate([
    //         'nama_pelanggan' => [
    //             'rules'  => 'required',
    //             'errors' => [
    //                 'required' => 'Nama Pelanggan Harus Diisi.',
    //             ],
    //         ],
    //         'no_hape_pelanggan' => [
    //             'rules' => 'required', 'numeric',
    //             'errors' => [
    //                 'required' => 'Nomer Handphone Harus Diisi',
    //                 'numeric' => 'Masukan Nomor Handphone Yang Benar'
    //             ],
    //         ],
    //         'kecepatan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Kecepatan Pelanggan Harus Diisi'
    //             ]
    //         ],
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => 'Alamat Pelanggan Harus Diisi'
    //             ]
    //         ]
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         return redirect()->to('/DataPelanggan/tambahPelanggan')->withInput()->with('validation', $validation);
    //     }

    //     $this->DataPelanggan_m->save([
    //         'id_pelanggan' => $id_pelanggan,
    //         'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
    //         'no_hape_pelanggan' => $this->request->getVar('no_hape_pelanggan'),
    //         'jk_pelanggan' => $this->request->getVar('jk'),
    //         'kecepatan' => $this->request->getVar('kecepatan'),
    //         'alamat' => $this->request->getVar('alamat')
    //     ]);
    //     session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
    //     return redirect()->to('/DataPelanggan/tabelPelanggan');
    //     // dd($this->DataPelanggan_m->buatIdPelanggan());
    // }

    // public function downloadExcel()
    // {
    //     // $mhs_obj = new MahasiswaModel(); //buat aobjek baru dari model
    //     // $mhs = $mhs_obj->findAll(); //query menampilkn semua data pada tabel mahasiswa
    //     $data = $this->DataPelanggan_m->getPelanggan();
    //     $fileName = 'Data_PElanggan.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();
    //     //format dalam excel nantinya
    //     $sheet->setCellValue('A1', 'DATA PELANGGAN ICONNET');
    //     $sheet->setCellValue('A2', 'ID');
    //     $sheet->setCellValue('B2', 'NAMA');
    //     $sheet->setCellValue('C2', 'KECEPATAN INTERNET');
    //     $sheet->setCellValue('D2', 'NOHP');
    //     $sheet->setCellValue('E2', 'JK');
    //     $sheet->setCellValue('F2', 'ALAMAT');
    //     $rows = 3;

    //     //menggabungkan data atribut kedalam cell excel
    //     foreach ($data as $val) {
    //         $sheet->setCellValue('A' . $rows, $val['id_pelanggan']);
    //         $sheet->setCellValue('B' . $rows, $val['nama_pelanggan']);
    //         $sheet->setCellValue('C' . $rows, $val['kecepatan']);
    //         $sheet->setCellValue('D' . $rows, $val['no_hape_pelanggan']);
    //         $sheet->setCellValue('E' . $rows, $val['jk_pelanggan']);
    //         $sheet->setCellValue('F' . $rows, $val['alamat']);
    //         $rows++;
    //     }
    //     $writer = new Xlsx($spreadsheet);
    //     $filepath = $fileName;
    //     $writer->save($filepath);

    //     header("Content-Type: application/vnd.ms-excel");
    //     header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    //     header('Expires: 0');
    //     header('Cache-Control: must-revalidate');
    //     header('Pragma: public');
    //     header('Content-Length: ' . filesize($filepath));
    //     flush();
    //     readfile($filepath);
    //     exit;
    //     return redirect()->to('/DataPelanggan/tabelPelanggan');
    // }
}

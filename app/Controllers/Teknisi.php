<?php

namespace App\Controllers;

// use App\Models\DataGangguan_m;
use App\Models\DataTeknisi;
use App\Models\DataDocno;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Teknisi extends BaseController
{
    // protected $DataGangguan_m;
    protected $DataTeknisi;
    protected $DataDocno;

    public function __construct()
    {
        // $this->DataGangguan_m = new DataGangguan_m();
        $this->DataTeknisi = new DataTeknisi();
        $this->DataDocno = new DataDocno();
    }

    public function MasterTeknisi()
    {
        echo view('Admin/Teknisi/list_Teknisi');
    }

    public function getTeknisi(){
        $data = $this->DataTeknisi->getTeknisi();
        // var_dump($data);
        echo json_encode($data);
    }

    public function saveTeknisi(){
        $param = array(
            'kd_docno' => 'TEK',
            'bulan' => date('m'),
            'tahun' => date('Y'),
            'keterangan'=> 'Penomoran Kode Teknisi'
        );
        $cekDocno = $this->DataDocno->cekDocno($param);
        if($cekDocno == 0){
            $no_pegawai = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-00001";
        }else{
            $no = $cekDocno +1;
            $no_pegawai = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-".str_pad($no, 5, '0', STR_PAD_LEFT);
        }
        $teknisi = $_POST;
        $teknisi['no_pegawai'] = $no_pegawai;
        $hasil = $this->DataTeknisi->saveTeknisi($teknisi);
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




    public function detail($id_gangguan)
    {
        // $pelanggan = $this->DataPelanggan_m->getPelanggan($id_pelanggan);
        $data = [
            'title' => 'Detail Pelanggan',
            'gangguan' => $this->DataGangguan_m->getGangguan($id_gangguan),
            'validation' => \Config\Services::validation()
        ];

        return view('/Admin/detailGangguanTeknisi_v', $data);

        if (empty($data['gangguan'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID dengan kode ' . $id_gangguan . ' tidak ditemukan');
        }
        // return view('Admin/detailPelanggan_v', $data);
        // echo $id_pelanggan;
    }
    public function selesai($id_gangguan)
    {
        $tgl = date('Ymd');
        $this->DataGangguan_m->save([
            'id_gangguan' =>  $id_gangguan,
            'id_pelanggan' => $this->request->getVar('pelanggan'),
            'id_icon' => $this->request->getVar('teknisi'),
            'status_gangguan' => "Selesai",
            'jenis_gangguan' => $this->request->getVar('jenis'),
            'tgl_lapor' => $this->request->getVar('tgl_lapor'),
            'tgl_selesai' => $tgl,
            'keterangan' => $this->request->getVar('keterangan'),
            'balasan' => $this->request->getVar('balasan')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/Teknisi/dashboard');
        // dd($this->request->getVar());
        // dd($this->DataPelanggan_m->buatIdPelanggan());
    }

    public function tabelSelesai()
    {
        $id_icon = session()->get('id_icon');
        $data = [
            'gangguan' => $this->DataGangguan_m->getGangguanTeknisiSelesai($id_icon)
        ];
        echo view('Admin/tabelSelesaiTeknisi_v', $data);
    }

    public function hapusTeknisi(){
        $id = $this->request->getPost('id');
        $hasil = $this->DataTeknisi->hapus_data($id);
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

    function htmlToPDF($id_gangguan)
    {
        $data = [
            'gangguan' => $this->DataGangguan_m->getGangguanTeknisiDetail($id_gangguan)
        ];
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('/Admin/pdf_gangguan_v', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
    public function ExcelTeknisi(){
		$data = $this->DataTeknisi->getTeknisi();

		$fileName = 'Data-Teknisi.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //format dalam excel nantinya
        $sheet->setCellValue('A1', 'DATA TEKNISI')->mergeCells("A1:I1");
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
		
		
		
        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'NO PEGAWAI');
        $sheet->setCellValue('C2', 'NAMA');
        $sheet->setCellValue('D2', 'JABATAN');
        $sheet->setCellValue('E2', 'EMAIL');
        $sheet->setCellValue('F2', 'NO_TELEPON');
        $sheet->setCellValue('G2', 'ALAMAT');
        $sheet->setCellValue('H2', 'TANGGAL DAFTAR');
        $rows = 3;

        //menggabungkan data atribut kedalam cell excel
        foreach ($data as $val) {
	
			$no = 1;
            $sheet->setCellValue('A' . $rows, $no)->getColumnDimension('A')->setWidth(10);
            $sheet->setCellValue('B' . $rows, $val->NO_PEGAWAI)->getColumnDimension('B')->setWidth(22);
            $sheet->setCellValue('C' . $rows, $val->NAMA)->getColumnDimension('C')->setWidth(50);
            $sheet->setCellValue('D' . $rows, $val->JABATAN)->getColumnDimension('D')->setWidth(23);
            $sheet->setCellValue('E' . $rows, $val->EMAIL)->getColumnDimension('E')->setWidth(28);
            $sheet->setCellValue('F' . $rows, $val->NO_TELEPON)->getColumnDimension('F')->setWidth(26);
            $sheet->setCellValue('G' . $rows, $val->ALAMAT)->getColumnDimension('G')->setWidth(50);
            $sheet->setCellValue('H' . $rows, $val->CREATED_TIME)->getColumnDimension('H')->setWidth(30);
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
        return redirect()->to('/Teknisi/MasterTeknisi');
	}
}

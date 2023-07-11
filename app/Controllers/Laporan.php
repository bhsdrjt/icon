<?php 

namespace App\Controllers;

// use App\Models\DataGangguan_m;
// use App\Models\DataTeknisi_m;
use App\Models\DataLaporan;
use App\Models\DataPenanganan;
use App\Models\DataDocno;
use App\Models\DataPelanggan;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    protected $DataLaporan;
	protected $DataPenanganan;
	protected $DataDocno;
	protected $DataPelanggan;

    public function __construct()
    {
        $this->DataLaporan = new DataLaporan();
        $this->DataPenanganan = new DataPenanganan();
        $this->DataDocno = new DataDocno();
        $this->DataPelanggan = new DataPelanggan();
		$session = \Config\Services::session();
		$dompdf = new \Dompdf\Dompdf();
    }

	public function Penanganan(){
        return view('Admin/Penanganan/list_Penanganan');
    }
	public function getPenanganan(){
		if($_SESSION['role'] == 'Teknisi'){
			$teknisi = $_SESSION['pengenal'];
			$data = $this->DataPenanganan->getPenangananTeknisi($teknisi);
		}else{
			$data = $this->DataPenanganan->getPenanganan();
		}
		// var_dump($_SESSION['role']);exit;
		echo json_encode($data);
	}

	public function Maintenance(){
        return view('Admin/Maintenance/list_Maintenance');
    }
	public function getMaintenance(){
		$param = array(
			'bulan' => ($this->request->getGet('bulan')) ? $this->request->getGet('bulan') : date('m'),
			'tahun' => ($this->request->getGet('tahun')) ? $this->request->getGet('tahun') : date('Y')
		);
		$data = $this->DataPenanganan->getMaintenance();
		echo json_encode($data);
	}
	
	public function getdetailLaporan(){
		$no_laporan = $this->request->getPost('no_laporan');
		$data = $this->DataLaporan->getdetailLaporan($no_laporan);
		// var_dump($data);
		echo json_encode($data);
	}
	
	public function LaporanMasuk(){
		$tahun = $this->DataLaporan->getTahun();
		$data = [
			'tahun' => $tahun[0]->TAHUN,
			'bulan' => $tahun[0]->BULAN,
			'title' => 'Laporan Masuk',
			'aktif' => '1',
		];
		return view('Admin/Laporan/list_LaporanMasuk',$data);
    }
	public function getLaporan(){
		$param = array(
			'bulan' => ($this->request->getPost('bulan')) ? $this->request->getPost('bulan') : date('m'),
			'tahun' => ($this->request->getPost('tahun')) ? $this->request->getPost('tahun') : date('Y'),
			'status' => ($this->request->getPost('status')) ? $this->request->getPost('status') : '0',
			'jenis' => ($this->request->getPost('jenis')) ? $this->request->getPost('jenis') : '0'
		);
		$data = $this->DataLaporan->getLaporanMasuk($param);
		// var_dump($data);
		echo json_encode($data);
	}
	public function getLaporanPelanggan(){
		$pelanggan = $_SESSION['pengenal'];
		$param = array(
			'bulan' => ($this->request->getGet('bulan')) ? $this->request->getGet('bulan') : date('m'),
			'tahun' => ($this->request->getGet('tahun')) ? $this->request->getGet('tahun') : date('Y')
		);
		$data = $this->DataLaporan->getLaporanPelanggan($pelanggan);
		echo json_encode($data);
	}
	public function simpanDisposisi(){
		helper('array');
		$detail = $_POST['detail'];
		$id_laporan = $_POST['id_laporan'];
		$jenis = $_POST['jenis'];
		$keterangan = (isset($_POST['keterangan'])) ? $_POST['keterangan'] : " ";
		$tipe_pengerjaan = (isset($_POST['tipe_pengerjaan'])) ? $_POST['tipe_pengerjaan'] : "";
		// dd($keterangan);exit;
		$hasil = $this->DataPenanganan->simpanPenanganan($id_laporan,$detail, $jenis, $keterangan, $tipe_pengerjaan);
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

	public function saveLaporan(){
		helper('array');
		$laporan = $_POST;
		$param = array(
            'kd_docno' => 'LAP',
            'bulan' => date('m'),
            'tahun' => date('Y'),
            'keterangan'=> 'Penomoran Kode Laporan'
        );
        $cekDocno = $this->DataDocno->cekDocno($param);
        if($cekDocno == 0){
            $no_laporan = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-00001";
        }else{
            $no = $cekDocno +1;
            $no_laporan = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-".str_pad($no, 5, '0', STR_PAD_LEFT);
        }

        $laporan['no_laporan'] = $no_laporan;
		$laporan['id_pelanggan'] = $this->request->getPost('id_pelanggan');
		// var_dump($laporan);
		$hasil = $this->DataLaporan->saveLaporan($laporan);
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
	

	public function simpanPenangananSelesai(){
		$detail = $_POST['detail'];
		$no_penanganan = $_POST['no_penanganan'];
		$catatan = (isset($_POST['catatan'])) ? $_POST['catatan'] : " ";
		$hasil = $this->DataPenanganan->simpanPenangananSelesai($no_penanganan,$detail, $catatan);	

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

	
	public function ExcelLaporan()
    {
		$param = array(
			'bulan' => ($this->request->getGet('bulan')) ? $this->request->getGet('bulan') : date('m'),
			'tahun' => ($this->request->getGet('tahun')) ? $this->request->getGet('tahun') : date('Y'),
			'status' => ($this->request->getGet('status')) ? $this->request->getGet('status') : '0',
			'jenis' => ($this->request->getGet('jenis')) ? $this->request->getGet('jenis') : '0'
		);
		// var_dump($param);exit;
        $data = $this->DataLaporan->getLaporanMasuk($param);

		// var_dump($data);exit;
        $fileName = 'Data-Laporan.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //format dalam excel nantinya
        $sheet->setCellValue('A1', 'DATA LAPORAN MASUK');
        $sheet->setCellValue('A2', 'ID');
        $sheet->setCellValue('B2', 'NO PELAPOR');
        $sheet->setCellValue('C2', 'PELAPOR');
        $sheet->setCellValue('D2', 'KETERANGAN');
        $sheet->setCellValue('E2', 'JENIS GANGGUAN');
        $sheet->setCellValue('F2', 'TANGGAL LAPORAN');
        $rows = 3;

        //menggabungkan data atribut kedalam cell excel
		$no = 1;
        foreach ($data['data'] as $val) {
            $sheet->setCellValue('A' . $rows, $no);
            $sheet->setCellValue('B' . $rows, $val->NO_LAPORAN);
            $sheet->setCellValue('C' . $rows, $val->NAMA);
            $sheet->setCellValue('D' . $rows, $val->KETERANGAN);
            $sheet->setCellValue('E' . $rows, $val->CREATED_TIME);
            $sheet->setCellValue('F' . $rows, $val->JENIS);
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
		// return $this->response->download($name, $data);
        // exit;
        // return redirect()->to('/Laporan/LaporanMasuk');
    }
	public function ExcelPenanganan()
    {
        $data = $this->DataPenanganan->getPenangananExcel();
		// foreach($data as $val){
		// 	$teknisi =  json_decode($val->TEKNISI);
		// 	// var_dump($teknisi);$categories = array_unique($categories)
		// 	echo '<pre>'; var_dump(array_unique($teknisi, SORT_REGULAR)); echo '</pre>'; exit();
		// }exit;
		// var_dump($data);exit;
        $fileName = 'Data-Penanganan.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //format dalam excel nantinya
        $sheet->setCellValue('A1', 'DATA PENANGANAN');


        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'NO PENANGANAN');
        $sheet->setCellValue('C2', 'NO LAPORAN');
        $sheet->setCellValue('D2', 'PELAPOR');
        $sheet->setCellValue('E2', 'JENIS PENANGANAN');
        $sheet->setCellValue('F2', 'TANGGAL DITANGANI');
        $sheet->setCellValue('G2', 'TANGGAL SELESAI');
        $sheet->setCellValue('H2', 'STATUS PENANGANAN');
        $sheet->setCellValue('I2', 'KETERANGAN');
        $sheet->setCellValue('J2', 'TEKNISI YANG MENANGANI');
        $sheet->setCellValue('K2', 'INVENTORY YANG DIPAKAI');
        $rows = 3;

        //menggabungkan data atribut kedalam cell excel
		$no = 1;
        foreach ($data as $val) {
			if($val->STATUS_PENANGANAN == 1){
				$status = "BELUM SELESAI";
			}else{
				$status = "SELESAI";
			}
            $sheet->setCellValue('A' . $rows, $no);
            $sheet->setCellValue('B' . $rows, $val->NO_PENANGANAN);
            $sheet->setCellValue('C' . $rows, $val->NO_LAPORAN);
            $sheet->setCellValue('D' . $rows, $val->NAMA_PELANGGAN);
            $sheet->setCellValue('E' . $rows, $val->JENIS_PENANGANAN);
            $sheet->setCellValue('F' . $rows, $val->CREATED_TIME);
            $sheet->setCellValue('G' . $rows, $val->LASTMODIFIED_TIME);
            $sheet->setCellValue('H' . $rows, $status);
            $sheet->setCellValue('I' . $rows, $val->KETERANGAN);
			$teknisi =  json_decode($val->TEKNISI);
			$list_teknisi = '';
			$tek = "";
			if($teknisi == null){
				$list_teknisi = '-';
			}else{
				foreach (array_unique($teknisi, SORT_REGULAR) as $key => $val1 ) {
					$list_teknisi .= $val1->KD_TEKNISI . "\n";
				}
			}
            $sheet->setCellValue('J' . $rows, $list_teknisi);
			$inventory =  json_decode($val->INVENTORY);
			$list_inventory = '';
			$inv = "";
			if($inventory == null){
				$list_inventory = '-';
			}else{
				foreach (array_unique($inventory, SORT_REGULAR) as $key => $val1 ) {
					$list_inventory .= $val1->KD_INVENTORY . "\n";
				}
			}
            $sheet->setCellValue('K' . $rows, $list_inventory);
            $rows++;
			$no++;
        }
		// exit;
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
        return redirect()->to('/Laporan/Penanganan');
    }

	public function simpan_perubahanBandwith(){
		$param = [
			'id_pelanggan' => $this->request->getPost('id_pelanggan'),
			'bandwith' => $this->request->getPost('bandwith'),
			'id_laporan' => $this->request->getPost('id_laporan'),
		];
		// var_dump($param);
		$hasil = $this->DataPelanggan->simpan_perubahanBandwith($param);
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
	public function ExcelMaintenance()
    {
        // $mhs_obj = new MahasiswaModel(); //buat aobjek baru dari model
        // $mhs = $mhs_obj->findAll(); //query menampilkn semua data pada tabel mahasiswa
        $data = $this->DataPenanganan->getMaintenance();
		// var_dump($data);exit;
        $fileName = 'Data-Maintenance.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //format dalam excel nantinya
        $sheet->setCellValue('A1', 'Data Maintenance')->mergeCells("A1:F1");
		
		
		
        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'NO PENANGANAN');
        $sheet->setCellValue('C2', 'KETERANGAN');
        $sheet->setCellValue('D2', 'STATUS PENANGANAN');
        $sheet->setCellValue('E2', 'TANGGAL DITANGANI');
        $sheet->setCellValue('F2', 'TANGGAL SELESAI');
        $rows = 3;

        //menggabungkan data atribut kedalam cell excel
        foreach ($data as $val) {
			if($val->STATUS_PENANGANAN == 1){
				$status = "BELUM SELESAI";
			}else{
				$status = "SELESAI";
			}
			$no = 1;
            $sheet->setCellValue('A' . $rows, $no)->getColumnDimension('A')->setWidth(10);
            $sheet->setCellValue('B' . $rows, $val->NO_PENANGANAN)->getColumnDimension('B')->setWidth(22);
            $sheet->setCellValue('C' . $rows, $val->KETERANGAN)->getColumnDimension('C')->setWidth(50);
            $sheet->setCellValue('D' . $rows, $status)->getColumnDimension('D')->setWidth(23);
            $sheet->setCellValue('E' . $rows, $val->CREATED_TIME)->getColumnDimension('E')->setWidth(28);
            $sheet->setCellValue('F' . $rows, $val->LASTMODIFIED_TIME)->getColumnDimension('F')->setWidth(28);
;
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
        return redirect()->to('/Laporan/LaporanMasuk');
    }

	public function getdetailPenanganan(){
		// var_dump('oke');
		$no_penanganan = $this->request->getPost('no_penanganan');
		$data = $this->DataPenanganan->detaiPenanganan($no_penanganan);
		$teknisi = [];
		$inventory = [];
		$stock = [];
		$peran = [];

		if ($data['totaldata'] > 0) {
			for ($i=0; $i < $data['totaldata'] ; $i++) { 
				if($data['message'][$i]->INVENTORY == '-'){
					// array_push($teknisi,($data['message'][$i]->TEKNISI));
					$teknisi[$i]['teknisi'] = ($data['message'][$i]->TEKNISI);
					$teknisi[$i]['peran'] = ($data['message'][$i]->PERAN);
					// array_push($teknisi,($data['message'][$i]->PERAN));
				}
				if($data['message'][$i]->TEKNISI == '-'){
					$inventory[$i]['inventory'] = $data['message'][$i]->INVENTORY;
					$inventory[$i]['jumlah'] = $data['message'][$i]->STOCK;
				}
				$no_penanganan = $data['message'][$i]->NO_PENANGANAN;
				$status_penanganan = $data['message'][$i]->STATUS_PENANGANAN;
				$jenis_penanganan = $data['message'][$i]->JENIS_PENANGANAN;
				$no_laporan = $data['message'][$i]->NO_LAPORAN;
				$pelapor = $data['message'][$i]->NAMA_PELAPOR;
				$tanggal_ditangani = $data['message'][$i]->CREATED_TIME;
				$tanggal_selesai = $data['message'][$i]->LASTMODIFIED_TIME;
				$keterangan = $data['message'][$i]->KETERANGAN;
				$catatan = $data['message'][$i]->CATATAN;
			}
			// var_dump($no);
		}
		// var_dump($teknisi);
		$result = [
			'no_penanganan' => $no_penanganan,
			'no_laporan' => $no_laporan,
			'jenis_penanganan' => $jenis_penanganan,
			'pelapor' => $pelapor,
			'tanggal_ditangani' => $tanggal_ditangani,
			'tanggal_selesai' => $tanggal_selesai,
			'status_penanganan' => $status_penanganan,
			'teknisi' => $teknisi,
			'inventory' => $inventory,
			'stock' => $stock,
			'peran' => $peran,
			'catatan' => $catatan,
			'keterangan' => $keterangan,

		];
		// var_dump($result);
		echo json_encode($result);
	}


	public function printTicket($no_penanganan){
		// $no_penanganan = $this->request->getPost('no_penanganan');
		$data = $this->DataPenanganan->detaiPenanganan($no_penanganan);
		// var_dump($data);exit;
		$teknisi = [];
		$inventory = [];

		if ($data['totaldata'] > 0) {
			for ($i=0; $i < $data['totaldata'] ; $i++) { 
				if($data['message'][$i]->INVENTORY == '-'){
					// array_push($teknisi,($data['message'][$i]->TEKNISI));
					$teknisi[$i]['teknisi'] = ($data['message'][$i]->TEKNISI);
					$teknisi[$i]['kd_teknisi'] = ($data['message'][$i]->KD_TEKNISI);
					$teknisi[$i]['peran'] = ($data['message'][$i]->PERAN);
					// array_push($teknisi,($data['message'][$i]->PERAN));
				}
				if($data['message'][$i]->TEKNISI == '-'){
					$inventory[$i]['inventory'] = $data['message'][$i]->INVENTORY;
					$inventory[$i]['jumlah'] = $data['message'][$i]->STOCK;
				}
				$no_penanganan = $data['message'][$i]->NO_PENANGANAN;
				$status_penanganan = $data['message'][$i]->STATUS_PENANGANAN;
				$jenis_penanganan = $data['message'][$i]->JENIS_PENANGANAN;
				$no_laporan = $data['message'][$i]->NO_LAPORAN;
				$pelapor = $data['message'][$i]->NAMA_PELAPOR;
				$tanggal_ditangani = $data['message'][$i]->CREATED_TIME;
				$tanggal_selesai = $data['message'][$i]->LASTMODIFIED_TIME;
				$keterangan = $data['message'][$i]->KETERANGAN;
				$catatan = $data['message'][$i]->CATATAN;
				$alamat = $data['message'][$i]->ALAMAT;
				$no_telp = $data['message'][$i]->NO_TELEPON;
			}
			// var_dump($no);
		}
		// var_dump($teknisi);
		$result = [
			'no_penanganan' => $no_penanganan,
			'no_laporan' => $no_laporan,
			'jenis_penanganan' => $jenis_penanganan,
			'pelapor' => $pelapor,
			'tanggal_ditangani' => $tanggal_ditangani,
			'tanggal_selesai' => $tanggal_selesai,
			'status_penanganan' => $status_penanganan,
			'teknisi' => $teknisi,
			'inventory' => $inventory,
			'catatan' => $catatan,
			'keterangan' => $keterangan,
			'alamat' => $alamat,
			'no_telp' => $no_telp,

		];
		// var_dump($result);exit;
		$options = new \Dompdf\Options();
		$options->setTempDir('temp'); // temp folder with write permission

		$dompdf = new \Dompdf\Dompdf();
		$dompdf->setOptions($options);
        $dompdf->loadHtml(view('/Admin/pdf_gangguan_v', $result));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream();	
	}

	public function detailpekerjaanTeknisi($kd_teknisi){
		$data = $this->DataPenanganan->detailpekerjaanTeknisi($kd_teknisi);
		// var_dump($data);exit;
		if ($data['totaldata'] > 0) {
			for ($i=0; $i < $data['totaldata'] ; $i++) { 
				$nama_teknisi = $data['message'][$i]->NAMA_TEKNISI;
			}
			// var_dump($no);
		}

		$result = [
			'data' => $data['message'],
			'kd_teknisi' => $kd_teknisi,
			'nama' => $nama_teknisi

		];
		// var_dump($result);
		$options = new \Dompdf\Options();
		$options->setTempDir('temp'); // temp folder with write permission

		$dompdf = new \Dompdf\Dompdf();
		$dompdf->setOptions($options);
        $dompdf->loadHtml(view('/Admin/pdf_pekerjaanTeknisi', $result));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream();	
	}

	public function savePerubahanBandwith(){
		helper('array');
		$laporan = $_POST;

		$param = array(
            'kd_docno' => 'BW',
            'bulan' => date('m'),
            'tahun' => date('Y'),
            'keterangan'=> 'Penomoran Kode Perubahan Bandwith'
        );
        $cekDocno = $this->DataDocno->cekDocno($param);
        if($cekDocno == 0){
            $no_laporan = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-00001";
        }else{
            $no = $cekDocno +1;
            $no_laporan = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-".str_pad($no, 5, '0', STR_PAD_LEFT);
        }

        $laporan['no_laporan'] = $no_laporan;
		$laporan['id_pelanggan'] = $this->request->getPost('id_pelanggan');
		$hasil = $this->DataLaporan->savePerubahanBandwith($laporan);
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

	



}







?>
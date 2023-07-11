<?php

namespace App\Controllers;

// use App\Models\DataGangguan_m;

use App\Models\DataInventory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\DataDocno;

class Inventory extends BaseController
{
    protected $DataDocno;
    protected $DataInventory;
    
    public function __construct()
    {
        $this->DataDocno = new DataDocno();
        $this->DataInventory = new DataInventory();
    }

	public function MasterInventory()
    {
        echo view('Admin/Inventory/list_Inventory');
    }
	public function getInventory()
    {
        $data = $this->DataInventory->getInventory();
		echo json_encode($data);
    }

    public function saveInventory(){
		helper('array');
		$inventory = $_POST;
        $param = array(
            'kd_docno' => 'INV',
            'bulan' => date('m'),
            'tahun' => date('Y'),
            'keterangan'=> 'Penomoran Kode Inventory'
        );
        $cekDocno = $this->DataDocno->cekDocno($param);
        if($cekDocno == 0){
            $no_inv = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-00001";
        }else{
            $no = $cekDocno +1;
            $no_inv = $param['kd_docno'].$param['tahun'].str_pad($param['bulan'], 2, '0', STR_PAD_LEFT) . "-".str_pad($no, 5, '0', STR_PAD_LEFT);
        }

        $inventory['no_inv'] = $no_inv;
        // var_dump($inventory);exit;
		// $laporan['tgl_laporan'] = date('Y-m-d');
		// $laporan['id_pelanggan'] = "OKEOKE123";
		$hasil = $this->DataInventory->saveInventory($inventory);
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
    public function saveStock(){
		helper('array');
		$stock = $_POST;
		$id = $stock['kd_inventory_stock'];
		$ceksctock = $this->DataInventory->cekStock($id);
		// var_dump($ceksctock);exit;
		if($ceksctock >= 1){
			$hasil = $this->DataInventory->updateStock($stock);
		}else{
			$hasil = $this->DataInventory->saveStock($stock);
		}
		if($hasil['status']){
			echo json_encode(array(
				'status'=>'true',
				'message'=>'Data berhasil disimpan'));
		}else{
			echo json_encode(array(
				'status'=>'false',
				'message'=>'Data gagal disimpan'));
		}
	}

	function ExcelInventory(){
		$data = $this->DataInventory->getInventory();

		$fileName = 'Data-Maintenance.xlsx'; //nama file laporan. bisa diubah sesuai keinginan
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //format dalam excel nantinya
        $sheet->setCellValue('A1', 'DATA INVENTORY')->mergeCells("A1:D1");
		
		
		
        $sheet->setCellValue('A2', 'NO');
        $sheet->setCellValue('B2', 'KD INVENTORY');
        $sheet->setCellValue('C2', 'NAMA INVENTORY');
        $sheet->setCellValue('D2', 'STOCK');
        $rows = 3;

        //menggabungkan data atribut kedalam cell excel
        foreach ($data as $val) {
	
			$no = 1;
            $sheet->setCellValue('A' . $rows, $no)->getColumnDimension('A')->setWidth(10);
            $sheet->setCellValue('B' . $rows, $val->KD_INVENTORY)->getColumnDimension('B')->setWidth(22);
            $sheet->setCellValue('C' . $rows, $val->NAMA_INVENTORY)->getColumnDimension('C')->setWidth(50);
            $sheet->setCellValue('D' . $rows, $val->STOCK)->getColumnDimension('D')->setWidth(23);
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
        return redirect()->to('/Inventory/MasterInventory');
	}
}
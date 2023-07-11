<?php

namespace App\Controllers;

// use App\Models\DataGangguan_m;
// use App\Models\DataTeknisi_m;
use App\Models\DataLaporan;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    // protected $DataLaporan;


    public function __construct()
    {
        $session = \Config\Services::session();
        $this->DataLaporan = new DataLaporan();
    }

    public function dashboard()
    {
        // $user = $_SESSION['username'];
        // var_dump($user);
        return view('/Admin/Dashboard/dashboard');
    }

   


    

}

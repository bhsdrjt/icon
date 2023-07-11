<?php

namespace App\Controllers;

use App\Models\DataTeknisi;
use App\Models\DataUser;
use App\Models\DataPelanggan;


class Login extends BaseController
{
    protected $DataTeknisi;
    protected $DataUser;
    protected $DataPelanggan;

    public function __construct()
    {
        $this->DataTeknisi = new DataTeknisi();
        $this->DataPelanggan = new DataPelanggan();
        $this->DataUser = new DataUser();
        $session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'aktif' => '4',
        ];
        return view('/Beranda/login_v', $data);
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to('/Beranda/home');
    }

    public function LoginProcess(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $cekUser = $this->DataUser->cekUser($username);
        // var_dump($cekUser[0]->PASSWORD);

        if(count($cekUser) != 0){
            if($password != $cekUser[0]->PASSWORD ){
                $result = array ( 
                    'massage' => "Password Salah",
                    'status' => false 
                );
                echo json_encode($result);
            }else{
                $user = array(
                    'username' => $cekUser[0]->USERNAME,
                    'password' => $cekUser[0]->PASSWORD,
                    'role' => $cekUser[0]->KD_GROUPUSER,
                    'pengenal' => $cekUser[0]->KD_IDENTIFIKASI,
                    'islogin' => 1
                );
                session()->set($user);

                $result = array ( 
                    'massage' => "Berhasil Login",
                    'role' => $cekUser[0]->KD_GROUPUSER,
                    'status' => true 
                );
                echo json_encode($result);
            }
        }else{
            $result = array ( 
                'massage' => "Username dan Password Salah",
                'status' => false 
            );
            echo json_encode($result);
        }
    }

    
    public function Register(){
        $id_pelanggan = $this->request->getPost('id_register');
        // var_dump(substr($id_pelanggan,0,3));exit;
        $username = $this->request->getPost('username_register');
        $password = $this->request->getPost('password_register');
        if(substr($id_pelanggan,0,3) == 'PEL'){
			$cekID = $this->DataPelanggan->cekID($id_pelanggan);
		}else{
			$cekID = $this->DataTeknisi->cekID($id_pelanggan);
		}
        // $cekID = $this->DataPelanggan->cekID($id_pelanggan);
        // var_dump($cekID['totaldata']);exit;
        if($cekID['totaldata'] != 0){
            $cekUser = $this->DataUser->cekUser($username);
            if(count($cekUser) != 0){
                $result = array ( 
                    'message' => "Username Sudah Terdaftar",
                    'status' => false,
                    'case' => 'username'
                );
                echo json_encode($result);
            }else{
                $param = array(
                    'id_register' => $id_pelanggan,
                    'username' => $username,
                    'password' => $password
                );
                $hasil = $this->DataUser->simpanUser($param);
                if($hasil){
                    $result = array ( 
                        'message' => "Berhasil Register",
                        'status' => true,
                        'case' => 'register'
                    );
                    echo json_encode($result);
                }else{
                    $result = array ( 
                        'message' => "Gagal Register",
                        'status' => false,
                        'case' => 'register'
                    );
                    echo json_encode($result);
                }
            }
        }else{
            $result = array ( 
                'message' => "ID Pelanggan Salah",
                'status' => false,
                'case' => 'id'
            );
            echo json_encode($result);
        }

    }


    // public function loginprocess()
    // {
        // $id = $this->request->getVar('id');
        // $password = $this->request->getVar('password');
        // $validation = \Config\Services::validation();
        // $valid = $this->validate([
        //     'id' => [
        //         'label' => 'ID',
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} Tidak Boleh Kosong'
        //         ],
        //     ],
        //     'password' => [
        //         'label' => 'Password',
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} Tidak Boleh Kosong'
        //         ],
        //     ]
        // ]);

        // if (!$valid) {
        //     $sessError = [
        //         'errID' => $validation->getError('id'),
        //         'errPass' => $validation->getError('password')
        //     ];
        //     session()->setFlashdata($sessError);
        //     return redirect()->to('/Login/index');
        // } else {
        //     $modellogin = new DataTeknisi_m();

        //     $cekuser = $modellogin->find($id);
        //     if ($cekuser == null) {
        //         $sessError = [
        //             'errID' => 'ID tidak terdaftar'
        //         ];
        //         session()->setFlashdata($sessError);
        //         return redirect()->to('/Login/index');
        //     } else {
        //         $passwordUser = $cekuser['password'];

        //         if ($password == $passwordUser) {
        //             $idRole = $cekuser['id_role_icon'];
        //             $simpan_session = [
        //                 'id_icon' => $id,
        //                 'nama_user' => $cekuser['nama_icon'],
        //                 'role' => $idRole
        //             ];
        //             session()->set($simpan_session);
        //             if ($idRole == 1) {
                        // return redirect()->to('/Admin/dashboard');
        //             } else {
        //                 return redirect()->to('/Teknisi/dashboard');
        //             }
        //         } else {
        //             $sessError = [
        //                 'errPass' => 'Password Anda Salah'
        //             ];
        //             session()->setFlashdata($sessError);
        //             return redirect()->to('/Login/index');
        //         }
        //     }
        // }
    // }
}

<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class FilterAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->id_role_icon == '') {
            return redirect()->to('Login/index');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->id_role_icon == '1') {
            return redirect()->to('/Admin/dashboard');
        }
    }
}

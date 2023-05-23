<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckRole implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('role') == 'admin') {
            // print_r(session()->get('role')=='admin');
            // die();
            return redirect()
                ->to('/admin/dashboard');
        } else if (session()->get('role') == 'kepsek') {
            return redirect()
                ->to('/kepsek/dashboard');
        } else if (session()->get('role') == 'karyawan') {
            return redirect()
                ->to('/karyawan/dashboard');
        } else {
            return redirect()
                ->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}

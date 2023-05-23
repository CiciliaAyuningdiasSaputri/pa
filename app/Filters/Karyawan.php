<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Karyawan implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!(session()->get('role') == 'karyawan')) {
            // echo session()->get('role');
            // // echo 'tes';
            // print_r(session()->get('role'));
            // die();
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // if(session()->get('isLoggedIn')){
        //     return redirect()->to('/');
        // }
        // if (session()->get('role') == 'admin') {
        //     return redirect()
        //         ->to('admin/dashboard');
        // } else if (session()->get('role') == 'kepsek') {
        //     return redirect()
        //         ->to('kepsek/dashboard');
        // } else if (session()->get('role') == 'karyawan') {
        //     return redirect()
        //         ->to('karyawan/dashboard');
        // } 
    }
}

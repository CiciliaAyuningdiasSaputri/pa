<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('karyawan/dashboard');
    }
}

<?php

namespace App\Controllers\Kepsek;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class DashboardController extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load the model

        if (!session()->get('role') == 'kepsek') {
            return redirect()->to('/');
        }
    }
    public function index()
    {
        return view('kepsek/dashboard');
    }
}

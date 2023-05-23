<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KepalaSekolahModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class KepalaSekolahController extends BaseController
{
    protected $model;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load the model
        $this->model = new KepalaSekolahModel();

        if (!session()->get('role') == 'admin') {
            return redirect()->to('/');
        }
    }

    public function index()
    {
        $kepsek = $this->model->first();
        $nip = [
            0 => substr($kepsek['nip'], 0, 8),
            1 => substr($kepsek['nip'], 8, 6),
            2 => substr($kepsek['nip'], 14, 1),
            3 => substr($kepsek['nip'], 15, 3),
        ];
        $nip = $nip[0] . " " . $nip[1] . " " . $nip[2] . " " . $nip[3];
        $kepsek['nip'] = $nip;
        $data['kepsek'] = $kepsek;
        return view('admin/kepala_sekolah/index', $data);
    }

    public function edit()
    {
        $kepsek = $this->model->first();
        $data['kepsek'] = $kepsek;
        return view('admin/kepala_sekolah/edit', $data);
    }

    public function update()
    {
        $kepsek = $this->model->first();
        try {
            $post = $this->request->getPost();
            $data = [
                'nama' => $post['nama'],
                'nip' => str_replace(' ', '', $post['nip']),
                'jenis_kelamin' => $post['jenis_kelamin']
            ];
            $this->model->update($kepsek['id'], $data);
            return redirect()->to('admin/kepala_sekolah');
        } catch (Throwable $th) {
            return redirect()->to('admin/kepala_sekolah');
        }
    }
}

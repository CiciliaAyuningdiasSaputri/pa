<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JabatanModel;
use App\Models\KaryawanModel;
use App\Models\UserModel;
use Throwable;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class KaryawanController extends BaseController
{
    protected $model;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load the model
        $this->model = new KaryawanModel();

        if (!session()->get('role') == 'admin') {
            return redirect()->to('/');
        }
    }

    public function index()
    {
        $karyawan = $this->model->findAll();

        $data['karyawan'] = $karyawan;
        return view('admin/karyawan/index', $data);
    }

    public function getKaryawanJSON()
    {
        $columns = array(
            0 => 'id',
            1 => 'nama',
            2 => 'nip',
            3 => 'jenis_kelamin',
            4 => 'nama_jabatan',
        );
        $db      = \Config\Database::connect();
        $builder = $db->table('karyawans');
        $builder->select(['karyawans.*', 'jabatans.nama_jabatan', 'users.username']);
        $builder->join('jabatans', 'jabatans.id = karyawans.jabatan_id');
        $builder->join('users', 'users.id = karyawans.user_id');

        $totalData = $builder->countAll(false);

        $totalFiltered = $totalData;

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $orderRequest = $this->request->getVar('order');
        $searchRequest = $this->request->getVar('search');
        $order = $columns[$orderRequest[0]['column']];
        $dir = $orderRequest[0]['dir'];

        if ($searchRequest['value'] == "") {
            $builder->limit($limit, $start);
            $builder->orderBy($order, $dir);
            $query = $builder->get();
            $sql = $builder->getCompiledSelect();
            $karyawans = $query->getResult();
        } else {
            $search = $searchRequest['value'];
            $builder->like('nama', $search);
            $builder->like('username', $search);
            $builder->orLike('nip', $search);
            $builder->orLike('nama_jabatan', $search);
            $builder->limit($limit, $start);
            $builder->orderBy($order, $dir);
            $query = $builder->get();

            $totalFiltered = $builder->countAll();

            $karyawans = $query->getResult();
        }

        $data = array();
        if (!empty($karyawans)) {
            $i = 1;

            foreach ($karyawans as $u) {
                $nip = [
                    0 => substr($u->nip, 0, 8),
                    1 => substr($u->nip, 8, 6),
                    2 => substr($u->nip, 14, 1),
                    3 => substr($u->nip, 15, 3),
                ];
                $nip = $nip[0] . " " . $nip[1] . " " . $nip[2] . " " . $nip[3];
                $nestedData['no'] = '';
                $nestedData['nama'] = $u->nama;
                $nestedData['username'] = $u->username;
                $nestedData['nip'] = $nip;
                $nestedData['jenis_kelamin'] = $u->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan';
                $nestedData['jabatan'] = $u->nama_jabatan;
                $nestedData['action'] = '
                    <a href="' . site_url('admin/karyawan/edit/' . $u->id) . '" class="btn btn-icon waves-effect waves-light btn-primary m-b-5"><i class="fa fa-pencil"></i></a>
                    <a href="' . site_url('admin/karyawan/delete/' . $u->id) . '" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm(\'Yakin hapus data\')"><i class="fa fa-trash"></i></a>
                ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"              => intval($this->request->getVar('draw')),
            "recordsTotal"      => intval($totalData),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        );

        echo json_encode($json_data);
    }

    public function add()
    {
        $jabatanModel = new JabatanModel();
        $jabatan = $jabatanModel->findAll();
        $data['jabatan'] = $jabatan;

        return view('admin/karyawan/add', $data);
    }

    public function store()
    {
        $post = $this->request->getPost();

        $rules = [
            'nama' => 'required',
            'nip' => 'required|is_unique[karyawans.nip]',
            'jabatan_id' => 'required',
            'username' => 'required|is_unique[users.username]',
            'jenis_kelamin' => 'required',
        ];

        if ($this->validate($rules)) {

            $userData = [
                'username' => $post['username'],
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'role' => 'karyawan',
            ];

            try {
                $userModel = new UserModel();
                if ($userModel->insert($userData)) {
                    $userId = $userModel->getInsertID();

                    $data = [
                        'nama' => $post['nama'],
                        'nip' => str_replace(' ', '', $post['nip']),
                        'jabatan_id' => $post['jabatan_id'],
                        'jenis_kelamin' => $post['jenis_kelamin'],
                        'user_id' => $userId,
                    ];

                    $this->model->save($data);
                    return redirect()->to('admin/karyawan');
                }
            } catch (Throwable $th) {
                // print_r($th);
                // die();
                return redirect()->to('admin/karyawan/add')->with('error', $th);
            }
        } else {
            // print_r($this->validator);
            // die();
            return redirect()->to('admin/karyawan/add')->withInput()->with('validation', $this->validator);
        }
    }

    public function edit($id)
    {
        $karyawan = $this->model->asArray()->find($id);

        $db      = \Config\Database::connect();
        $builder = $db->table('karyawans');
        $builder->where('karyawans.id', $id);
        $builder->join('users', 'users.id = karyawans.user_id');
        $builder->select('karyawans.*, users.username');

        $karyawan = $builder->get()->getRowArray();

        $jabatanModel = new JabatanModel();
        $jabatan = $jabatanModel->asArray()->findAll();

        $jabatan_list = '';
        foreach ($jabatan as $j) {
            if ($j['id'] != 1) {
                if ($j['id'] == $karyawan['jabatan_id']) {
                    $jabatan_list .= "<option value='{$j['id']}' selected>{$j['nama_jabatan']}</option>";
                } else {
                    $jabatan_list .= "<option value='{$j['id']}'>{$j['nama_jabatan']}</option>";
                }
            }
        }

        $data['karyawan'] = $karyawan;
        $data['jabatan_list'] = $jabatan_list;
        return view('admin/karyawan/edit', $data);
    }

    public function update($id)
    {

        try {
            $post = $this->request->getPost();

            $data = [
                'nama' => $post['nama'],
                'jabatan_id' => $post['jabatan_id'],
                'jenis_kelamin' => $post['jenis_kelamin'],
            ];

            if ($this->model->update($id, $data)) {
                session()->setFlashdata('msg', 'Berhasil update data');
                session()->setFlashdata('color', 'green');

                return redirect()->to('admin/karyawan');
            } else {
                session()->setFlashdata('msg', 'Gagal update data');
                session()->setFlashdata('color', 'red');

                return redirect()->to('admin/karyawan/edit/' . $id)->withInput();
            }
        } catch (Throwable $th) {
            print_r($th);
            die();
            return redirect()->to('admin/karyawan/edit/' . $id)->with('error', $th);
        }
    }

    public function destroy($id)
    {
        try {
            $karyawan = $this->model->asArray()->find($id);
            $userModel = new UserModel();
            $userModel->delete($karyawan['user_id']);
            $this->model->delete($id);
            return redirect()->to('admin/karyawan');
        } catch (Throwable $th) {
            return redirect()->to('admin/karyawan')->with('error', $th);
        }
    }
}

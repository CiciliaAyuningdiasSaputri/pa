<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
use App\Models\KepalaSekolahModel;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            
            if (session()->get('role') == 'admin') {
                return redirect()->to('admin/dashboard');
            } else if (session()->get('role') == 'kepsek') {
                return redirect()->to('kepsek/dashboard');
            } else if (session()->get('role') == 'karyawan') {
                return redirect()->to('karyawan/dashboard');
            }
            
        }
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $userModel->where('username', $username)->first();
        // print_r($data);
        // die();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'isLoggedIn' => TRUE,
                ];
                if ($data['role'] == 'karyawan') {
                    $db      = \Config\Database::connect();
                    $builder = $db->table('karyawans');
                    $builder->select(['karyawans.*', 'jabatans.nama_jabatan']);
                    $builder->join('jabatans', 'jabatans.id = karyawans.jabatan_id');
                    $builder->where('user_id', $data['id']);
                    $query = $builder->get();
                    $karyawan = $query->getRowArray();

                    $ses_data['nama'] = $karyawan['nama'];
                    $ses_data['nip'] = $karyawan['nip'];
                    $ses_data['karyawan_id'] = $karyawan['id'];
                    $ses_data['nama_jabatan'] = $karyawan['nama_jabatan'];
                    $ses_data['role'] = 'karyawan';
                    $session->set($ses_data);
                    return redirect()->to('/karyawan/dashboard');
                } else if ($data['role'] == 'kepsek') {
                    $kepsekModel = new KepalaSekolahModel();
                    $kepsek = $kepsekModel->asArray()->first();

                    $ses_data['nama'] = $kepsek['nama'];
                    $ses_data['nip'] = $kepsek['nip'];
                    $ses_data['nama_jabatan'] = 'Kepala Sekolah';
                    $ses_data['role'] = 'kepsek';
                    $session->set($ses_data);
                    return redirect()->to('/kepsek/dashboard');
                }
                $ses_data['nama'] = 'Admin';
                $ses_data['nip'] = '';
                $ses_data['nama_jabatan'] = 'Admin';
                $ses_data['role'] = 'admin';
                $session->set($ses_data);
                return redirect()->to('/admin/dashboard');
            } else {
                $session->setFlashdata('msg', 'Password is incorrect');
                return redirect()->to('/');
            }
        } else {
            $session->setFlashdata('msg', 'Email does not exist');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}

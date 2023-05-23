<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GajiModel;
use App\Models\KaryawanModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class GajiController extends BaseController
{

    protected $model;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load the model
        $this->model = new GajiModel();

        if (!session()->get('role') == 'admin') {
            return redirect()->to('/');
        }
    }

    public function index()
    {
        return view('admin/gaji/index');
    }

    public function getGajiJSON()
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'nama_kec',
            3 => 'nama_des',
            4 => 'username',
        );
        $db      = \Config\Database::connect();
        $builder = $db->table('gaji');
        $builder->select(['gaji.*', 'karyawans.nama']);
        $builder->join('karyawans', 'karyawans.id = gaji.karyawan_id');

        if ($this->request->getVar('bulan')) {
            $builder->where('MONTH(tanggal_gajian)', $this->request->getVar('bulan'));
        }
        if ($this->request->getVar('tahun')) {
            $builder->where('YEAR(tanggal_gajian)', $this->request->getVar('tahun'));
        }

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
            $gajis = $query->getResult();
        } else {
            $search = $searchRequest['value'];
            $builder->like('nama', $search);
            $builder->limit($limit, $start);
            $builder->orderBy($order, $dir);
            $query = $builder->get();

            $totalFiltered = $builder->countAll();

            $gajis = $query->getResult();
        }

        $data = array();
        if (!empty($gajis)) {
            $i = 1;

            foreach ($gajis as $g) {
                $nestedData['no'] = '';
                $nestedData['nama'] = $g->nama;
                $nestedData['tanggal'] = $g->tanggal_gajian;
                $gaji = number_format($g->gaji_pokok, 2, '.', ',');
                $nestedData['gaji_pokok'] = $gaji;
                $uang_makan = number_format($g->uang_makan, 2, '.', ',');
                $nestedData['uang_makan'] = $uang_makan;
                $uang_tambahan = number_format($g->uang_tambahan, 2, '.', ',');
                $nestedData['uang_tambahan'] = $uang_tambahan;
                $potongan = number_format($g->potongan, 2, '.', ',');
                $nestedData['potongan'] = $potongan;
                $jumlah = $g->gaji_pokok + $g->uang_makan + $g->uang_tambahan - $g->potongan;
                $jumlah_gaji = number_format($jumlah, 2, '.', ',');
                $nestedData['jumlah'] = $jumlah_gaji;
                $nestedData['action'] = '
                    <a href="' . site_url('admin/gaji/edit/' . $g->id) . '" class="btn btn-icon waves-effect waves-light btn-primary m-b-5"><i class="fa fa-pencil"></i></a>
                    <a href="' . site_url('admin/gaji/delete/' . $g->id) . '" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm(\'Yakin hapus data\')"><i class="fa fa-trash"></i></a>
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

    public function input()
    {
        $karyawanModel = new KaryawanModel();
        $karyawan = $karyawanModel->findAll();
        $data['karyawan'] = $karyawan;
        return view('admin/gaji/input', $data);
    }

    public function store()
    {
        $post = $this->request->getPost();

        $rules = [
            'gaji_pokok' => 'required',
            'uang_makan' => 'required',
            'uang_tambahan' => 'required',
            'potongan' => 'required',
            'karyawan_id' => 'required',
            'tanggal_gajian' => 'required'
        ];

        if ($this->validate($rules)) {
            $gaji = str_replace(',', '', $post['gaji_pokok']);
            $uang_makan = str_replace(',', '', $post['uang_makan']);
            $uang_tambahan = str_replace(',', '', $post['uang_tambahan']);
            $potongan = str_replace(',', '', $post['potongan']);
            $data = [
                'gaji_pokok' => $gaji,
                'uang_makan' => $uang_makan,
                'uang_tambahan' => $uang_tambahan,
                'potongan' => $potongan,
                'karyawan_id' => $post['karyawan_id'],
                'tanggal_gajian' => $post['tanggal_gajian']
            ];
            try {
                $this->model->save($data);
                return redirect()->to('admin/gaji');
            } catch (Throwable $th) {
                print_r($th);
                die();
                return redirect()->to('admin/gaji/input-gaji')->with('error', $th);
            }
        } else {
            print_r($this->validator);
            die();
            return redirect()->to('admin/gaji/input-gaji')->withInput()->with('validation', $this->validator);
        }
    }

    public function edit($id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('gaji');
        $builder->where('gaji.id', $id);
        $builder->join('karyawans', 'karyawans.id = gaji.karyawan_id');
        $builder->select('gaji.*, karyawans.nama');

        $gaji = $builder->get()->getRowArray();

        $data['gaji'] = $gaji;
        return view('admin/gaji/edit', $data);
    }

    public function update()
    {
        try {
            $post = $this->request->getPost();

            $gaji = str_replace(',', '', $post['gaji_pokok']);
            $uang_makan = str_replace(',', '', $post['uang_makan']);
            $uang_tambahan = str_replace(',', '', $post['uang_tambahan']);
            $potongan = str_replace(',', '', $post['potongan']);
            $data = [
                'gaji_pokok' => $gaji,
                'uang_makan' => $uang_makan,
                'uang_tambahan' => $uang_tambahan,
                'potongan' => $potongan,
                'tanggal_gajian' => $post['tanggal_gajian'],
            ];

            if ($this->model->update($post['id'], $data)) {
                session()->setFlashdata('msg', 'Berhasil update data');
                session()->setFlashdata('color', 'green');

                return redirect()->to('admin/gaji');
            } else {
                session()->setFlashdata('msg', 'Gagal update data');
                session()->setFlashdata('color', 'red');

                return redirect()->to('admin/gaji/edit/' . $post['id'])->withInput();
            }
        } catch (Throwable $th) {
            print_r($th);
            die();
            return redirect()->to('admin/gaji/edit/' . $post['id'])->with('error', $th);
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->delete($id);
            return redirect()->to('admin/gaji');
        } catch (Throwable $th) {
            print_r($th);
            die();
            return redirect()->to('admin/gaji')->with('error', $th);
        }
    }
}

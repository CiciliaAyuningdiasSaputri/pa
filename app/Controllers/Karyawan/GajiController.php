<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Libraries\Pdfgenerator;

class GajiController extends BaseController
{
    public function index()
    {
        return view('karyawan/gaji/index');
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
        $builder->where('karyawans.id', session()->get('karyawan_id'));

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
                $gaji = number_format($g->gaji, 2, '.', ',');
                $nestedData['gaji'] = $gaji;
                $nestedData['action'] = '
                    <a href="' . site_url('karyawan/gaji/cetak-slip/' . $g->id) . '" class="btn btn-icon waves-effect waves-light btn-primary m-b-5" target="_blank"><i class="fa fa-print"></i></a>
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

    public function cetak_slip($id)
    {
        $Pdfgenerator = new Pdfgenerator();
        // title dari pdf
        $data['title_pdf'] = 'Slip Gaji';

        // filename dari pdf ketika didownload
        $file_pdf = 'slip_gaji';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = view('laporan_pdf', $data);

        // run dompdf
        $Pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}

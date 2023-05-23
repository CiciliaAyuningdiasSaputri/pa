<?php

namespace App\Controllers\Admin;

// require '../../../vendor/autoload.php';

use App\Controllers\BaseController;
use App\Libraries\Pdfgenerator;
use App\Models\GajiModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Psr\Log\LoggerInterface;

// use PhpOff

class LaporanController extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load the model

        if (!session()->get('role') == 'admin') {
            return redirect()->to('/');
        }
    }

    public function index()
    {
        return view('admin/laporan/index');
    }

    public function cetak()
    {
        helper('my_helper');

        $db      = \Config\Database::connect();
        $builder = $db->table('gaji');
        $builder->select('gaji.*, karyawans.nama');
        $builder->join('karyawans', 'karyawans.id = gaji.karyawan_id');
        $builder->orderBy('tanggal_gajian', 'DESC');

        if ($this->request->getVar('bulan')) {
            $builder->where('MONTH(tanggal_gajian)', $this->request->getVar('bulan'));
        }
        if ($this->request->getVar('tahun')) {
            $builder->where('YEAR(tanggal_gajian)', $this->request->getVar('tahun'));
        }
        $query = $builder->get();

        $data = $query->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'LAPORAN PENGGAJIAN KARYAWAN SD NEGERI SIDOREJO');
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setSize(14);
        $sheet->getStyle('A1')->getFont()->setBold(true);

        // Setting Header
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL GAJIAN');
        $sheet->setCellValue('C3', 'NAMA KARYAWAN');
        $sheet->setCellValue('D3', 'GAJI');
        $sheet->setCellValue('E3', 'UANG MAKAN');
        $sheet->setCellValue('F3', 'POTONGAN');

        $sheet->getColumnDimension('A')->setWidth(8); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(20); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(30); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom F

        $sheet->getStyle('A3:F3')->getFont()->setBold(true);
        $sheet->getStyle('A3:F3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getRowDimension(3)->setRowHeight(25);
        $sheet->getStyle('A')->getAlignment()->setHorizontal('center');

        // Set Border Styling Array
        $outlineBorder = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $allBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $rowNum = 4;
        $i = 1;

        foreach ($data as $d) {
            $sheet->setCellValue('a' . $rowNum, $i);
            $tanggal_gajian = tgl_indo($d['tanggal_gajian']);
            $sheet->setCellValue('b' . $rowNum, $tanggal_gajian);
            $sheet->setCellValue('c' . $rowNum, $d['nama']);
            $sheet->setCellValue('d' . $rowNum, $d['gaji_pokok']);
            $sheet->setCellValue('e' . $rowNum, $d['uang_makan']);
            $sheet->setCellValue('f' . $rowNum, $d['potongan']);

            $sheet->getStyle('d' . $rowNum)->getNumberFormat()->setFormatCode('#,##0.00');
            $sheet->getRowDimension($rowNum)->setRowHeight(20);
            $i++;
            $rowNum++;
        }

        $sheet->getStyle('A3:F' . ($rowNum - 1))->applyFromArray($allBorder);
        $sheet->getStyle('A3:F' . ($rowNum - 1))->getAlignment()->setVertical('center');

        // print_r($_POST);
        // die();
        $writer = new Xlsx($spreadsheet);
        $writePDF = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Dompdf');
        $filename = date('Y-m-d-His') . '-Data-User';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
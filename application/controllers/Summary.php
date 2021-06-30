<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Summary extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("summary_model");
    }

    public function index()
    {
        $data["summaries"] = $this->summary_model->getAll();
        $this->load->view("summary/list", $data);
    }

    public function export()
    {
        $summaries = $this->summary_model->getAll();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama RO')
                    ->setCellValue('C1', 'Nama Badan Usaha')
                    ->setCellValue('D1', 'Alamat')
                    ->setCellValue('E1', 'Sumber')
                    ->setCellValue('F1', 'Tenaga Kerja')
                    ->setCellValue('G1', 'Keluarga')
                    ->setCellValue('H1', 'Stratfikasi')
                    ->setCellValue('I1', 'Last Call')
                    ->setCellValue('J1', 'Respon Telepon')
                    ->setCellValue('K1', 'Hasil Telepon')
                    ->setCellValue('L1', 'Total Telepon');

        $column = 2;
        $no     = 1;
        foreach($summaries as $summary) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no)
                        ->setCellValue('B' . $column, $summary->fullname)
                        ->setCellValue('C' . $column, $summary->company_name)
                        ->setCellValue('D' . $column, $summary->address)
                        ->setCellValue('E' . $column, $summary->data_source)
                        ->setCellValue('F' . $column, $summary->employee)
                        ->setCellValue('G' . $column, $summary->employee_family)
                        ->setCellValue('H' . $column, $summary->stratifikasi)
                        ->setCellValue('I' . $column, $summary->last_call)
                        ->setCellValue('J' . $column, $summary->call_response_desc)
                        ->setCellValue('K' . $column, $summary->result_desc)
                        ->setCellValue('L' . $column, $summary->total);
            $column++;
            $no++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Rekapitulasi.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    }
}
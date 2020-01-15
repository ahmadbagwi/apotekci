<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class Aset extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('AsetModel');
    }

	function index() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal==null) {
			$tanggal = date('Y-m-d');
		}
		$tanggal = substr($tanggal, 0,7);
		$data = array('tanggal' => $tanggal,
					  'title' => "Data Aset",
					  'data_aset' => $this->AsetModel->data_aset($tanggal),
					  );
		$this->load->view('_admin/header', $data);
		$this->load->view('_laman/aset');
	}

	function cari_aset() {
		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bulan');
		$tanggal = $this->input->get('tanggal');

		$periode = $tahun.'-'.$bulan.'-'.$tanggal;
		print_r($periode);
		$data['aset'] = $this->AsetModel->cariAset($periode);

	}

	function create() {
		$data['title'] = "Buat Data Aset";
        $this->load->view('_admin/header', $data);
        $this->load->view('_laman/buat_aset');
	}
	public function create_action() {
		$tanggal = $this->input->get('tanggal');
		$jam1 = "07:30:00";
		$jam2 = $this->AsetModel->jam2($tanggal);
		$jam3 = "23:50:00";
		
		$aset = $this->AsetModel->aset();//nilai aset barang * jumlah
		$omset1 = $this->AsetModel->shift1($tanggal);
		$omset2 = $this->AsetModel->shift2($tanggal);
		$totalOmset = $omset1+$omset2;
		$nota1 = $this->AsetModel->nota1($tanggal, $jam1, $jam2);
		$nota2 = $this->AsetModel->nota2($tanggal, $jam2, $jam3);
		$totalNota = $nota1+$nota2;
		$avgNota = $totalOmset/$totalNota;
		$profit = $this->AsetModel->profit2($tanggal);
		$persenProfit = $profit/$totalOmset*100;

		$data = array('tanggal' => $tanggal,
					  'aset' => $aset,
					  'omset1' => $omset1,
					  'omset2' => $omset2,
					  'totalOmset' => $totalOmset,
					  'nota1' => $nota1,
					  'nota2' => $nota2,
					  'totalNota' => $totalNota,
					  'avgNota' => $avgNota,
					  'profit' => $profit,
					  'persenProfit' => $persenProfit
					   );
		//var_dump($data);
		//var_dump($jam2);
		$this->AsetModel->simpanData($data);
		redirect('Aset');
	}

	function excel() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal==null) {
			$tanggal = date('Y-m-d');
		}
		$tanggal = substr($tanggal, 0,7);
		$data = array('tanggal' => $tanggal,
					  'title' => "Export ke Excel Data Aset",
					  'data_aset' => $this->AsetModel->data_aset($tanggal),
					  );
		$this->load->view('_admin/header', $data);
		$this->load->view('_laman/aset-excel');
	}

	function cetak_aset() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal==null) {
			$tanggal = date('Y-m-d');
		}
		$tanggal = substr($tanggal, 0,7);
		$data = array('tanggal' => $tanggal,
					  'title' => "Data Aset",
					  'data_aset' => $this->AsetModel->data_aset($tanggal),
					  );

		$html = $this->load->view('_pdf/pdf_aset', $data, true);
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
									'format' => 'A4',
									'orientation' => 'P',
									'margin_left' => '10',
									'margin_right' => '10',
									'margin_top' => '15',
									'margin_bottom' => '0',]);
		$mpdf->SetTitle('Cetak Aset');
		$mpdf->WriteHTML($html);
		$mpdf->Output('Cetak Aset', 'I');
	}

	public function export_excel()
    {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal==null) {
			$tanggal = date('Y-m-d');
		}
		$tanggal = substr($tanggal, 0,7);
		$data = array('tanggal' => $tanggal,
					  'title' => "Export ke Excel Data Aset",
					  'data_aset' => $this->AsetModel->data_aset($tanggal),
					  );

        $this->load->helper('exportexcel');
        $namaFile = "aset.xls";
        $judul = "aset";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
		xlsWriteLabel($tablehead, $kolomhead++, "Nilai Aset");
		xlsWriteLabel($tablehead, $kolomhead++, "Shift 1");
		xlsWriteLabel($tablehead, $kolomhead++, "Shift 2");
		xlsWriteLabel($tablehead, $kolomhead++, "Omset");
		xlsWriteLabel($tablehead, $kolomhead++, "Struk 1");
		xlsWriteLabel($tablehead, $kolomhead++, "Struk 2");
		xlsWriteLabel($tablehead, $kolomhead++, "Total Struk");
		xlsWriteLabel($tablehead, $kolomhead++, "Rata-rata Struk");
		xlsWriteLabel($tablehead, $kolomhead++, "Profit");
		xlsWriteLabel($tablehead, $kolomhead++, "Persentase (%)");

		foreach ($this->AsetModel->data_aset($tanggal) as $data) {
				$kolombody = 0;

				//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
				xlsWriteNumber($tablebody, $kolombody++, $nourut);
				xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
				xlsWriteNumber($tablebody, $kolombody++, $data->aset);
				xlsWriteNumber($tablebody, $kolombody++, $data->omset1);
				xlsWriteNumber($tablebody, $kolombody++, $data->omset2);
				xlsWriteNumber($tablebody, $kolombody++, $data->totalOmset);
				xlsWriteNumber($tablebody, $kolombody++, $data->nota1);
				xlsWriteNumber($tablebody, $kolombody++, $data->nota2);
				xlsWriteNumber($tablebody, $kolombody++, $data->totalNota);
				xlsWriteNumber($tablebody, $kolombody++, $data->avgNota);
				xlsWriteNumber($tablebody, $kolombody++, $data->profit);
				xlsWriteNumber($tablebody, $kolombody++, $data->persenProfit);

				$tablebody++;
					$nourut++;
				}

				xlsEOF();
				exit();
		}
}
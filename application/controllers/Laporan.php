<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class Laporan extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('LaporanModel');
        $this->db->cache_off();
      }

	function detail() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal==null) {
			$tanggal = date('Y-m-d');
		}
		$data = array('tanggal' => $tanggal,
					  'title' => "Riwayat Transaksi",
					  'detail' => $this->LaporanModel->detail($tanggal),
					);
		$this->load->view('_admin/header', $data);
		$this->load->view('_laporan/laporan_detail');	
	}

	function harian() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal == '') {
			$tanggal = date('Y-m-d');
		}
		$data = array('tanggal' => $tanggal,
			          'harian' => $this->LaporanModel->harian($tanggal),
					  'modal' => $this->LaporanModel->harian_modal($tanggal),
					  'jual' => $this->LaporanModel->harian_jual($tanggal),
			   		  'total' => $this->LaporanModel->harian_total($tanggal),
					  'konsinyasi' => $this->LaporanModel->harian_konsinyasi($tanggal),
					  'title' => "Laporan Transaksi Harian",
					);

		$this->load->view('_admin/header', $data);
		$this->load->view('_laporan/laporan_harian');
	}

	function cetak_harian() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal == '') {
			$tanggal = date('Y-m-d');
		}
		$data = array('tanggal' => $tanggal,
			          'harian' => $this->LaporanModel->harian($tanggal),
					  'modal' => $this->LaporanModel->harian_modal($tanggal),
					  'jual' => $this->LaporanModel->harian_jual($tanggal),
			   		  'total' => $this->LaporanModel->harian_total($tanggal),
					  'konsinyasi' => $this->LaporanModel->harian_konsinyasi($tanggal),
					  'title' => "Laporan Transaksi Harian",
					 );
		$panjang = 150;
		$html = $this->load->view('_pdf/pdf_harian', $data, true);
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
									'format' => [75, $panjang],
									'orientation' => 'P',
									'margin_left' => '5',
									'margin_right' => '5',
									'margin_top' => '5',
									'margin_bottom' => '0',]);
		$mpdf->SetTitle('Cetak Laporan Harian');
		$mpdf->WriteHTML($html);
		$mpdf->Output("Laporan Harian", 'I');
	}

	function bulanan() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal == '') {
			$tanggal = date('Y-m-d');
		}
		$tanggal = substr($tanggal, 0,7);
		/*$tahun = substr($tanggal, 0,3);
		$tanggal_sebelum = ;
		$tanggal_setelah = ;
		//mencari kode terakhir kemarin sebagai kode awal hari ini, dan kode akhir hari ini
		$kode_awal = $this->db->select('kode_akhir')->where('tanggal', $tanggal_sebelum)->from('tutupKasir')->get()->row()->kode_akhir;
		$kode_akhir= $this->db->select('kode_akhir')->where('tanggal', $tanggal_setelah)->from('tutupKasir')->get()->row()->kode_akhir;
		*/

		$data = array('bulan' => $tanggal,
					  'title' => "Laporan Transaksi Bulanan",
					  //'kode_awal' => ,
				      'bulanan' => $this->LaporanModel->bulanan($tanggal),
					  //'modal' => $this->LaporanModel->bulanan_modal($tanggal),
					  //'jual' => $this->LaporanModel->bulanan_jual($tanggal),
		  			  //'profit' => $this->LaporanModel->bulanan_profit($tanggal),
		  			);
		/*$tahun = '2019-06-';
		$hari = 01;
		for ($i=0; $i <= 30 ; $i++) {
			$day = $hari+$i;
			$new = $tahun.$day;
			$data = $this->LaporanModel->bulanan($new);
			var_dump($data);
			//$this->load->view('_admin/header', $tes_bulanan);
		    //$this->load->view('_laporan/laporan_bulanan', $data);
		}
		var_dump($data
		);*/
		
		//var_dump($data['bulanan']);
		$this->load->view('_admin/header', $data);
		$this->load->view('_laporan/laporan_bulanan');
		
	}

	function cetak_bulanan() {
		$tanggal = $this->input->get('tanggal');
		if ($tanggal == '') {
			$tanggal = date('Y-m-d');
		}
		$tanggal = substr($tanggal, 0,7);

		$data = array('bulanan' => $this->LaporanModel->bulanan($tanggal),
		  			 );
		$html = $this->load->view('_pdf/pdf_bulanan', $data, true);
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
									'format' => [75,150],
									'orientation' => 'P',
									'margin_left' => '5',
									'margin_right' => '5',
									'margin_top' => '5',
									'margin_bottom' => '0',]);
		$mpdf->SetTitle('Cetak Laporan Bulanan');
		$mpdf->WriteHTML($html);
		$mpdf->Output('Cetak Laporan Bulanan', 'I');
	}









	public function labaHarian() {
		$tanggal = $this->input->get('tanggalCari');
		$jam1 = $this->input->get('jam1');
		$jam2 = $this->input->get('jam2');
		/*if ($tanggal==null) {
			$tanggal = date('Y-m-d');
		}
		$shift = $this->input->get('shift');
		if ($shift==null) {
			$shift = 1;
		}
		$shift = $this->input->get('shift');
		if ($shift == 1) { $jam1 = "07:30:00"; $jam2 = "15:00:59"; } else { $jam1 = "15:01:00"; $jam2 = "23:50:00"; }*/
		$data['tanggal'] = $tanggal;
		$data['jam1'] = $jam1;
		$data['jam2'] = $jam2;
		$data['labaHarian'] = $this->LaporanModel->labaHarian($tanggal, $jam1, $jam2);
		$data['totalModalHarian'] = $this->LaporanModel->totalModalHarian($tanggal, $jam1, $jam2);
		$data['totalJualHarian'] = $this->LaporanModel->totalJualHarian($tanggal, $jam1, $jam2);
		$data['totalLabaHarian'] = $this->LaporanModel->totalLabaHarian($tanggal, $jam1, $jam2);
		$data['konsinyasi'] = $this->LaporanModel->daftarKonsinyasi($tanggal, $jam1, $jam2);
		//$data['totalKonsinyasi'] = $this->LaporanModel->totalKonsinyasi($tanggal, $jam1, $jam2);
		$data['title'] = "Laporan Transaksi Harian";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/laporan/labaharian', $data);
		$this->load->view('admin/footer');
	}

	

	function transaksiBatal() {
		$tanggal = $this->input->get('tanggalCari');
		if ($tanggal == null) {
			$tanggal = date('Y-m-d');
		}
		$this->load->model('PembatalantransaksiModel');
		$data['title'] = "Transaksi Batal";
		$data['tanggal'] = $tanggal;	
		$data['dataPembatalan'] = $this->PembatalantransaksiModel->daftarPembatalan($tanggal);
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/laporan/transaksiBatal', $data);
		$this->load->view('admin/footer');
	}


	function labaBulanan() {
		if ($this->input->get('tanggalCari')==null) {
			$tanggal = date('Y-m');
		} else {
			$tanggal = $this->input->get('tanggalCari');
			$tanggal = substr($tanggal, 0,7);
		}

		$data['bulan'] = $tanggal;
		$data['title'] = "Laporan Transaksi Bulanan";
		$data['labaBulanan'] = $this->LaporanModel->labaBulanan($tanggal);
		$data['modalBulanan'] = $this->LaporanModel->modalBulanan($tanggal);
		$data['jualBulanan'] = $this->LaporanModel->jualBulanan($tanggal);
		$data['profitBulanan'] = $this->LaporanModel->profitBulanan($tanggal);
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/laporan/labaBulanan', $data);
		$this->load->view('admin/footer');
		
	}

	function cetakBulanan() {
		if ($this->input->get('tanggalCari')==null) {
			$tanggal = date('Y-m');
		} else {
			$tanggal = $this->input->get('tanggalCari');
			$tanggal = substr($tanggal, 0,7);
		}

		$data['bulan'] = $tanggal;
		$data['title'] = "Laporan Transaksi Bulanan";
		$data['labaBulanan'] = $this->LaporanModel->labaBulanan($tanggal);
		$data['modalBulanan'] = $this->LaporanModel->modalBulanan($tanggal);
		$data['jualBulanan'] = $this->LaporanModel->jualBulanan($tanggal);
		$data['profitBulanan'] = $this->LaporanModel->profitBulanan($tanggal);

		$panjang = 150;
		$html = $this->load->view('admin/laporan/bulananCetak', $data, true);
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
									'format' => [75, $panjang],
									'orientation' => 'P',
									'margin_left' => '5',
									'margin_right' => '5',
									'margin_top' => '5',
									'margin_bottom' => '0',]);
		$mpdf->WriteHTML($html);
		$mpdf->Output($pdfFilePath, 'I');
	}

	function konsinyasi() {
		$tanggal = $this->input->get('tanggal'); //xxx
		$tanggal = $this->input->get('tanggalCari');
		if ($tanggal == null) {
			$tanggal = date('Y-m-d');
		}
		$jam1 = $this->input->get('jam1');
		$jam2 = $this->input->get('jam2');
		//$tanggal = substr($tanggal, 0,7);
		$data['tanggal'] = $tanggal;
		$data['konsinyasi'] = $this->LaporanModel->konsinyasi($tanggal, $jam1, $jam2);
		$data['totalKonsinyasi'] = $this->LaporanModel->totalKonsinyasi($tanggal, $jam1, $jam2);
		$data['title'] = "Laporan Konsinyasi";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/laporan/konsinyasi', $data);
		$this->load->view('admin/footer');
	}

	function cetakKonsinyasi() {
		$pdfFilePath = FCPATH."/assets/files/$filename.pdf";

		if (file_exists($pdfFilePath) == FALSE) {	

			$this->load->model('PembatalantransaksiModel');
			$tanggal = $this->input->get('tanggal');
			$data['tanggal'] = $tanggal;
			$tanggal = substr($tanggal, 0,7);
			$data['tanggal'] = $tanggal;
			$data['konsinyasi'] = $this->LaporanModel->konsinyasi($tanggal);
			$data['totalKonsinyasi'] = $this->LaporanModel->totalKonsinyasi($tanggal);

			$html = $this->load->view('admin/laporan/cetakKonsinyasi', $data, true);

			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->WriteHTML($html);
			$pdf->Output($pdfFilePath, 'I');
		}
		redirect("/assets/files/$filename.pdf");
	}
}


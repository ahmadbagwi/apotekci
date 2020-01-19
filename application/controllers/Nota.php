<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class Nota extends CI_Controller {
	function __construct()
        {
           parent::__construct();
           $this->load->model('NotaModel');
           $this->load->model('PengaturanModel');
           $this->db->cache_off();
        }

	function index() {
		$kode = $this->NotaModel->kode_terakhir();
		$data = array('nama_aplikasi' => $this->PengaturanModel->nama_aplikasi(),
						   'alamat' => $this->PengaturanModel->alamat(),
						   'kontak' => $this->PengaturanModel->kontak(),
						   'trx' => $this->NotaModel->kode_terakhir(),
						   'title' => 'Nota',
						   'penjualan' => $this->NotaModel->transaksi_terakhir($kode),
						   'pembayaran' => $this->NotaModel->pembayaran_terakhir($kode));
		$this->load->view('_admin/header', $data);
		$this->load->view('_transaksi/nota');
	}

	function cetak_nota() {
		$kode = $this->input->get('kode');
		if ($kode == NULL) {
			$kode = $this->NotaModel->kode_terakhir();
		}
		$data = array('kode' => $kode,
					  'nama_aplikasi' => $this->PengaturanModel->nama_aplikasi(),
					  'alamat' => $this->PengaturanModel->alamat(),
					  'kontak' => $this->PengaturanModel->kontak(),
					  'penjualan' => $this->NotaModel->transaksi_terakhir($kode),
					  'pembayaran' => $this->NotaModel->pembayaran_terakhir($kode),
					   );

		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];

		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$panjang = 150;
		$html = $this->load->view('_pdf/pdf_nota', $data, TRUE);
		
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
				'format' => [75, $panjang],
				'default_font' => 'dot',
				//'orientation' => 'P',
				'margin_left' => '5',
				'margin_right' => '5',
				'margin_top' => '10',
				'margin_bottom' => '0',
				'dpi' => '90'
				]);
			//$mpdf->_setPageSize(array(75, $mpdf->y), 'P');
			//$mpdf->SetFont('dotmatrix');
			$mpdf->SetTitle("Cetak Nota");
			$mpdf->WriteHTML($html);
			$mpdf->Output("Cetak Nota", 'I');
	}
}
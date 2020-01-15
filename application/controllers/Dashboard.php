<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Dashboard extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->model('LaporanModel');
				$this->load->model('DashboardModel');
				$this->load->model('PengaturanModel');
				$this->load->model('AsetModel');
        }

	function index() {
		$tanggal = date('Y-m');

		$data = array('logo' => $this->PengaturanModel->logo(),
					  'nama_aplikasi' => $this->PengaturanModel->nama_aplikasi(),
					  'jumlah_produk' => $this->DashboardModel->jumlah_produk(),
					  'jumlah_transaksi' => $this->DashboardModel->jumlah_transaksi(),
					  'jumlah_jual' => $this->LaporanModel->jual_bulanan($tanggal),
					  'aset' => $this->AsetModel->aset(),
					  'title' => 'Dashboard');

		$this->load->view('_admin/header', $data);
		$this->load->view('_laman/dashboard');
	}

}
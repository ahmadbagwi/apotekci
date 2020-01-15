<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Landing extends CI_Controller {
	public function index() {
		$this->load->model('PengaturanModel');
		$data['nama_aplikasi'] = $this->PengaturanModel->nama_aplikasi();
		$data['logo'] = $this->PengaturanModel->logo();
		$this->load->view('landing', $data);
	}
}

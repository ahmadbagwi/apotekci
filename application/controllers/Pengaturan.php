<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Pengaturan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('PengaturanModel');
    }

	function index() {
		$data['namaAplikasi'] = $this->PengaturanModel->namaAplikasi();
		$data['alamat'] = $this->PengaturanModel->alamat();
		$data['phone'] = $this->PengaturanModel->kontak();
		$data['title'] = "Pengaturan Aplikasi";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/pengaturan');
		$this->load->view('admin/footer');
	}

	function simpan() {
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$phone = $this->input->post('phone');

		$data = array (
				'nama' => $nama,
				'alamat' => $alamat,
				'phone' => $phone,
		);
		
		$config['upload_path']          = './assets/images';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->PengaturanModel->simpan($data);
  		
		$this->load->library('upload', $config);
		 	
		if ( ! $this->upload->simpan('logo')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/pengaturan', $error);
			$this->load->view('admin/footer');
		} else {
			$this->upload->data();
			$this->PengaturanModel->simpan($data);
			redirect('pengaturan');
		}	 	
	}

	function do_upload(){
        $config['upload_path']="./assets/images";
        $config['allowed_types']='gif|jpg|png';
        $config['max_size'] = 100;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
        $config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("logo")){
            $data = array('upload_data' => $this->upload->data());
 
            $nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$phone = $this->input->post('phone');
            $logo= $data['upload_data']['file_name']; 
             
            $result= $this->PengaturanModel->simpan_upload($nama, $alamat, $phone, $logo);
            echo json_decode($result);
        }
 
     }


}
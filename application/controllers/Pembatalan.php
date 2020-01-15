<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Pembatalan extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->model('PembatalanModel');
				$this->load->model('PenjualanModel');
        }

    function index() {
        $tanggal = date('Y-m');
        $data = array('data_pembatalan' => $this->PembatalanModel->data_pembatalan($tanggal),
    	              'title' => "Pembatalan Transaksi",
                      'data_pembatalan' => $this->PembatalanModel->data_pembatalan($tanggal)
                     );
    	$this->load->view('_admin/header', $data);
    	$this->load->view('_laman/pembatalan');

    }

    function cari_data() {
    	
    	if (isset($_GET['term'])) {
		  	$query = $this->PembatalanModel->cari_transaksi($_GET['term']);
		   	if (count($query) > 0) {
		    foreach ($query as $row)
		     	$result[] = array(
					'kode' => $row->kode,
                    'id_produk' => $row->id_produk,
                    'nama' => $row->nama,
                    'modal' => $row->jumlah_modal,
                    'jumlah' => $row->jumlah,
                    'jual' => $row->jumlah_jual,
                    //'profit' => $row->profit,
				);
		     	$json = json_encode($result);
		   		echo $json;
		   	}
		}

    }

    function create_action() {
        $user_id = $_SESSION['user_id'];
        $kode = $this->input->post('kode');
        $id_produk = $this->input->post('id_produk');
        $modal = $this->input->post('modal');
        $penjualan = $this->input->post('penjualan');
        $profit = $this->input->post('profit');
        $jumlah = $this->input->post('jumlah');

        $data = array(
                'user_id' => $user_id,
                'kode' => $kode,
                'id_produk' => $id_produk,
                'penjualan' => $penjualan,
                'jumlah' => $jumlah,   
                );

        $this->PembatalanModel->pembatalan($data);
        $this->PembatalanModel->update_stok($id_produk, $jumlah);
        $this->PembatalanModel->update_status($kode, $id_produk);
        $this->PembatalanModel->update_modal($kode, $modal);
        $this->PembatalanModel->update_pembayaran($kode, $penjualan);
        $this->PembatalanModel->update_profit($kode, $profit);

        $this->session->set_flashdata('message', 'Pembatalan transaksi berhasil');
        redirect('Pembatalan');
    }

    /*function data_pembatalan() {
        $tanggal = $this->input->get('tanggalCari');
        if ($tanggal==null) {
            $tanggal = date('Y-m-d');
        }
        $data = array('tanggal' => $tanggal,
                       'data_pembatalan' => $this->PembatalanModel->data_pembatalan($tanggal),
                      );
    }*/
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class Penjualan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('PenjualanModel');
		$this->db->cache_on();
	}

	public function index() {
		$data = array(
			'title' => 'Transaksi Penjualan',
            'id_produk' => set_value('id_produk'),
            'modal' => set_value('modal'),
            'jual' => set_value('jual'),
            'jumlah' => set_value('jumlah'),
            'jumlah_jual' => set_value('jumlah_jual'),
            'jumlah_modal' => set_value('jumlah_modal'),
            'total_jual' => set_value('total_jual'),
            'total_modal' => set_value('total_modal'),
            'bayar' => set_value('bayar'),
            'kembali' => set_value('kembali'),
        );

		$this->load->view('_admin/header', $data);
		$this->load->view('_transaksi/penjualan');
	}

    public function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$query = $this->PenjualanModel->cari_produk($_GET['term']);
		   	if (count($query) > 0) {
		    foreach ($query as $row)
		     	$result[] = array(
					'nama' => $row->nama,
					'id_produk' => $row->id,
            		'modal' => $row->modal,
            		'jual' => $row->jual,
            		'stok' => $row->stok,
				);
		     	$json = json_encode($result);
		   		echo $json;
		   	}
		}
	}

	function create_action() {
		$this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
		//ambil kode terakhir dan tambahkan nilai 1
        $kode_akhir = $this->PenjualanModel->kode_akhir();
        if (!empty($kode_akhir)) {
        	$kode = $kode_akhir + 1;
        } else { $kode = 1; }
        

		$count = $this->input->post('count');
		$tanggal = date('Y-m-d H:i:s');
		$jenis = $this->input->post('jenis');
		$user_id = $this->input->post('user_id');
		$pelanggan = $this->input->post('pelanggan');
		$id_produk = $this->input->post('id_produk');
		$modal = $this->input->post('modal');
		$jual = $this->input->post('jual');
		$jumlah = $this->input->post('jumlah');
		$jumlah_modal = $this->input->post('jumlah_modal');
		$jumlah_jual = $this->input->post('jumlah_jual');
		$total_modal = $this->input->post('total_modal');
		$total_jual = $this->input->post('total_jual');
		$bayar = $this->input->post('bayar');
		$kembali = $this->input->post('kembali');
		$profit = $total_jual - $total_modal;
		$stok_akhir = $this->input->post('stok_akhir');
		$penjualan = array();
		$update_stok = array();
		$i = 0;

		foreach ($count as $data_penjualan) {
			array_push($penjualan, array(
				'kode' => $kode,
				'tanggal' => $tanggal,
				'jenis' => $jenis,
				'user_id' => $user_id,
				'pelanggan' => $pelanggan,
				'id_produk' => $id_produk[$i],
				'modal' => $modal[$i],
				'jual' => $jual[$i],
				'jumlah' => $jumlah[$i],
				'jumlah_modal' => $jumlah_modal[$i], 
				'jumlah_jual' => $jumlah_jual[$i] 
			));
			array_push($update_stok, array(
				'id' => $id_produk[$i],
				'stok' => $stok_akhir[$i], 
			));
			$i++;
		}

		$pembayaran = array(
						'kode' => $kode,
						'user_id' => $user_id,
						'tanggal' => $tanggal,
						'total_modal' => $total_modal,
						'total_jual' => $total_jual,
						'bayar' => $bayar,
						'kembali' => $kembali,
						'profit' => $profit
					);

		$simpan_jual = $this->PenjualanModel->simpan_jual($penjualan);
		$simpan_bayar = $this->PenjualanModel->simpan_bayar($pembayaran);

		if($simpan_jual != null && $simpan_bayar !=null){
			$this->PenjualanModel->update_stok($update_stok);
			redirect('Nota');
			}
		
		}
		// var_dump($kode_akhir);
		// var_dump($kode);
    }

    public function _rules() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required', array('required' => 'Tidak ditemukan user_id'));
        $this->form_validation->set_rules('id_produk[]', 'id_produk', 'trim|required', array('required' => 'Id Produk harus diisi'));
        $this->form_validation->set_rules('modal[]', 'modal', 'trim|required', array('required' => 'Modal harus diisi'));
        $this->form_validation->set_rules('jual[]', 'jual', 'trim|required', array('required' => 'Jual harus diisi'));
        $this->form_validation->set_rules('jumlah[]', 'jumlah', 'trim|required', array('required' => 'Jumlah harus diisi'));
        $this->form_validation->set_rules('jumlah_jual[]', 'jumlah_jual', 'trim|required', array('required' => 'Jumlah jual harus diisi'));
        $this->form_validation->set_rules('jumlah_modal[]', 'jumlah_modal', 'trim|required', array('required' => 'Jumlah modal harus diisi'));
        $this->form_validation->set_rules('total_jual', 'total_jual', 'trim|required', array('required' => 'Total jual harus diisi'));
        $this->form_validation->set_rules('total_modal', 'total_modal', 'trim|required', array('required' => 'Total modal harus diisi'));
        $this->form_validation->set_rules('bayar', 'bayar', 'trim|required', array('required' => 'Bayar ini harus diisi'));
        $this->form_validation->set_rules('kembali', 'kembali', 'trim|required', array('required' => 'Kembali harus diisi'));
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
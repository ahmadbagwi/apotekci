<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class LaporanModel extends CI_Model {

	function detail($tanggal){
		$this->db->select('kode, tanggal, users.username, stok.nama, id_produk, penjualan.jual, jumlah, jumlah_jual, status');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('penjualan');
		$this->db->join('users', 'users.id = penjualan.user_id');
		$this->db->join('stok', 'stok.id = penjualan.id_produk');
		$query = $this->db->get();
		return $row = $query->result();
	}

	function harian($tanggal){
		$this->db->select('kode, users.username, tanggal, total_modal, total_jual, profit, status');
		$this->db->where('status', 'sukses');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		$this->db->join('users', 'users.id = pembayaran.user_id');
		return $this->db->get()->result();
	}

	function harian_modal($tanggal){
		$this->db->select_sum('total_modal');
		$this->db->where('status', 'sukses');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		return $this->db->get()->row()->total_modal;
	}

	function harian_jual($tanggal){
		$this->db->select_sum('total_jual');
		$this->db->where('status', 'sukses');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		return $this->db->get()->row()->total_jual;
	}

	function harian_total($tanggal){
		$this->db->select_sum('profit');
		$this->db->where('status', 'sukses');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		return $this->db->get()->row()->profit;
	}

	function harian_konsinyasi($tanggal){
		$this->db->select('penjualan.kode, penjualan.tanggal, users.username, stok.nama, penjualan.jumlah, penjualan.modal, penjualan.jual');
		$this->db->where('penjualan.status', 'sukses');
		$this->db->where('stok.jenis', 'konsinyasi');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('penjualan');
		$this->db->join('stok', 'stok.id = penjualan.id_produk');
		$this->db->join('users', 'users.id = penjualan.user_id');
		return $this->db->get()->result();
	}
	
	//Laporan bulanan dengan like sumber data tabel pembayaran, semua transaksi pembayaran muncul dupikat tanggal
	function bulanan($tanggal) {
		$this->db->select('users.username, tanggal, total_jual, total_modal, profit');
		$this->db->order_by('tanggal', 'ASC');
		$this->db->from('pembayaran');
		$this->db->join('users', 'users.id = pembayaran.user_id');
		$this->db->like('tanggal', $tanggal, 'after');
		return $this->db->get()->result();
	}
	//Laporan bulanan dengan having semua dikelompokkan berdasarkan tanggal diambil dari tabel tutupkas (hanya sebatas penjualan/kolom total_penjualan)
	/*function bulanan($tanggal) {
		$this->db->select('tanggal');
		$this->db->select_sum('total_penjualan');
		$this->db->order_by('tanggal', 'ASC');
		$this->db->group_by('tanggal');
		$this->db->from('tutupKasir');
		$this->db->having('tanggal', $tanggal);
		return $this->db->get()->result_array();
	}*/




	function labaHarian($tanggal, $jam_mulai, $jam_tutup){
		$this->db->select('kode, users.username, total_modal, total_jual, profit, status');
		$this->db->where('status', 'sukses');
		$this->db->where('tanggal >=', $tanggal.' '.$jam_mulai);
		$this->db->where('tanggal <=', $tanggal.' '.$jam_tutup);
		//$this->db->like('tanggal', $tanggalJam, 'after');
		$this->db->from('pembayaran');
		$this->db->join('users', 'users.id = pembayaran.idUser');
		$query = $this->db->get();
		return $row = $query->result_array();
	}

	function daftarKonsinyasi($tanggal, $jam_mulai, $jam_tutup){
		$this->db->select('penjualan.kode, penjualan.tanggal, users.username, stok.nama, penjualan.jumlah, penjualan.modal');
		//$this->db->select_sum('penjualan.modal', 'hargaModal');
		$this->db->where('penjualan.status', 'sukses');
		$this->db->where('stok.jenis', 'Konsinyasi');
		$this->db->where('tanggal >=', $tanggal.' '.$jam_mulai);
		$this->db->where('tanggal <=', $tanggal.' '.$jam_tutup);
		$this->db->from('penjualan');
		$this->db->join('stok', 'stok.id = penjualan.idProduk');
		$this->db->join('users', 'users.id = penjualan.idUser');
		$query = $this->db->get();
		return $row = $query->result_array();
	}

	function totalModalHarian($tanggal, $jam_mulai, $jam_tutup){
		$this->db->select_sum('total_modal');
		$this->db->where('status', 'sukses');
		$this->db->where('tanggal >=', $tanggal.' '.$jam_mulai);
		$this->db->where('tanggal <=', $tanggal.' '.$jam_tutup);
		$this->db->from('pembayaran');
		$query = $this->db->get();
		$row = $query->row();
		return $row->total_modal;
	}

	function total_penjualan_harian($tanggal, $jam_mulai, $jam_tutup){
		$this->db->select_sum('total_jual');
		$this->db->where('status', 'sukses');
		$this->db->where('tanggal >=', $tanggal.' '.$jam_mulai);
		$this->db->where('tanggal <=', $tanggal.' '.$jam_tutup);
		$this->db->from('pembayaran');
		$query = $this->db->get();
		$row = $query->row();
		return $row->total_jual;
	}

	function totalLabaHarian($tanggal, $jam_mulai, $jam_tutup){
		$this->db->select_sum('profit');
		$this->db->where('status', 'sukses');
		$this->db->where('tanggal >=', $tanggal.' '.$jam_mulai);
		$this->db->where('tanggal <=', $tanggal.' '.$jam_tutup);
		$this->db->from('pembayaran');
		$query = $this->db->get();
		$row = $query->row();
		return $row->profit;
	}

	function laba_bulanan($tanggal){ ///xxxx
		$this->db->select('tanggal');
		$this->db->select('total_modal');
		$this->db->select('total_jual');
		$this->db->select('profit');
		$this->db->where('status', 'sukses');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		$query = $this->db->get();
		return $row = $query->result_array();
	}

	function labaBulanan($tanggal){
		$this->db->select('tanggal');
		$this->db->select('total_modal');
		$this->db->select('total_jual');
		$this->db->select('profit');
		$this->db->order_by('tanggal', 'ASC');
		$this->db->where('status', 'sukses');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		$query = $this->db->get();
		return $row = $query->result_array();
	}
	/*
	function labaBulananCoba {
		$this->db->select('tanggal, sum(total_modal), sum(total_jual), sum(profit)')->from('pembayaran');
	        ->group_start()
	                ->where('a', 'a')
	        ->group_end()
	        ->where('d', 'd')
		->get();
	}
	*/
	function modalBulanan($tanggal){
		$this->db->select_sum('total_modal');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		$query = $this->db->get();
		$row = $query->row();
		return $row->total_modal;
	}

	function jual_bulanan($tanggal){
		$this->db->select_sum('total_jual');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		$query = $this->db->get();
		$row = $query->row();
		return $row->total_jual;
	}

	function profitBulanan($tanggal){
		$this->db->select_sum('profit');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembayaran');
		$query = $this->db->get();
		$row = $query->row();
		return $row->profit;
	}

	//Data untuk tutup kas
	function data_konsinyasi($tanggal, $jam_mulai, $jam_tutup) {
		$this->db->select('penjualan.kode, penjualan.tanggal, users.username, stok.nama, penjualan.modal, penjualan.jumlah, penjualan.status, penjualan.jumlah_jual');
		//$this->db->select_sum('penjualan.modal * penjualan.jumlah', ' konsinyasiTotal', FALSE); //Belum menghasilkan nilai
		$this->db->where('penjualan.status', 'sukses');
		$this->db->where('stok.jenis', 'konsinyasi');
		$this->db->where('tanggal >=', $tanggal.' '.$jam_mulai);
		$this->db->where('tanggal <=', $tanggal.' '.$jam_tutup);
		$this->db->from('penjualan');
		$this->db->join('users', 'users.id = penjualan.user_id');
		$this->db->join('stok', 'stok.id = penjualan.id_produk');
		return $this->db->get()->result();
		//return $row = $query->result_array();
	}

	function total_konsinyasi($tanggal, $jam_mulai, $jam_tutup) {
		//$this->db->select_sum('penjualan.modal');
		$this->db->select('jumlah_jual');
		$this->db->where('penjualan.status', 'sukses');
		$this->db->where('stok.jenis', 'konsinyasi');
		$this->db->where('tanggal >=', $tanggal.' '.$jam_mulai);
		$this->db->where('tanggal <=', $tanggal.' '.$jam_tutup);
		$this->db->join('stok', 'stok.id = penjualan.id_produk');
		$this->db->from('penjualan');
		return $this->db->get()->result();
		//$row = $query->row();
		//return $row = $query->result_array();
	}

}
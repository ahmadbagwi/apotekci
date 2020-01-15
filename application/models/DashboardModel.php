<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class DashboardModel extends CI_Model {
	function jumlah_produk() {
		$query = $this->db->get('stok');
		return $query->num_rows();
	}

	function jumlah_transaksi() {
		$tanggal = date('Y-m-d');
		$this->db->like('tanggal', $tanggal, 'after');
		$query = $this->db->get('pembayaran');

		return $query->num_rows();
	}

}
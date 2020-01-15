<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class NotaModel extends CI_Model {
	function kode_terakhir() {
		$this->db->select('kode')->from('pembayaran')->order_by('id', 'DESC')->limit(1);
		$kode = $this->db->get();
		if ($kode->num_rows() > 0) {
         return $kode->row()->kode;
     	}
     	return false;
	}
	function transaksi_terakhir($kode) {
		$this->db->select('kode, tanggal, stok.nama, penjualan.jual, jumlah, penjualan.jumlah_jual');
		$this->db->where('kode', $kode);
		$this->db->join('stok', 'stok.id = penjualan.id_produk');
		$this->db->from('penjualan');
		$query = $this->db->get();
		return $row = $query->result_array();
		//return $penjualan = $this->db->get('penjualan')->result_array();
	}

	function kasir($kode) {
		$this->db->select('kode');
		$this->db->from('pembayaran');
		$query = $this->db->get();
		return $query->row->kode;
	}
	
	function pembayaran_terakhir($kode) {
		$this->db->select('tanggal, kode, total_jual, bayar, kembali');
		$this->db->where('kode', $kode);
		$this->db->from('pembayaran');
		$query = $this->db->get();
		return $row = $query->result_array();
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class PembatalanModel extends CI_Model {
	function index() {
		$query = $this->db->get('stok');
		return $query->num_rows();
	}

	function cari_transaksi($kode) {
		$this->db->select('kode, id_produk, nama, jumlah, jumlah_modal, jumlah_jual, stok.nama');
		$this->db->like('kode', $kode , 'both');
        $this->db->order_by('kode', 'ASC');
        $this->db->where('status', 'sukses');
        $this->db->limit(10);
        $this->db->from('penjualan');
        $this->db->join('stok', 'stok.id = penjualan.id_produk');
        return $this->db->get()->result();
	}

	function pembatalan($data) {
		$this->db->insert('pembatalan', $data);
	}

	function update_stok($id_produk, $jumlah) {
		$this->db->set('stok', 'stok+' . (int) $jumlah, FALSE);
		$this->db->where('id', $id_produk);
		$this->db->update('stok');
	}

	function update_status($kode, $id_produk) {
		$this->db->where('kode', $kode);
		$this->db->where('id_produk', $id_produk);
		$this->db->update('penjualan', array('status' => 'batal'));
	}

	/*function ubahStatusPembayaran($kode) {
		$this->db->where('kode', $kode);
		$this->db->update('pembayaran', array('status' => 'batal'));
	}*/

	function update_modal($kode, $modal) {
		$this->db->set('total_modal', 'total_modal-' . (int) $modal, FALSE);
		$this->db->where('kode', $kode);
		$this->db->update('pembayaran');
	}

	function update_pembayaran($kode, $penjualan) {
		$this->db->set('total_jual', 'total_jual-' . (int) $penjualan, FALSE);
		$this->db->where('kode', $kode);
		$this->db->update('pembayaran');
	}

	function update_profit($kode, $profit) {
		$this->db->set('profit', 'profit-' .(int) $profit, FALSE);
		$this->db->where('kode', $kode);
		$this->db->update('pembayaran');
	}

	function data_pembatalan($tanggal) {
		$this->db->select('pembatalan.tanggal, users.username, pembatalan.kode, stok.nama, pembatalan.jumlah, pembatalan.penjualan');
		$this->db->like('tanggal', $tanggal, 'after');
		$this->db->from('pembatalan');
		$this->db->limit(10);
		$this->db->join('users', 'users.id = pembatalan.user_id');
		$this->db->join('stok', 'stok.id = pembatalan.id_produk');
		$query = $this->db->get();
		return $row = $query->result();
	}
}

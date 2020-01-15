<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class PenjualanModel extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    function kode_akhir() {
        $this->db->select('kode');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('penjualan')->row()->kode;
    }

    public function cari_produk($nama){
        $this->db->where('stok >', '0');
        $this->db->like('nama', $nama , 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('stok')->result();
    }

    function simpan_jual($penjualan) {
        return $this->db->insert_batch('penjualan', $penjualan);
    }

    function simpan_bayar($pembayaran) {
    	return $this->db->insert('pembayaran', $pembayaran);
    }

    function update_stok($update_stok) {
        return $this->db->update_batch('stok', $update_stok, 'id');
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class AsetModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function cariAset($waktu){
        $this->db->select_sum('jumlahJual');
        $this->db->like('tanggal', $waktu , 'after');
        $this->db->from('pembayaran');
        $query = $this->db->get();
        $row = $query->row();
        return $row->jumlahJual;
        //$query = $this->db->get();
        //return $row = $query->result_array();
    }

    function cariAsetArray($waktu){
        $this->db->select_sum('profit');
        $this->db->like('tanggal', $waktu , 'after');
        $this->db->from('pembayaran');
        $query = $this->db->get();
        $row = $query->row();
        return $row->profit;
        //return $row = $query->result_array();
    }

    function aset() {
        $query = $this->db->query("SELECT SUM(jual*stok) as aset FROM stok");
        return $query->row()->aset;
    }

    function shift1($tanggal) {
        $this->db->select('total_transaksi');
        $this->db->where('tanggal', $tanggal);
        $this->db->limit(1);
        $this->db->order_by('no_slip', 'ASC');
        $this->db->from('tutupKasir');
        return $this->db->get()->row()->total_transaksi;
    }

    function shift2($tanggal) {
        $this->db->select('total_transaksi');
        $this->db->where('tanggal', $tanggal);
        $this->db->limit(1);
        $this->db->order_by('no_slip', 'DESC');
        $this->db->from('tutupKasir');
        return $this->db->get()->row()->total_transaksi;
    }
/*
    function omset1($tanggal, $jam1, $jam2){
        $this->db->select_sum('jumlahJual');
        $this->db->where('status', 'sukses');
        $this->db->where('tanggal >=', $tanggal.' '.$jam1);
        $this->db->where('tanggal <=', $tanggal.' '.$jam2);
        $this->db->from('pembayaran');
        $query = $this->db->get();
        $row = $query->row();
        return $row->jumlahJual;
    }

    function omset2($tanggal, $jam3, $jam4){
        $this->db->select_sum('jumlahJual');
        $this->db->where('status', 'sukses');
        $this->db->where('tanggal >=', $tanggal.' '.$jam3);
        $this->db->where('tanggal <=', $tanggal.' '.$jam4);
        $this->db->from('pembayaran');
        $query = $this->db->get();
        $row = $query->row();
        return $row->jumlahJual;
    }
*/
    function jam2($tanggal) {
        $this->db->select('jam_tutup');
        $this->db->where('tanggal', $tanggal);
        $this->db->limit(1);
        $this->db->order_by('jam_tutup', 'ASC');
        $this->db->from('tutupKasir');
        return $this->db->get()->row()->jam_tutup;
    }

    function nota1($tanggal, $jam1, $jam2){
        $this->db->where('status', 'sukses');
        $this->db->where('tanggal >=', $tanggal.' '.$jam1);
        $this->db->where('tanggal <=', $tanggal.' '.$jam2);
        return $this->db->count_all_results('pembayaran');;
    }

    function nota2($tanggal, $jam2, $jam3){
        $this->db->where('status', 'sukses');
        $this->db->where('tanggal >', $tanggal.' '.$jam2);
        $this->db->where('tanggal <=', $tanggal.' '.$jam3);
        return $this->db->count_all_results('pembayaran');
    }

    function profit($tanggal) {
        /*$query = $this->db->query("SELECT SUM(profit) AS untung, tanggal, status FROM pembayaran GROUP BY status HAVING status ='sukses', HAVING tanggal LIKE '2019-06-02%' ");
        return $row = $query->row()->untung;*/

        $this->db->select_sum('profit');
        //$this->db->select('tanggal');
        $this->db->select('status');
        //$this->db->group_start();
        //$this->db->having(array('tanggal =' => $tanggal), false);
        //$this->db->where('tanggal', $tanggal);
        $this->db->having('status', 'sukses');
        //$this->db->having('tanggal', $tanggal);
        //$this->db->group_end();
        $this->db->from('pembayaran');
        return $this->db->get()->row()->profit;
        //$row = $query->row();
        //return $row->profit;
    }

    function profit2($tanggal) {
        $this->db->select_sum('profit');
        $this->db->where('status', 'sukses');
        $this->db->like('tanggal', $tanggal);
        $this->db->from('pembayaran');
        $query = $this->db->get();
        $row = $query->row();
        return $row->profit;
    }

    function simpanData($data) {
        $this->db->insert('aset', $data);
    }

    function data_aset($tanggal) {
        $this->db->like('tanggal', $tanggal, 'after');
        return $this->db->get('aset')->result();
    }
}
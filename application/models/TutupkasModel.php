<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class TutupkasModel extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function simpan($data) {
    	$this->db->insert('tutupKasir', $data);
    }

    function data_kas($tanggal) {
    	$this->db->select();
    	$this->db->select('users.username');
    	$this->db->like('tanggal', $tanggal, 'after');
    	$this->db->join('users', 'users.id = tutupKasir.user_id');
    	$this->db->from('tutupKasir');
    	return $this->db->get()->result();
    }


    function tanggal($no_slip) {
        $this->db->select('tanggal');
        $this->db->where('no_slip', $no_slip);
        $this->db->from('tutupKasir');
        return $this->db->get()->row()->tanggal;   
    }
    public function cetak_kas($no_slip) {
    	$this->db->select();
    	$this->db->select('users.username');
    	$this->db->where('no_slip', $no_slip);
    	$this->db->join('users', 'users.id = tutupKasir.user_id');
    	$this->db->from('tutupKasir');
    	return $this->db->get()->row();
    }

}
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PengaturanModel extends CI_Model {
	function simpan($data) {
		$this->db->insert('pengaturan', $data);
	}

	function simpan_upload($nama,$alamat, $phone, $logo){
        $data = array(
                'nama' => $nama,
                'alamat' => $alamat,
                'phone' => $phone,
                'logo' => $logo
            );  
        $result= $this->db->insert('pengaturan',$data);
        return $result;
    }
/*
    function nama() {
    	$this->db->select('nama');
    	$this->db->from('pengaturan');
    	$this->db_order_by('desc');
    	$query = $this->db->get();
    	$row = $query->row();
    	return $row->nama;
    }

    function alamat() {
    	$this->db->select('alamat');
    	$this->db->from('pengaturan');
    	$this->db_order_by('desc');
    	$query = $this->db->get();
    	$row = $query->row();
    	return $row->alamat;
    }

        function phone() {
    	$this->db->select('phone');
    	$this->db->from('pengaturan');
    	$this->db_order_by('desc');
    	$query = $this->db->get();
    	$row = $query->row();
    	return $row->phone;
    }
*/
	function nama_aplikasi() {
		$this->db->select('nama');
		$this->db->from('pengaturan');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$row = $query->row();
		return $row->nama;
	}

	function alamat() {
		$this->db->select('alamat');
		$this->db->from('pengaturan');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$row = $query->row();
		return $row->alamat;
	}

	function kontak() {
		$this->db->select('phone');
		$this->db->from('pengaturan');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$row = $query->row();
		return $row->phone;
	}

	function logo() {
		$this->db->select('logo');
		$this->db->from('pengaturan');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$row = $query->row();
		return $row->logo;
	}

}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ReturModel extends CI_Model
{

    public $table = 'retur';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('user_id', $q);
	$this->db->or_like('id_supplier', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('id_produk', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('modal', $q);
	$this->db->from($this->table);
    return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('user_id', $q);
	$this->db->or_like('id_supplier', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('id_produk', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('modal', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function updateStok($id_produk, $jumlah) {
        $this->db->set('stok', 'stok-' . (int) $jumlah, FALSE);
        $this->db->where('id', $id_produk);
        $this->db->update('stok');
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file ReturModel.php */
/* Location: ./application/models/ReturModel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-27 12:56:55 */
/* http://harviacode.com */
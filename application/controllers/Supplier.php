<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('SupplierModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'supplier/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'supplier/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'supplier/index.html';
            $config['first_url'] = base_url() . 'supplier/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->SupplierModel->total_rows($q);
        $supplier = $this->SupplierModel->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'supplier_data' => $supplier,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'title' => "Daftar Transaksi Suplier",
           );

        $this->load->view('_admin/header', $data);
        $this->load->view('supplier/supplier_list', $data);
        
    }

    public function read($id) 
    {
        $row = $this->SupplierModel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'hp' => $row->hp,
		'jenis' => $row->jenis,
	    );
            $data['title'] = "Detail Suplier";
            $this->load->view('_admin/header', $data);           
            $this->load->view('supplier/supplier_read');
            
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('supplier/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'hp' => set_value('hp'),
	    'jenis' => set_value('jenis'),
	);
        $data['title'] = "Buat Suplier";
        $this->load->view('_admin/header', $data);
        $this->load->view('supplier/supplier_form');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
	    );

            $this->SupplierModel->insert($data);
            $this->session->set_flashdata('message', 'Sukses menimpan data');
            redirect(site_url('supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->SupplierModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('supplier/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'hp' => set_value('hp', $row->hp),
		'jenis' => set_value('jenis', $row->jenis),
        'title' => 'Ubah supplier',
	    );
            $this->load->view('_admin/header', $data);
            $this->load->view('supplier/supplier_form');
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'hp' => $this->input->post('hp',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
	    );

            $this->SupplierModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Sukses mengubah data');
            redirect(site_url('supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->SupplierModel->get_by_id($id);

        if ($row) {
            $this->SupplierModel->delete($id);
            $this->session->set_flashdata('message', 'Sukses menghapus data');
            redirect(site_url('supplier'));
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('hp', 'hp', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_autocomplete(){
        if (isset($_GET['term'])) {
            $this->load->model('SupplierModel');
            $query = $this->SupplierModel->cariSupplier($_GET['term']);
            if (count($query) > 0) {
            foreach ($query as $row)
                $result[] = array(
                    'name' => $row->nama,
                    'idSuplier' => $row->id,
                );
                $json = json_encode($result);
                echo $json;
            }
        }
    }


}

/* End of file Supplier.php */
/* Location: ./application/controllers/Supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-20 07:23:55 */
/* http://harviacode.com */
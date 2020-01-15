<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retur extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ReturModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'retur/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'retur/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'retur/';
            $config['first_url'] = base_url() . 'retur/';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->ReturModel->total_rows($q);
        $retur = $this->ReturModel->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'retur_data' => $retur,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'title' => "Data Retur",
        );
        $this->load->view('_admin/header', $data);
        $this->load->view('retur/retur_list', $data);
        
    }

    public function read($id) 
    {
        $row = $this->ReturModel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'user_id' => $row->user_id,
		'id_supplier' => $row->id_supplier,
		'nama' => $row->nama,
		'id_produk' => $row->id_produk,
		'tanggal' => $row->tanggal,
		'jumlah' => $row->jumlah,
		'modal' => $row->modal,
	    );
            $data['title'] = "Detail Retur Produk";
            $this->load->view('_admin/header', $data);
            $this->load->view('retur/retur_read');
            
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('retur'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('retur/create_action'),
	    'id' => set_value('id'),
	    'user_id' => set_value('user_id'),
	    'id_supplier' => set_value('id_supplier'),
	    'nama' => set_value('nama'),
	    'id_produk' => set_value('id_produk'),
	    'tanggal' => set_value('tanggal'),
	    'jumlah' => set_value('jumlah'),
	    'modal' => set_value('modal'),
        'title' => "Buat Retur Produk",
	);

        $this->load->view('_admin/header', $data);
        $this->load->view('retur/retur_form');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'user_id' => $this->input->post('user_id',TRUE),
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_produk' => $this->input->post('id_produk',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'modal' => $this->input->post('modal',TRUE),
	    );
            $id_produk = $this->input->post('id_produk',TRUE);
            $jumlah = $this->input->post('jumlah',TRUE);
            $this->ReturModel->insert($data);
            $this->ReturModel->updateStok($id_produk, $jumlah);
            $this->session->set_flashdata('message', 'Sukses retur produk');
            redirect(site_url('retur'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->ReturModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('retur/update_action'),
		'id' => set_value('id', $row->id),
		'user_id' => set_value('user_id', $row->user_id),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		'nama' => set_value('nama', $row->nama),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'modal' => set_value('modal', $row->modal),
        'title' => "Update Retur Produk",
	    );
  
            $this->load->view('_admin/header', $data);     
            $this->load->view('retur/retur_form');
            
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('retur'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'user_id' => $this->input->post('user_id',TRUE),
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_produk' => $this->input->post('id_produk',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'modal' => $this->input->post('modal',TRUE),
	    );

            $this->ReturModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Sukses ubah data');
            redirect(site_url('retur'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->ReturModel->get_by_id($id);

        if ($row) {
            $this->ReturModel->delete($id);
            $this->session->set_flashdata('message', 'Sukses hapus data');
            redirect(site_url('retur'));
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('retur'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
	$this->form_validation->set_rules('id_supplier', 'id_supplier', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('modal', 'modal', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "retur.xls";
        $judul = "retur";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "IdUser");
	xlsWriteLabel($tablehead, $kolomhead++, "IdSuplier");
	xlsWriteLabel($tablehead, $kolomhead++, "NamaProduk");
	xlsWriteLabel($tablehead, $kolomhead++, "IdProduk");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
	xlsWriteLabel($tablehead, $kolomhead++, "Modal");

	foreach ($this->ReturModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_supplier);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_produk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
	    xlsWriteNumber($tablebody, $kolombody++, $data->modal);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Retur.php */
/* Location: ./application/controllers/Retur.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-27 12:56:55 */
/* http://harviacode.com */
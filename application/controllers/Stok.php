<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stok_model');
        $this->load->library('form_validation');
        $this->db->cache_on();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stok/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stok/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stok/';
            $config['first_url'] = base_url() . 'stok/';
        }

        $config['per_page'] = 25
        ;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Stok_model->total_rows($q);
        $stok = $this->Stok_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stok_data' => $stok,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'title' => "Daftar Produk",
        );

        $this->load->view('_admin/header', $data);
        $this->load->view('stok/stok_list');
        
    }

    public function read($id) 
    {
        $row = $this->Stok_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'kategori' => $row->kategori,
		'deskripsi' => $row->deskripsi,
		'stok' => $row->stok,
		'modal' => $row->modal,
		'jual' => $row->jual,
		'dibuat' => $row->dibuat,
        'jenis' => $row->jenis,
        'title' => "Detail Stok",
	    );
            $this->load->view('_admin/header', $data);
            $this->load->view('stok/stok_read');
            
        } else {
            $this->session->set_flashdata('message', 'Produk tidak ditemukan');
            redirect(site_url('stok'));
        }
    }

    public function create_mass() {
        $data = array('title' => 'Tambah Produk Masal', );
        $this->load->view('_admin/header', $data);
        $this->load->view('stok/stok_form_mass');
    }

    public function create_mass_action(){
        $this->_rules_mass();

        if ($this->form_validation->run() == FALSE) {
            $this->create_mass();
        } else {
        $nama = $this->input->post('nama');
        $kategori = $this->input->post('kategori');
        $deskripsi = $this->input->post('deskripsi');
        $stok = $this->input->post('stok');
        $modal = $this->input->post('modal');
        $jual = $this->input->post('jual');
        $jenis = $this->input->post('jenis');
        $count = $this->input->post('count');

        $i = 0;
        $data = array();

        foreach ($count as $count) {
            array_push($data, array('nama' => $nama[$i],
                                    'kategori' => $kategori[$i],
                                    'deskripsi' => $deskripsi[$i],
                                    'stok' => $stok[$i],
                                    'modal' => $modal[$i],
                                    'jual' => $jual[$i],
                                    'jenis' => $jenis[$i],
                                ));
            $i++;
        }
        //var_dump($count); echo "<br>"; print_r($data); echo "<br>"; print_r($data_update);
        
        $this->Stok_model->insert_mass($data);
        $this->db->cache_delete();
        $this->session->set_flashdata('message', 'Sukses menyimpan data masal');
        redirect(site_url('stok'));

        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stok/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'kategori' => set_value('kategori'),
	    'deskripsi' => set_value('deskripsi'),
	    'stok' => set_value('stok'),
	    'modal' => set_value('modal'),
	    'jual' => set_value('jual'),
	    'dibuat' => set_value('dibuat'),
        'jenis' => set_value('jenis'),
        'title' => "Tambah Produk",
	);
        
        $this->load->view('_admin/header', $data);
        $this->load->view('stok/stok_form');
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'modal' => $this->input->post('modal',TRUE),
		'jual' => $this->input->post('jual',TRUE),
		'dibuat' => $this->input->post('dibuat',TRUE),
        'jenis' => $this->input->post('jenis', TRUE),
	    );

            $this->Stok_model->insert($data);
            $this->db->cache_delete();
            $this->session->set_flashdata('message', 'Berhasil tambah produk');
            redirect(site_url('stok'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Stok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stok/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'kategori' => set_value('kategori', $row->kategori),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
		'stok' => set_value('stok', $row->stok),
		'modal' => set_value('modal', $row->modal),
		'jual' => set_value('jual', $row->jual),
		'dibuat' => set_value('dibuat', $row->dibuat),
        'jenis' => set_value('jenis', $row->jenis),
	    );
             $data['title'] = "Tambah Stok Masuk";
            $this->load->view('_admin/header', $data);

            $this->load->view('stok/stok_form', $data);
            
        
        } else {
            $this->session->set_flashdata('message', 'Produk tidak ditemukan');
            redirect(site_url('stok'));
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
		'kategori' => $this->input->post('kategori',TRUE),
		'deskripsi' => $this->input->post('deskripsi',TRUE),
		'stok' => $this->input->post('stok',TRUE),
		'modal' => $this->input->post('modal',TRUE),
		'jual' => $this->input->post('jual',TRUE),
		'dibuat' => $this->input->post('dibuat',TRUE),
        'jenis' => $this->input->post('jenis', TRUE),
	    );

            $this->Stok_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update produk berhasil');
            redirect(site_url('stok'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Stok_model->get_by_id($id);

        if ($row) {
            $this->Stok_model->delete($id);
            $this->session->set_flashdata('message', 'Produk telah dihapus');
            redirect(site_url('stok'));
        } else {
            $this->session->set_flashdata('message', 'Produk tidak ditemukan');
            redirect(site_url('stok'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
	$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	$this->form_validation->set_rules('modal', 'modal', 'trim|required');
	$this->form_validation->set_rules('jual', 'jual', 'trim|required');
	$this->form_validation->set_rules('dibuat', 'dibuat', 'trim|required');
    //$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_mass() 
    {
    $this->form_validation->set_rules('nama[]', 'nama', 'trim|required');
    $this->form_validation->set_rules('kategori[]', 'kategori', 'trim|required');
    $this->form_validation->set_rules('deskripsi[]', 'deskripsi', 'trim|required');
    $this->form_validation->set_rules('stok[]', 'stok', 'trim|required');
    $this->form_validation->set_rules('modal[]', 'modal', 'trim|required');
    $this->form_validation->set_rules('jual[]', 'jual', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "stok.xls";
        $judul = "stok";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
	xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
	xlsWriteLabel($tablehead, $kolomhead++, "Stok");
	xlsWriteLabel($tablehead, $kolomhead++, "Modal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jual");
	xlsWriteLabel($tablehead, $kolomhead++, "Dibuat");
    xlsWriteLabel($tablehead, $kolomhead++, "Jenis");


	foreach ($this->Stok_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kategori);
	    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->stok);
	    xlsWriteNumber($tablebody, $kolombody++, $data->modal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jual);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dibuat);
        xlsWriteLabel($tablebody, $kolombody++, $data->jenis);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Stok.php */
/* Location: ./application/controllers/Stok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-10 14:08:57 */
/* http://harviacode.com */
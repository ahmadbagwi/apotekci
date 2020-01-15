<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stokmasuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('StokmasukModel');
        $this->load->library('form_validation');
    }

    function get_autocomplete(){
        if (isset($_GET['term'])) {
            $query = $this->StokmasukModel->cariProduk($_GET['term']);
            if (count($query) > 0) {
            foreach ($query as $row)
                $result[] = array(
                    'name' => $row->nama,
                    'id_produk' => $row->id,
                    'modal' => $row->modal,
                    'jual' => $row->jual,
                    'stokProduk' => $row->stok,
                );
                $json = json_encode($result);
                echo $json;
            }
        }
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'stokmasuk/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'stokmasuk/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'stokmasuk/';
            $config['first_url'] = base_url() . 'stokmasuk/';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->StokmasukModel->total_rows($q);
        $stokmasuk = $this->StokmasukModel->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'stokmasuk_data' => $stokmasuk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = "Daftar Transaksi Stok Masuk";
        $this->load->view('_admin/header', $data);
        $this->load->view('stokmasuk/stokMasuk_list', $data);
        
    }

    public function read($id) 
    {
        $row = $this->StokmasukModel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'user_id' => $row->user_id,
		'id_suplier' => $row->id_suplier,
		'nama_produk' => $row->nama_produk,
		'id_produk' => $row->id_produk,
		'tanggal' => $row->tanggal,
		'jumlah' => $row->jumlah,
		'modal' => $row->modal,
        'jual' => $row->jual,
	    );
            $data['title'] = "Detail Transaksi Stok Masuk";
            $this->load->view('_admin/header', $data);
            
            $this->load->view('stokmasuk/stokMasuk_read', $data);
            
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('stokmasuk'));
        }
    }

    public function create_mass() {
        $data = array('title' => 'Tambah Stok Masuk Masal', );
        $this->load->view('_admin/header', $data);
        $this->load->view('stokmasuk/stokMasuk_mass');
    }

    public function create_mass_action() {
        $this->_rules_mass();

        if ($this->form_validation->run() == FALSE) {
            $this->create_mass();
        } else {
        $suplier = $this->input->post('suplier');
        $id_suplier = $this->input->post('id_suplier');
        $tanggal = $this->input->post('tanggal');
        $user_id = $this->input->post('user_id');
        $nama_produk = $this->input->post('nama_produk');
        $id_produk = $this->input->post('id_produk');
        $jumlah = $this->input->post('jumlah');
        $stok_akhir = $this->input->post('stok_akhir');
        $modal = $this->input->post('modal');
        $jual = $this->input->post('jual');
        $count = $this->input->post('count');

        $i = 0;
        $data = array();
        $data_update = array();

        foreach ($count as $count) {
            array_push($data, array('user_id' => $user_id,
                                    'id_suplier' => $id_suplier,
                                    'nama_produk' => $nama_produk[$i],
                                    'id_produk' => $id_produk[$i],
                                    //'tanggal' => $tanggal,
                                    'jumlah' => $jumlah[$i],
                                    'modal' => $modal[$i],
                                    'jual' => $jual[$i],
                                ));
            array_push($data_update, array('id' => $id_produk[$i],
                                         'stok' => $stok_akhir[$i],
                                         'modal' => $modal[$i],
                                         'jual' => $jual[$i],
         ));
            $i++;
        }
        //var_dump($count); echo "<br>"; print_r($data); echo "<br>"; print_r($data_update);
        
        $this->StokmasukModel->insert_mass($data);
        $this->StokmasukModel->update_stok_mass($data_update);
        $this->session->set_flashdata('message', 'Sukses menyimpan data');
        redirect(site_url('stokmasuk'));

        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('stokmasuk/create_action'),
	    'id' => set_value('id'),
	    'user_id' => set_value('user_id'),
        'suplier' => set_value('suplier'),
	    'id_suplier' => set_value('id_suplier'),
	    'nama_produk' => set_value('nama_produk'),
	    'id_produk' => set_value('id_produk'),
	    'tanggal' => set_value('tanggal'),
	    'jumlah' => set_value('jumlah'),
	    'modal' => set_value('modal'),
        'jual' => set_value('jual'),
	);
        $data['title'] = "Buat Transaksi Stok Masuk";
        $this->load->view('_admin/header', $data);
        
        $this->load->view('stokmasuk/stokMasuk_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'user_id' => $this->input->post('user_id',TRUE),
        		'id_suplier' => $this->input->post('id_suplier',TRUE),
        		'nama_produk' => $this->input->post('nama_produk',TRUE),
        		'id_produk' => $this->input->post('id_produk',TRUE),
        		'tanggal' => $this->input->post('tanggal',TRUE),
        		'jumlah' => $this->input->post('jumlah',TRUE),
        		'modal' => $this->input->post('modal',TRUE),
                'jual' => $this->input->post('jual',TRUE),
	            );
    
            $id = $this->input->post('id_produk');
            $stok = $this->input->post('stok_akhir');
            $modal = $this->input->post('modal');
            $jual = $this->input->post('jual');
            var_dump($data);
        
            $this->StokmasukModel->insert($data);
            $this->StokmasukModel->update_stok($id, $stok, $modal, $jual);
            $this->session->set_flashdata('message', 'Sukses menyimpan data');
            redirect(site_url('stokmasuk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->StokmasukModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('stokmasuk/update_action'),
		'id' => set_value('id', $row->id),
		'user_id' => set_value('user_id', $row->user_id),
		'id_suplier' => set_value('id_suplier', $row->id_suplier),
		'nama_produk' => set_value('nama_produk', $row->nama_produk),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'modal' => set_value('modal', $row->modal),
        'jual' => set_value('modal', $row->jual),
	    );
            $data['title'] = "Update Transaksi Stok Masuk";
            $this->load->view('_admin/header', $data);
            
            $this->load->view('stokmasuk/stokMasuk_form', $data);
            
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('stokmasuk'));
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
		'id_suplier' => $this->input->post('id_suplier',TRUE),
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'id_produk' => $this->input->post('id_produk',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'modal' => $this->input->post('modal',TRUE),
        'jual' => $this->input->post('jual',TRUE),
	    );

            $this->StokmasukModel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Sukses mengubah data');
            redirect(site_url('stokmasuk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->StokmasukModel->get_by_id($id);

        if ($row) {
            $this->StokmasukModel->delete($id);
            $this->session->set_flashdata('message', 'sukses menghapus data');
            redirect(site_url('stokmasuk'));
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan');
            redirect(site_url('stokmasuk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
    $this->form_validation->set_rules('suplier', 'suplier', 'trim|required');
	$this->form_validation->set_rules('id_suplier', 'id_suplier', 'trim|required');
	$this->form_validation->set_rules('nama_produk', 'nama_produk', 'trim|required');
	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('modal', 'modal', 'trim|required');
    $this->form_validation->set_rules('jual', 'jual', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_mass() 
    {
    $this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
    $this->form_validation->set_rules('id_suplier', 'id_suplier', 'trim|required');
    $this->form_validation->set_rules('nama_produk[]', 'nama_produk', 'trim|required');
    $this->form_validation->set_rules('id_produk[]', 'id_produk', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
    $this->form_validation->set_rules('jumlah[]', 'jumlah', 'trim|required');
    $this->form_validation->set_rules('modal[]', 'modal', 'trim|required');
    $this->form_validation->set_rules('jual[]', 'jual', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "stokMasuk.xls";
        $judul = "stokMasuk";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Jual");

	foreach ($this->StokmasukModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_suplier);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nama_produk);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_produk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah);
	    xlsWriteNumber($tablebody, $kolombody++, $data->modal);
        xlsWriteNumber($tablebody, $kolombody++, $data->jual);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Stokmasuk.php */
/* Location: ./application/controllers/Stokmasuk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-20 07:23:24 */
/* http://harviacode.com */
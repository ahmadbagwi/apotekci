<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

Class TutupKas extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('TutupkasModel');
        $this->load->model('NotaModel');
        $this->load->model('LaporanModel');
        $this->db->cache_off();
      }

    //Ambil data penjualan berdasarkan jam shift yang dipilih
    function get_penjualan(){
        $tanggal = $this->input->get('tggl');
        $jam_mulai = $this->input->get('jam_mulai');
        $jam_tutup = $this->input->get('jam_tutup');

        $total_penjualan_shift = $this->LaporanModel->total_penjualan_harian($tanggal, $jam_mulai, $jam_tutup);
            if (count($total_penjualan_shift) > 0) {
                //var_dump($query);
            /*foreach ($query as $row) {
                $result[] = array(
                    'jual' => $row->jumlahJual
                );
                $json = json_encode($result);
                echo $json;
            }
            $json = json_encode($query);
               echo $json; */
               echo $total_penjualan_shift;
        } 
            
    }

    function index() {
        $data = array(
            'title' => 'Tutup Kasir',
            'tanggal_tutup_terakhir' => $this->db->select('tanggal')->from('tutupKasir')->limit(1)->order_by('no_slip', 'DESC')->get()->row()->tanggal,
            'jam_tutup_terakhir' => $this->db->select('jam_tutup')->from('tutupKasir')->limit(1)->order_by('no_slip', 'DESC')->get()->row()->jam_tutup,
            'tanggal' => set_value('tanggal'),
            'jam_mulai' => set_value('jam_mulai'),
            'jam_tutup' => set_value('jam_tutup'),
            'kas_awal' => set_value('kas_awal'),
            'total_penjualan' => set_value('total_penjualan'),
            'total_transaksi' => set_value('total_transaksi'),
            'kas_tersedia' => set_value('kas_tersedia'),
            'total_kas' => set_value('total_kas'),
        );

    	$this->load->view('_admin/header', $data);
    	$this->load->view('_laman/tutupkas');
    }

    function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {

    	$tanggal = $this->input->post('tanggal' ,true);
        $jam_mulai = $this->input->post('jam_mulai' ,true);
    	$jam_tutup = $this->input->post('jam_tutup' ,true);
    	$user_id = $_SESSION['user_id'];
    	$kode_akhir = $this->NotaModel->kode_terakhir();
    	$kas_awal = $this->input->post('kas_awal' ,true);
    	$total_penjualan = $this->input->post('total_penjualan', true);

    	$rawat_inap = $this->input->post('rawat_inap');
    	$total_transaksi = $this->input->post('total_transaksi' ,true);
    	$kas_tersedia = $this->input->post('kas_tersedia' ,true);
    	$kartu_debit = $this->input->post('kartu_debit');
    	$belum_dibayar = $this->input->post('belum_dibayar');
    	$total_kas = $this->input->post('total_kas' ,true);

    	$selisih = $this->input->post('selisih');

    	$data = array('tanggal' => $tanggal,
                      'jam_mulai' => $jam_mulai,
    				  'jam_tutup' => $jam_tutup,
    				  'user_id' => $user_id,
    				  'kode_akhir' => $kode_akhir,
    				  'kas_awal' => $kas_awal,
    				  'total_penjualan' => $total_penjualan,
    				  'rawat_inap' => $rawat_inap,
    				  'total_transaksi' => $total_transaksi,
    				  'kas_tersedia' => $kas_tersedia,
    				  'kartu_debit' => $kartu_debit,
    				  'belum_dibayar' => $belum_dibayar,
    				  'total_kas' => $total_kas,
    				  'selisih' => $selisih,
    					 );

    	$this->TutupkasModel->simpan($data);
        $this->session->set_flashdata('message', 'Data tutup kas telah disimpan');
        redirect('TutupKas/data_kas');
        }
    }

    function data_kas() {
        $tanggal = $this->input->get('tanggal');
        if ($tanggal == null) { $tanggal = date('Y-m-d'); }
        $data = array('tutup_kas' => $this->TutupkasModel->data_kas($tanggal),
                      'title' => "Data Tutup Kas",
                     );
        $this->load->view('_admin/header', $data);
        $this->load->view('_laman/data_kas', $data);
    }

    function cetak_kas() {
        $no_slip = $this->input->get('no_slip');
        $jam_mulai = $this->input->get('jam_mulai');
        $jam_tutup = $this->input->get('jam_tutup');
        $tanggal = $this->input->get('tanggal');
        $data = array('data_kas' => $this->TutupkasModel->cetak_kas($no_slip),
                      'data_konsinyasi' => $this->LaporanModel->data_konsinyasi($tanggal, $jam_mulai, $jam_tutup),
                      'total_konsinyasi' => $this->LaporanModel->total_konsinyasi($tanggal, $jam_mulai, $jam_tutup),
                      'title' => "Cetak Kas",
                      );
        $panjang = 185;
        
        $html = $this->load->view('_pdf/pdf_kas', $data, true);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
                                    'format' => [75, $panjang],
                                    'orientation' => 'P',
                                    'margin_left' => '5',
                                    'margin_right' => '5',
                                    'margin_top' => '5',
                                    'margin_bottom' => '0',]);
        $mpdf->SetTitle('Cetak Tutup Kas');
        $mpdf->WriteHTML($html);
        $mpdf->Output("cetak_kas ".$no_slip, 'I');

    }

    public function _rules() {
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required', array('required' => 'Tanggal harus diisi'));
        $this->form_validation->set_rules('jam_mulai', 'jam_mulai', 'trim|required', array('required' => 'Jam mulai harus diisi'));
        $this->form_validation->set_rules('jam_tutup', 'jam_tutup', 'trim|required', array('required' => 'Jam tutup harus diisi'));
        $this->form_validation->set_rules('kas_awal', 'kas_awal', 'trim|required', array('required' => 'Kas awal harus diisi'));
        $this->form_validation->set_rules('total_penjualan', 'total_penjualan', 'trim|required', array('required' => 'Total penjualan harus diisi'));
        $this->form_validation->set_rules('total_transaksi', 'total_transaksi', 'trim|required', array('required' => 'Total transaksi harus diisi'));
        $this->form_validation->set_rules('kas_tersedia', 'kas_tersedia', 'trim|required', array('required' => 'Kas tersedia harus diisi'));
        $this->form_validation->set_rules('total_kas', 'total_kas', 'trim|required', array('required' => 'Total kas harus diisi'));       
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
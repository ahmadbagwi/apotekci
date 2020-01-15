<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('user_model');
		$this->load->model('DashboardModel');
		$this->load->model('LaporanModel');
		$this->load->model('AsetModel');
	}
	
	
	public function index() {
		
		$this->load->view('landing');
	}

	public function data_akun() {
		$data = array('data_akun' => $this->user_model->data_akun(),
					  'title' => "Daftar Akun",
					);
		$this->load->view('_admin/header', $data);
		$this->load->view('_laman/akun');
	}
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		// create the data object
		$data = new stdClass();
		$data->title = "Pembuatan akun baru";
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required', array('required' => 'Nama lengkap wajib diisi')
			);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required', array('required' => 'Phone lengkap wajib diisi')
			);
		$this->form_validation->set_rules('address', 'Address', 'trim|required', array('required' => 'Address wajib diisi')
			);

		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('_admin/header', $data);
			$this->load->view('user/register/register', $data);
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			$full_name  = $this->input->post('full_name');
			$phone      = $this->input->post('phone');
			$address    = $this->input->post('address');
			$foto_name = date('Y-m-d').$username;

			$config['file_name'] = $foto_name;
			$config['upload_path'] = './assets/images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '512';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$this->load->library('upload', $config);
			//$this->upload->register('foto');

			if ($this->user_model->create_user($username, $email, $password, $full_name, $phone, $address)) {

				// user creation ok
				$this->load->view('_admin/header', $data);
				$this->load->view('user/register/register_success');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'Terjadi kesalahan saat pembuatan akun, silahkan coba lagi.';
				
				// send error to the view
				$this->load->view('_admin/header', $data);
				$this->load->view('user/register/register');
					
			}
			
		}
		
	}
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->model('PengaturanModel');
			$data->nama_aplikasi = $this->PengaturanModel->nama_aplikasi();
			$data->logo = $this->PengaturanModel->logo();
			$this->load->view('landing', $data);
			//$this->load->view('user/login/login');
			//$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				// user login ok
				$id = $_SESSION['user_id']; 
				$this->user_model->checkin($id);
				$this->load->model('PengaturanModel');
				$data->nama_aplikasi = $this->PengaturanModel->nama_aplikasi();
				$tanggal = date('Y-m');
				$data->jumlah_produk = $this->DashboardModel->jumlah_produk();
				$data->jumlah_transaksi = $this->DashboardModel->jumlah_transaksi();
				$data->jumlah_jual = $this->LaporanModel->jual_bulanan($tanggal);
				$data->aset = $this->AsetModel->aset();
				$data->title = "Dashboard";
				$this->load->view('_admin/header', $data);
				$this->load->view('_laman/dashboard');
				
			} else {
				
				// login failed
				$data->error = 'Wrong username or password.';
				
				// send error to the view
				$this->load->model('PengaturanModel');
				$data->nama_aplikasi = $this->PengaturanModel->nama_aplikasi();
				$data->logo = $this->PengaturanModel->logo();
				$this->load->view('landing', $data);
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->model('PengaturanModel');
			$data->nama_aplikasi = $this->PengaturanModel->nama_aplikasi();
			$data->logo = $this->PengaturanModel->logo();
			$this->load->view('landing', $data);
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
		
	}
	
}

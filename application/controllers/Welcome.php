<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private function checkRemember(){
		$username = $this->input->cookie('cg_username');
        $password = $this->input->cookie('cg_password');
        
        if(isset($username)){
        	$user = $this->auth_model->signin($username, $password);
			foreach ($user as $u) {
				$this->session->set_userdata('id', $u['id']);
				$this->session->set_userdata('name', $u['name']);
				$this->session->set_userdata('username', $u['username']);
				$this->session->set_userdata('email', $u['email']);
				$this->session->set_userdata('college', $u['college']);
				$this->session->set_userdata('branch', $u['branch']);
				$this->session->set_userdata('active', $u['active']);
			}
			redirect('home/index');
		}

	}

	public function __construct(){
			parent::__construct();
			$this->load->helper('form');
	        $this->load->helper('html_helper');
	        $this->load->helper('url_helper');
	        $this->load->library('session');
	        $this->load->model('auth_model');
	        $this->load->helper('cookie');

	        checkAuth();
	        $this->checkRemember();
	        
		}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['branches'] = $this->auth_model->getBranches();
		$data['title'] = "Campus Guru";
		$data['scripts'] = [base_url().'js/scripts.js'];
		$data['unsetFooter'] = 'Unset Footer';

		$this->load->view('layout/_header');
		$this->load->view('layout/_top_index_nav');
		$this->load->view('welcome', $data);
		$this->load->view('layout/_footer');
	}
}

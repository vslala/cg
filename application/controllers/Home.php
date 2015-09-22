<?php

class Home extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('form_helper');
        $this->load->helper('html_helper');
        $this->load->helper('url_helper');
        $this->load->library('session');
		$this->load->model('auth_model');

        auth();
        // if(! $this->auth_model->auth($this->session->userdata('username')))
        // 	redirect('welcome/index');
        
	}

	public function index(){
		$data['id'] = $this->session->userdata('id');
		$data['username'] = $this->session->userdata('username');
		$data['dp'] = $this->user_model->getDisplayPicture($this->session->userdata('id'));
		$data['title'] = 'Home';
		$data['threads'] = $this->user_model->getAllThreads();
		$data['categories'] = $this->user_model->getCategoriesWithThreadCount();
		$data['scripts'] = ['https://fb.me/react-0.13.3.min.js',
		 'https://fb.me/JSXTransformer-0.13.3.js'
		 ];

		$this->load->view('layout/_header', $data);
		$this->load->view('layout/_top_nav', $data);
		$this->load->view('home/index', $data);
		$this->load->view('layout/_footer');

	}

	

}
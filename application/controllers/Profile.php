<?php

class Profile extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
        $this->load->library('session');

        auth();
	}

	public function index($id){
		$data['id'] = $id;
		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['college']= $this->session->userdata('college');
		$data['branch'] = $this->user_model->getBranchNameById($this->session->userdata('branch'));
		$data['dp'] = $this->user_model->getDisplayPicture($id);
		$data['userProfile'] = $this->user_model->getUserProfileInfo($id); 
		$data['links'] = [base_url().'css/webicons.css'];

		$this->load->view('layout/_header', $data);
		$this->load->view('layout/_top_nav', $data);
		$this->load->view('profile/index', $data);
		$this->load->view('layout/_footer');
	}

	public function post($id){
		$data['id'] = $id;
		$data['threads'] = $this->user_model->getThreadsByUserId($id);
		$data['dp'] = $this->user_model->getDisplayPicture($id);

		$this->load->view('layout/_header', $data);
		$this->load->view('layout/_top_nav', $data);
		$this->load->view('profile/post', $data);
		$this->load->view('layout/_footer');
	}
}
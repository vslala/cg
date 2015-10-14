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
		$data['user'] = $this->user_model->getUsernameEmailCollegeBranchById($id);
		$data['branch'] = $this->user_model->getBranchNameById($data['user'][0]['branch']);
		$data['dp'] = $this->user_model->getDisplayPicture($this->session->userdata('id'));
		$data['user_dp'] = $this->user_model->getDisplayPicture($id);
		$data['userProfile'] = $this->user_model->getUserProfileInfo($id); 
		$data['links'] = [base_url().'css/webicons.css'];
		$data['notifications'] = loadNotifications($this->session->userdata('id'));

		$this->load->view('layout/_header', $data);
		$this->load->view('layout/_top_nav', $data);
		$this->load->view('profile/index', $data);
		$this->load->view('layout/_footer');
	}

	public function post($id){
		$data['title'] = "CG-Posts";
		$data['id'] = $id;
		$data['threads'] = $this->user_model->getThreadsByUserId($id);
		$data['dp'] = $this->user_model->getDisplayPicture($id);

		$this->load->view('layout/_header', $data);
		$this->load->view('layout/_top_nav', $data);
		$this->load->view('profile/post', $data);
		$this->load->view('layout/_footer');
		$data['notifications'] = loadNotifications($this->session->userdata('id'));
	}
}
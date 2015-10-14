<?php

class Thread extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(['auth_model']);
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('cookie');
	}

	public function index(){
		auth();
		$data['title'] = "CG-Thread";
		$data['id'] = $this->session->userdata('id');
		$data['categories'] = $this->user_model->getCategories();
		$data['notifications'] = loadNotifications($this->session->userdata('id'));

		$this->load->view('layout/_header', $data);
		loadAppropriateView($data);	
		$this->load->view('thread/index', $data);
		$this->load->view('layout/_footer');
	}

	public function show($threadID,$title){
		$thread = $this->user_model->getThreadByThreadID($threadID);
		$this->user_model->notificationOff($this->session->userdata('id'), $thread[0]['thread_url']);
		$data['notifications'] = loadNotifications($this->session->userdata('id'));
		$data['id'] = $this->session->userdata('id');
		$data['title'] = 'CG-'.$title;
		$data['thread'] = $this->user_model->getThread($threadID);
		$data['tags'] = $this->user_model->getTags($threadID);
		$data['thread_title'] = $title;
		
		$this->load->view('layout/_header', $data);
		loadAppropriateView($data);
		$this->load->view('thread/show', $data);
		$this->load->view('layout/_footer');
	}

	public function discussions(){
		$data['title'] = "CG-Discussions";
		$data['categories'] = $this->user_model->getCategoriesWithThreadCount();

		$this->load->view('layout/_header', $data);
		loadAppropriateView($data);
		$this->load->view('home/index', $data);
		$this->load->view('layout/_footer');
	}

	public function category($cat_id){
		$data['id'] = $this->session->userdata('id');
		$data['username'] = $this->session->userdata('username');
		$data['dp'] = $this->user_model->getDisplayPicture($this->session->userdata('id'));
		$data['category'] = $this->user_model->getCategory($cat_id);
		$data['title'] = 'CG-'.$data['category'][0]['category_name'];
		$data['tags'] = $this->user_model->getAllTags();
		$data['categories'] = $this->user_model->getCategoriesWithThreadCount();
		$data['threads'] = $this->user_model->getThreadsByCategory($cat_id);
		$data['notifications'] = loadNotifications($this->session->userdata('id'));
		
		$this->load->view('layout/_header', $data);
		loadAppropriateView($data);
		$this->load->view('thread/category', $data);
		$this->load->view('layout/_footer');
	}
}
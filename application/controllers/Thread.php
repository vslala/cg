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

		$this->load->view('layout/_header', $data);
		loadAppropriateView($data);	
		$this->load->view('thread/index', $data);
		$this->load->view('layout/_footer');
	}

	public function show($threadID,$title){
		$data['id'] = $this->session->userdata('id');
		$data['title'] = 'CG-'.$title;
		$data['thread'] = $this->user_model->getThread($threadID);
		$data['replies'] = $this->user_model->getReplies($threadID);
		$data['tags'] = $this->user_model->getTags($threadID);
		$data['scripts'] = ['https://fb.me/react-0.13.3.min.js', 'https://fb.me/JSXTransformer-0.13.3.js'];

		$this->load->view('layout/_header', $data);
		loadAppropriateView($data);
		$this->load->view('thread/show', $data);
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

		$data['scripts'] = ['https://fb.me/react-0.13.3.min.js',
		 'https://fb.me/JSXTransformer-0.13.3.js'
		 ];
		
		$this->load->view('layout/_header', $data);
		loadAppropriateView($data);
		$this->load->view('thread/category', $data);
		$this->load->view('layout/_footer');
	}
}
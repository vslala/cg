<?php

class Process extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(['auth_model']);
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('cookie');
	}

	public function signup(){	
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('college', 'College Name', 'required');
		$this->form_validation->set_rules('branch', 'Branch', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('register_error', 'Please fill the form carefully!');
			redirect(base_url());
		}
		
		
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$college = $this->input->post('college');
		$branch = $this->input->post('branch');
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$last_seen = date('Y-m-d H:i:s',now());
		$username = trim($username, ' ');
		$userID = $this->auth_model->signup($name, $email, $college, $branch, $username, $password, $last_seen);

		if($userID){
			$user = $this->auth_model->getUserById($userID);
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

        }else{
        	$message = "There was some error in registering the user!";
        	$this->session->set_flashdata('register_error', $message);            
            redirect('welcome/index/#register_section');
        }
	}

	public function signin(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('login_error', 'Invalid Credentials!');
			redirect(base_url().'#login');
		}

		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$remember = $this->input->post('remember');
		$user = $this->auth_model->signin($username, $password);

		if(isset($user)){
			foreach ($user as $u) {
			$this->session->set_userdata('id', $u['id']);
			$this->session->set_userdata('name', $u['name']);
			$this->session->set_userdata('username', $u['username']);
			$this->session->set_userdata('email', $u['email']);
			$this->session->set_userdata('college', $u['college']);
			$this->session->set_userdata('branch', $u['branch']);
			$this->session->set_userdata('active', $u['active']);
		}
		if($remember){
			$cookie_username = [
				'name'=>'cg_username',
				'value'=>$username,
				'expire'=>(30*24*3600),
				'secure'=>false
			];
			$cookie_password = [
				'name'=>'cg_password',
				'value'=>$password,
				'expire'=>(30*24*3600),
				'secure'=>false
			];
			$this->input->set_cookie($cookie_username);
			$this->input->set_cookie($cookie_password);
		}
		redirect('home/index');

		}else{
			$this->session->set_flashdata('login_error', 'Invalid Credentials!');
			redirect(base_url().'#login');
		}
	}

	public function upload(){
		$config['upload_path'] = './images/profile/dp/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '2000';
		$config['max_width']  = '1366';
		$config['max_height']  = '1366';	

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', $error);
		}
		else
		{
			$file = $this->upload->data();

			$image_name = $file['file_name'];
			$image_url = base_url().'images/profile/dp/'.$image_name;
			$image_path = $file['full_path'];
			$image_extension = $file['file_ext'];
			$username = $this->session->userdata('username');
			$user_id = $this->session->userdata('id');

			$flag = $this->user_model->display_picture($username,$image_name,$image_url,$image_path,$image_extension,$username,$user_id);
			if($flag){
				redirect('profile/index/'.$user_id);
				$this->output->set_output(true);
			}

			$data = array('upload_data' => $this->upload->data());
			redirect('profile/index/'.$user_id);
			// $this->load->view('upload_success', $data);
		}
	}

	public function updateProfile(){
		$about = $this->input->post('about');
		$website = $this->input->post('website');
		$facebook = $this->input->post('facebook');
		$twitter = $this->input->post('twitter');
		$instagram = $this->input->post('instagram');
		$github = $this->input->post('github');
		$aboutme = $this->input->post('aboutme');
		$dob = $this->input->post('dob');
		$userID = $this->session->userdata('id');

		$flag = $this->user_model->updateProfileInfo($userID, $about, $website, $facebook, $twitter, $instagram, $github, $aboutme, $dob);

		if($flag){
			if($this->input->is_ajax_request()){
			  	$this->output->set_output(true);    
			}
			redirect('profile/index/'.$userID);
		}
	}

	public function startThread(){
		$this->form_validation->set_rules('title', 'Title', 'required|min_length[10]');
		$this->form_validation->set_rules('description', 'Description', 'required|min_length[20]|max_length[10000]');
		$this->form_validation->set_rules('category', 'Category', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', 'Please fill the form carefully!');
			redirect(base_url().'thread/index');
		}

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$description = str_replace('<p>', '<br />', $description);
		$description = str_replace('</p>', '', $description);
		$category = $this->input->post('category');
		$tags = $this->input->post('tags');
		$tagsArray = explode('#', $tags);
		$image_url = $this->input->post('image_url');
		$user_id = $this->session->userdata('id');
		$user_name = $this->session->userdata('name');
		$thread_url = base_url().'thread/show/'.$user_id.'/'.url_title($title);

		$thread_url = $this->user_model->startThread($user_id, $user_name, $title, $description, $category, $thread_url, $image_url, $tagsArray, base_url());

		$this->load->library('email');

		$users = $this->user_model->getAllUserEmail();
		foreach ($users as $user){
			$this->email->from('notification@campusguru.net', $user_name);
			$this->email->to($user['email']); 
			$this->email->subject('Campus Guru - New Thread Post to Campus Guru... Be the first one to answer.');
			$data['thread_title'] = $title;
			$data['thread_url'] = $thread_url;
			$data['username'] = $user_name;
			$this->email->set_mailtype("html");
			$this->email->message($this->load->view('template/email', $data, true));	
			$this->email->send();
		}
		
		if(! empty($thread_url)){
			$this->session->set_flashdata('success_message', 'Your Thread has been published. Click here to check it out <a href="'.$thread_url.'" >'.$thread_url.'</a>');
			redirect($thread_url);
		}else{
			$this->session->set_flashdata('error_message', 'There was some error creating the thread.');
			redirect('thread/index');
		}
	}

	public function getThreads(){
		$threads = $this->user_model->getAllThreads();
		$threads = json_encode($threads);
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->output->set_output($threads);
	}

	public function getUserEmailFromThreadId($thread_id){
		$sql = "SELECT users.email from users 
			LEFT JOIN threads
			ON threads.user_id = users.id
			WHERE threads.id = 1;";
		$query = $this->db->query($sql, [$thread_id]);
		return $query->result_array();
	}

	public function reply(){
		$threadID = $this->input->post('threadID');
		$threadTitle = $this->input->post('threadTitle');
		$answer = $this->input->post('reply');
		$answer = str_replace('<p>', '<br />', $answer);
		$answer = str_replace('</p>', '', $answer);
		$user_id = $this->session->userdata('id');
		$title = $this->user_model->getUsernameById($user_id).' Replied to the post '.$threadTitle.' in Campus Guru';
		$imageArray = [
			'http://s6.postimg.org/usy4kb9a9/questiions_answer_construction.jpg',
			'http://s6.postimg.org/crjl094n5/197_question_and_answers_in_Burmese.jpg',
			'http://cdn6.fedobe.com/wp-content/themes/fedonic/cache/images/14241_image11-628x250.jpg'
		];
		$randomIndex = array_rand($imageArray, count($imageArray) - 1);
		$image_url = $imageArray[$randomIndex[0]];
		$replyID = $this->user_model->addReply($user_id, $threadID, $threadTitle, $answer, $image_url, base_url());

		//inserting notification
		$threadData = $this->user_model->getThreadByThreadID($threadID);
		$this->user_model->notification($user_id, $threadData, $threadTitle, true);

		# Sending mail to the recipient's email address
		$userEmail = getUserEmailFromThreadId($threadID);
		$this->load->library('email');

		$this->email->from('notification@campusguru.net', 'Campus Guru');
		$this->email->to($userEmail[0]['email']); 
		$this->email->cc('varun@campusguru.net'); 

		$this->email->subject('Notification from Campus Guru. Someone replied to your thread!');
		$this->email->message($userEmail[0]['email'].' replied to your thread on <a href="'.base_url(). 'thread/show/'.$threadID.'/'.$threadTitle.'">'.$threadTitle.'</a>');	

		$this->email->send();

		// echo $this->email->print_debugger();
		# end mail

		if(! empty($replyID)){
			if($this->input->is_ajax_request()){
				$this->output->set_output();
			}

			redirect('thread/show/'.$threadID.'/'.url_title($threadTitle));
		}
	}

	

	public function editThread(){
		$id = $this->input->post('threadID');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$description = str_replace('<p>', '<br />', $description);
		$description = str_replace('</p>', '', $description);
		$image_url = $this->input->post('image_url');
		$this->user_model->editThread($id, $title, $description, $image_url);
		$user_id = $this->session->userdata('id');
		redirect('profile/post/'.$user_id);
	}

	public function deleteThread($id){
		$this->user_model->deleteThread($id);
		if($this->input->is_ajax_request()){
			$this->output->set_output(true);
		}else{
			redirect('profile/post/'.$this->session->userdata('id'));
		}
	}

	public function searchThread($terms){
		$threads = $this->user_model->searchThread($terms);
		$threads = json_encode($threads);
		$this->output->set_output($threads);
	}

	public function getReplies($threadID){
		$replies = $this->user_model->getReplies($threadID);
		$replies = json_encode($replies);
		$this->output->set_output($replies);
	}

	public function getCategories(){
		$categories = json_encode($this->user_model->getCategories());
		$this->output->set_output($categories);
	}

	public function getThreadsByCategoryId($id){
		$threads = json_encode($this->user_model->getThreadsByCategoryId($id));
		$this->output->set_output($threads);
	}

	public function getTagsById($id){
		$tags = json_encode($this->user_model->getTags($id));
		$this->output->set_output($tags);
	}

	public function contact(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$telephone = $this->input->post('telephone');
		$message = $this->input->post('message');

		$this->load->library('email');

		$this->email->from('notification@campusguru.net', $name);
		$this->email->to('varunshrivastava007@gmail.com'); 

		$this->email->subject('Contact me Varun');
		$this->email->message('Name: '.$name.'<br />Email: '.$email.'<br />Telephone: '.$telephone.'<br />Message: '.$message);	

		$this->email->send();
		echo $this->email->print_debugger();
		$this->output->set_output(true);
	}

	public function logout(){
		$username = $this->session->userdata('username');
		delete_cookie('cg_username');
		delete_cookie('cg_password');
		$this->auth_model->logout($username);

		redirect(base_url());
	}
}
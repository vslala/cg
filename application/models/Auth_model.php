<?php

class Auth_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}


	//User Login and Registration
	public function signup($name, $email, $college, $branch, $username, $password, $last_seen){
		if($this->checkUser($username, $email)){
				$data = [
				'name'=>$name,
				'username'=>$username,
				'email'=>$email,
				'college'=>$college,
				'branch'=>$branch,
				'password'=>$password,
				'active'=>true,
				'last_seen'=>$last_seen,
				'status'=>true
			];

			$this->db->insert('users', $data);
			$id = $this->db->insert_id();
			$dataNext = ['user_id'=>$id];
			$this->db->insert('profiles', $dataNext);

			$wordpressUser = [
				'user_login'=>$username,
				'user_pass'=>md5($password),
				'user_nicename'=>$username,
				'user_email'=>$email,
				'user_url'=>'',
				'user_registered'=>date("Y-m-d H:i:s"),
				'user_activation_key'=>uniqid(),
				'user_status'=>false,
				'display_name'=>$name
			]; 

			$this->db->insert('cg_users', $wordpressUser);
			$user_id = $this->db->insert_id();

			$metaKeyArray = [
				'nickname', 'first_name', 'last_name', 'description', 'rich_editing','comment_shortcuts','admin_color','use_ssl',
				'show_admin_bar_front','cg_capabilities','cg_user_level'
			 ];

			$metaValueArray = [$username, '','','','true','false','fresh','0','true','a:1:{s:6:"author";b:1;}',2];
			
			for($i=0; $i<count($metaKeyArray);$i++){
				$wordpressMetaUser = [
					'user_id'=>$user_id,
					'meta_key'=>$metaKeyArray[$i],
					'meta_value'=>$metaValueArray[$i]
				];
				$this->db->insert('cg_usermeta', $wordpressMetaUser);
			}
			

			return $id;
		}else{
			return false;
		}		
	}
	public function signin($username, $password){
		$field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$status = true;
		$sql = "SELECT * FROM users WHERE ?=? AND password=? AND status=?;";
		$query = $this->db->query($sql, [$field, $username,$password,$status]);

		if(!empty($query)){
			if(count($query) == 1){
				$data = ['active'=>true];
				$this->db->where($field, $username);
				$this->db->update('users', $data);
				return $this->getUserByUsernameFieldname($username, $field);
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function logout($username){
		$data = [
		'active'=>false,
		'last_seen'=>date('Y-m-d H:i:s',now())
		];
		$this->db->where('username',$username);
		$this->db->update('users', $data);
		$this->session->sess_destroy();
	}

	public function searchProperty(){
		
	}

	private function checkUser($username, $email){
		$sql = "SELECT * FROM users WHERE username=? AND email=?;";
		$query = $this->db->query($sql, [$username,$email]);

		if(count($query) > 0)
			return true;
		else
			return false;
	}

	public function getUserByUsername($username){
		$query = $this->db->get_where('users', ['username'=>$username]);
		return $query->result_array();
	}

	public function getUserById($id){
		$query = $this->db->get_where('users', ['id'=>$id]);
		return $query->result_array();
	}

	public function getUserByUsernameFieldname($username, $field){
		$query = $this->db->get_where('users', [$field=>$username]);
		return $query->result_array();
	}

	public function getBranches(){
		$query = $this->db->get_where('branches', ['status'=>true]);
		return $query->result_array();
	}

	public function insertBranch($branch){
		$data = [
			'branch_name'=>$branch,
		];
		$this->db->trans_start();
		$this->db->insert('branches', $data);
		$branch_id = $this->db->insert_id();
		$this->db->trans_complete();

		return $branch_id;
	}

	public function auth($username){
		if(isset($username))
			return true;
		else
			return false;
	}

}
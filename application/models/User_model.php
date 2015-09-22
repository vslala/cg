<?php

class User_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getUserById($id){
		$query = $this->db->get_where('users', ['id'=>$id]);
		return $query->result_array();
	}

	public function getUsernameById($id){
		$this->db->select('username');
		$query = $this->db->get_where('users', ['id'=>$id]);
		$r = $query->result_array();
		return $r[0]['username'];
	}

	public function getBranchNameById($branch_id){
		$this->db->select('branch_name');
		$query = $this->db->get_where('branches', ['id'=>$branch_id, 'status'=>true]);
		return $query->result_array();
	}

	public function display_picture($username,$image_name,$image_url,$image_path,$image_extension,$username,$user_id){
		$query = $this->db->get_where('display_pictures', ['username'=>$username]);
		$file = $query->result_array();
		if(count($file) == 1){
			$data = [
				'image_name'=>$image_name,
				'image_url'=>$image_url,
				'image_path'=>$image_path,
				'image_extension'=>$image_extension,
				'username'=>$username,
				'user_id'=>$user_id
			];
			$this->db->where('username', $username);
			$this->db->update('display_pictures', $data);
		}else{
			$data = [
				'image_name'=>$image_name,
				'image_url'=>$image_url,
				'image_extension'=>$image_extension,
				'username'=>$username,
				'user_id'=>$user_id
			];
			return $this->db->insert('display_pictures', $data);
		}

	}

	public function getDisplayPicture($id){
		$query = $this->db->get_where('display_pictures', ['user_id'=>$id]);
		return $query->result_array();
	}

	public function updateProfileInfo($userID, $about, $website, $facebook, $twitter, $instagram, $github, $aboutme, $dob){
		$data = [
			'about'=>$about,
			'website'=>$website,
			'facebook'=>$facebook,
			'twitter'=>$twitter,
			'instagram'=>$instagram,
			'github'=>$github,
			'about_me'=>$aboutme,
			'dob'=>$dob
		];

		$this->db->where('user_id', $userID);
		return $this->db->update('profiles', $data);
	}

	public function getUserProfileInfo($id){
		$sql = "SELECT profiles.*, (SELECT COUNT(*) FROM answers WHERE answers.user_id=profiles.user_id) as total_answers,
				(SELECT COUNT(*) FROM threads WHERE threads.user_id=profiles.user_id) as threads_started,
				users.last_seen, users.active
				FROM profiles
				LEFT JOIN users
				ON users.id=profiles.user_id
				WHERE profiles.user_id=?;";
		$query = $this->db->query($sql, [$id]);
		return $query->result_array();
	}

	public function getCategories(){
		$query = $this->db->get('categories');
		return $query->result_array();
	}

	public function getCategoriesWithThreadCount(){
		$sql = "SELECT categories.*, (SELECT COUNT(*) FROM threads WHERE threads.category=categories.id) as thread_count
				FROM categories;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getCategory($cat_id){
		$query = $this->db->get_where('categories', ['id'=>$cat_id]);
		return $query->result_array();
	}

	public function startThread($user_id, $user_name, $title, $description, $category,$thread_url, $image_url, $tagsArray, $base_url){
		$data = [
			'user_id' => $user_id,
			'user_name' => $user_name,
			'title' => $title,
			'description' => $description,
			'category' => $category,
			'image_url' => $image_url
		];

		$this->db->trans_start();
			$this->db->insert('threads', $data);

			$thread_id = $this->db->insert_id();

			$threadUrl = $base_url.'thread/show/'.$thread_id.'/'.url_title($title);

			$this->db->where('id', $thread_id);

			$this->db->update('threads', ['thread_url'=>$threadUrl]);

			foreach ($tagsArray as $t){
				$this->db->insert('tags', ['tag'=>$t, 'thread_id'=>$thread_id]);
			}
		$this->db->trans_complete();
		return $threadUrl;
	}

	public function getThread($id){
		$sql = "SELECT threads.*, tags.tag, display_pictures.image_url as dp, users.username
FROM threads 
LEFT JOIN tags 
ON threads.id=tags.thread_id
LEFT JOIN display_pictures
ON display_pictures.user_id=threads.user_id
LEFT JOIN users
ON users.id = threads.user_id
WHERE threads.id = ?
GROUP BY threads.id;";

		$query = $this->db->query($sql, [$id]);
		return $query->result_array();
	}

	public function getTags($id){
		$query = $this->db->get_where('tags', ['thread_id'=>$id]);
		return $query->result_array();
	}

	public function getAllTags(){
		$query = $this->db->get('tags');
		return $query->result_array();
	}

	public function deleteThread($id){
		return $this->db->delete('threads', ['id'=>$id]);
	}

	public function addReply($user_id, $threadID, $threadTitle, $answer, $image_url, $base_url){
		$data = [
			'user_id'=>$user_id,
			'thread_id'=>$threadID,
			'title'=>$threadTitle,
			'answer'=>$answer,
			'answer_image'=>$image_url
		];
		$this->db->trans_start();
			$this->db->insert('answers', $data);

			$replyID = $this->db->insert_id();

			$this->db->where(['id'=>$replyID]);

			$answerUrl = $base_url.'thread/reply/'.$replyID.'/'.url_title($threadTitle);

			$this->db->update('answers',['answer_url'=>$answerUrl]);
		$this->db->trans_complete();
		return $replyID;
	}

	public function getAllThreads(){
		$sql = 'SELECT threads.*, users.username, users.name, display_pictures.image_url as dp, (SELECT COUNT(*) FROM answers WHERE answers.thread_id = threads.id) as total_answers
					FROM threads
					LEFT JOIN users
					ON users.id = threads.user_id
					LEFT JOIN display_pictures
					ON display_pictures.user_id = threads.user_id
					ORDER BY threads.created_at DESC;';
		$query = $this->db->query($sql);
		return $query->result_array();			
	}

	public function getThreadsByUserId($id){
		$sql = "SELECT threads.id, threads.title, threads.description, threads.thread_url, threads.created_at, (SELECT COUNT(*) FROM answers WHERE answers.thread_id=threads.id) as total_answers
			FROM threads LEFT JOIN answers
			ON answers.thread_id = threads.id
			WHERE threads.user_id = ?
			GROUP BY threads.id
			ORDER BY threads.created_at DESC;
			";

		$query = $this->db->query($sql, [$id]);
		return $query->result_array();
	}

	public function editThread($id, $title, $description){
		$data = [
			'id'=>$id,
			'title'=>$title,
			'description'=>$description
		];
		$this->db->where('id',$id);
		$this->db->update('threads', $data);
	}

	public function getReplies($threadID){
		$sql = "SELECT answers.*, users.username, users.name, display_pictures.image_url 
					FROM answers
					LEFT JOIN users
					ON answers.user_id = users.id
					LEFT JOIN display_pictures
					ON display_pictures.user_id = answers.user_id
					WHERE answers.thread_id = ?; ";
		$query = $this->db->query($sql, [$threadID]);
		return $query->result_array();
	}

	public function searchThread($terms){
		$terms = str_replace('%20', ' ', $terms);
		if(empty($terms))
			return;
		$sql = 'select threads.id as id, threads.title, threads.thread_url, tags.tag from threads
left join tags
on tags.thread_id=threads.id
where threads.title LIKE "%'.$terms.'%"
or tags.tag LIKE "%'.$terms.'%"
group by threads.id;';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getThreadsByCategoryId($category_id){
		$query = $this->db->get_where('threads', ['category'=>$category_id]);
		return $query->result_array();
	}

	public function getThreadsByCategory($cat_id){
		$sql = "SELECT threads.*, categories.category_name, users.username as uname,
		 (SELECT COUNT(*) FROM answers WHERE answers.thread_id=threads.id) as total_answers,
		  (SELECT COUNT(*) FROM threads WHERE threads.category=?) as total_threads
		   FROM threads LEFT JOIN categories ON categories.id=threads.category
		    LEFT JOIN users ON users.id=threads.user_id
		     WHERE categories.id=? 
		     ORDER BY threads.created_at DESC;";
		$query = $this->db->query($sql, [$cat_id, $cat_id]);
		return $query->result_array();
	}


}
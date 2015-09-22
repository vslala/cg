<?php

function auth(){
	$c =& get_instance();
	if(! $c->auth_model->auth($c->session->userdata('username')))
        	redirect('welcome/index');
}

function checkAuth(){
	$c =& get_instance();
	if($c->auth_model->auth($c->session->userdata('username')))
        		redirect('home/index');
}

function loadAppropriateView($data){
	$c =& get_instance();
	if($c->session->userdata('id')){
			$c->load->view('layout/_top_nav', $data);
		}else{
			$c->load->view('layout/_top_index_nav', $data);
		}
}
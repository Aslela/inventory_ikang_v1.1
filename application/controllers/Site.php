<?php

class Site extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function members_area()
	{
        $data['main_content'] = 'logged_in_area';
        $data['data'] = null;
		$this->load->view('includes/template', $data);		
	}
    
	function another_page() // just for sample
	{
		echo 'good. you\'re logged in.';
	}
	
    function master_page(){
        $data['main_content'] = 'kategori_list_view';
        $data['data'] = null;
		$this->load->view('includes/template', $data);
    }
    
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo 'You don\'t have permission to access this page. <a href="../login">Login</a>';	
			die();		
			//$this->load->view('login_form');
		}		
	}	

}

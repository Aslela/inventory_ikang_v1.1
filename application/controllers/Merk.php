<?php

class Merk extends CI_Controller {
	
    function __construct(){
        parent::__construct();
    
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
        $this->load->model('Merk_Model',"Merk_Model");
        $this->load->library('form_validation');
        $this->load->library("pagination");
        $this->is_logged_in();
    }
    
	function index($start=1)
	{
		//$this->load->model('login_model');
        
        $num_per_page = 10; 
		$start=($start-1)*$num_per_page;
		$limit= $num_per_page;
        
        $result = $this->Merk_Model->getMerkList($start, $limit);
        $count_result=$this->Merk_Model->countMerkList();

        $config['base_url'] = site_url('merk/index');
        $config['uri_segment'] = 3;
        $config['total_rows']= $count_result;
        $config['per_page'] =$num_per_page;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();
        $data['no'] = $start;
        $data['search_text'] = "";
        $data['data'] = $result;

        if ($this->input->post('ajax')){
            $this->load->view('master/merk_list_view', $data);
        }else{
            $data['main_content'] = 'master/merk_list_view';
            $this->load->view('includes/template_cms', $data);
        }
	}

    function searchMerk($search_name="null00",$start=1){
        //parse_str($_SERVER['QUERY_STRING'],$_GET);
        $num_per_page = 10;
        $start=($start-1)*$num_per_page;
        $limit= $num_per_page;

        $search_param="";

        //$this->output->enable_profiler(TRUE);
        $total_seg = $this->uri->total_segments();

        if(!empty($_POST['search-text'])){
            $search_name = $this->input->post('search-text');
            $search_param = $search_name;
        }else{
            if($search_name=="null00"){
                $search_param="";
            }else{
                $search_param = $search_name;
            }
        }

        $this->load->model('Merk_Model');
        $result = $this->Merk_Model->getMerkListBySearch($start, $limit, $search_param);
        $count_result=$this->Merk_Model->countMerkListBySearch($search_param);

        $config['base_url'] = site_url('merk/searchMerk/'.$search_name);
        $config['uri_segment'] = 4;
        $config['total_rows']= $count_result;
        $config['per_page'] =$num_per_page;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();
        $data['data'] = $result;
        $data['msg'] = null;
        $data['no'] = $start;
        $data['search_text'] = $search_param;

        if ($this->input->post('ajax')){
            $this->load->view('master/merk_list_view', $data);
        }else{
            $data['main_content'] = 'master/merk_list_view';
            $this->load->view('includes/template_cms', $data);
        }
    }
	
	function createMerk()
	{
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            'Merk_Name'=>$this->input->post('input_value'),
            "Created_By" => $this->session->userdata('username'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
		
        $this->db->trans_begin();
		$query = $this->Merk_Model->createMerk($data);			
			
		if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            echo '0';
        }
        else
        {
            $this->db->trans_commit();
           	if($query==1){
                echo $query;
      		}else{
                echo '0';
      		}	
        }	
		
	}
    
    
   	function editMerk($id)
	{
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            'Merk_Name'=>$this->input->post('input_value'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
		
        $this->db->trans_begin();
		$query = $this->Merk_Model->updateMerk($data,$id);			
			
		if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            echo '0';
        }
        else
        {
            $this->db->trans_commit();
           	if($query==1){
                echo $query;
      		}else{
                echo '0';
      		}
        }	
		
	}
    
    function deleteMerk($id)
    {   
        $this->Merk_Model->deleteMerk($id);
        redirect('merk/index');
    }
    
   	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo 'You don\'t have permission to access this page. <a href="../index.php/login">Login</a>';	
			die();		
			$this->load->view('login_form');
		}		
	}
	
}
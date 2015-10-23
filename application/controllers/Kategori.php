<?php

class Kategori extends CI_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
        $this->load->library('form_validation');
        $this->load->library("pagination");
        $this->is_logged_in();
        $this->load->model('kategori_model',"kategori_model");
        
    }
    
	function index($start=1)
	{
		//$this->load->model('login_model');
        
        $num_per_page = 10;
		$start=($start-1)*$num_per_page;
		$limit= $num_per_page;
        
        $this->load->model('Kategori_Model');
        $result = $this->Kategori_Model->getKategoriList($start, $limit);
		$count_result=$this->Kategori_Model->countKategoriList();
        
		$config['base_url'] = site_url('kategori/index');
		$config['uri_segment'] = 3; 
		$config['total_rows']= $count_result;
		$config['per_page'] =$num_per_page;
		$config['use_page_numbers'] = TRUE;        
        
        $this->pagination->initialize($config);
		$data['pages']=$this->pagination->create_links();
        $data['data'] = $result;
        $data['no'] = $start;
        $data['msg'] = null;
        $data['search_text'] = "";
        
        if ($this->input->post('ajax')){
            $this->load->view('master/kategori_list_view', $data);	
        }else{
            $data['main_content'] = 'master/kategori_list_view';
   	        $this->load->view('includes/template_cms', $data);
        } 		
	}
    
    function searchKategori($search_name="null00",$start=1){
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
        
        $this->load->model('Kategori_Model');
        $result = $this->Kategori_Model->getKategoriListBySearch($start, $limit, $search_param);
		$count_result=$this->Kategori_Model->countKategoriListBySearch($search_param);
        
		$config['base_url'] = site_url('kategori/searchKategori/'.$search_name);
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
            $this->load->view('master/kategori_list_view', $data);	
        }else{
            $data['main_content'] = 'master/kategori_list_view';
            $this->load->view('includes/template_cms', $data);
        } 
    }
    
    function getKategoriData($start=1){
 
        $this->load->model(array('Kategori_Model'));
        $data = $this->Kategori_Model->getKategoriList(null,null);
        //$this->output->set_content_type('application/json')->set_output(json_encode($data));
        
        print_r(json_encode($data));
        exit();
    }	
	
	function createKategori()
	{
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            'Kategori_Name'=>$this->input->post('input_value'),
            "Created_By" => $this->session->userdata('username'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
		
        $this->db->trans_begin();
		$query = $this->kategori_model->createKategori($data);			
			
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
    
   	function editKategori($id)
	{
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            'Kategori_Name'=>$this->input->post('input_value'),
            "Created_By" => $this->session->userdata('username'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
		
        $this->db->trans_begin();
		$query = $this->kategori_model->updateKategori($data,$id);			
			
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
    
    function deleteKategori($id_kategori)
    {   
        $this->kategori_model->deleteKategori($id_kategori);
        redirect('kategori/index');
    }
    
   	function createKategori1()
	{
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            'Kategori_Name'=>$this->input->post('kategori_name'),
            "Created_By" => $this->session->userdata('username'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
		
		$query = $this->kategori_model->createKategori($data);			
			
		if($query==1){
		  $result['msg'] = 'Kategori has been added successfuly';
		}else{
		  $result['msg'] = 'Create kategori has been failed!';
		}
		
        $result['main_content'] = 'kategori_list_view';
        $result['data'] = null;
        
		redirect('kategori/index');	
		
	}
    
   	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo 'You don\'t have permission to access this page. <a href="/login">Login</a>';	
			die();		
			$this->load->view('login_form');
		}		
	}
	
}
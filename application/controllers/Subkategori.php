<?php

class SubKategori extends CI_Controller {
	
    function __construct(){
        parent::__construct();
    
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
        $this->load->model('Subkategori_Model',"Subkategori_Model");
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
        
        $result = $this->Subkategori_Model->getSubKategoriList($start, $limit);
        $count_result=$this->Subkategori_Model->countSubKategoriList();

        $config['base_url'] = site_url('subkategori/index');
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
            $this->load->view('master/subkategori_list_view', $data);
        }else{
            $data['main_content'] = 'master/subkategori_list_view';
            $this->load->view('includes/template_cms', $data);
        }
	}

    function searchSubKategori($search_name="null00",$start=1){
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

        $result = $this->Subkategori_Model->getSubKategoriListBySearch($start, $limit, $search_param);
        $count_result=$this->Subkategori_Model->countSubKategoriListBySearch($search_param);

        $config['base_url'] = site_url('subkategori/searchSubKategori/'.$search_name);
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
            $this->load->view('master/subkategori_list_view', $data);
        }else{
            $data['main_content'] = 'master/subkategori_list_view';
            $this->load->view('includes/template_cms', $data);
        }
    }
    
    function getKategoriData($start=1){
 
        $this->load->model(array('Kategori_Model'));
        $data = $this->Kategori_Model->getKategoriList(null,null);
        //$this->output->set_content_type('application/json')->set_output(json_encode($data));
        echo json_encode($data);
    }	
	
	function createSubKategori()
	{
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            'SubKategori_Name'=>$this->input->post('input_value'),
            "Created_By" => $this->session->userdata('username'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
		
        $this->db->trans_begin();
		$query = $this->Subkategori_Model->createSubKategori($data);			
			
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
    
   	function editSubKategori($id)
	{
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            'SubKategori_Name'=>$this->input->post('input_value'),
            "Created_By" => $this->session->userdata('username'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
		
        $this->db->trans_begin();
		$query = $this->Subkategori_Model->updateSubKategori($data,$id);			
			
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
    
    function deleteSubKategori($id)
    {   
        $this->Subkategori_Model->deleteSubKategori($id);
        redirect('subkategori/index');
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
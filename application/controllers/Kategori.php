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
        /*
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
        */
        $data="";
        if ($this->input->post('ajax')){
            $this->load->view('master/kategori_list_view', $data);	
        }else{
            $data['main_content'] = 'master/kategori_list_view';
   	        $this->load->view('includes/template_cms', $data);
        } 		
	}

    function dataKategoriList(){
        $aColumns = array('Kategori_ID', 'Kategori_Name', 'Created','Created_By','Last_Modified','Last_Modified_By','action');
        $searchColumns = array('Kategori_ID','Kategori_Name');

        $start = $_POST['iDisplayStart'];
        $limit = $_POST['iDisplayLength'];
        $searchText  = $_POST['sSearch'];

        // paging
        $sLimit = "";
        if ( isset( $start ) && $limit != '-1' ){
            $sLimit = "LIMIT ". ( $_POST['iDisplayStart'] ).", ".
                ( $_POST['iDisplayLength'] );
        }
        $numbering =  ($start);
        $page = 1;

        // ordering
        if ( isset( $_POST['iSortCol_0'] ) ){
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_POST['iSortingCols'] ) ; $i++ ){
                if ( $_POST[ 'bSortable_'.intval($_POST['iSortCol_'.$i]) ] == "true" ){
                    $sOrder .= $searchColumns[ intval( $_POST['iSortCol_'.$i] ) ]."
                        ". ( $_POST['sSortDir_'.$i] ) .", ";
                }
            }

            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" ){
                $sOrder = "";
            }
        }

        // filtering
        $sWhere = "";
        if ( $_POST['sSearch'] != "" ){
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($searchColumns) ; $i++ ){
                $sWhere .= $searchColumns[$i]." LIKE '%". ( $_POST['sSearch'] )."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }

        // individual column filtering
        for ( $i=0 ; $i<count($searchColumns) ; $i++ ){
            if ( $_POST['bSearchable_'.$i] == "true" && $_POST['sSearch_'.$i] != '' ){
                if ( $sWhere == "" ){
                    $sWhere = "WHERE ";
                }
                else{
                    $sWhere .= " AND ";
                }
                $sWhere .= $searchColumns[$i]." LIKE '%". ($_POST['sSearch_'.$i])."%' ";
            }
        }

        $rResult = $this->kategori_model->getKategoriList($sWhere, $sOrder, $sLimit);
        $iFilteredTotal = 10;
        $rResultTotal = $this->kategori_model->countKategoriList($sWhere);
        $iTotal = $rResultTotal;
        $iFilteredTotal = $iTotal;

        $output = array(
            "sEcho" => intval($_POST['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        foreach ($rResult as $aRow){
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ ){
                /* General output */
                if($i < 1)
                    $row[] = $numbering+$page.'|'.$aRow[ $aColumns[$i] ];
                else
                    $row[] = $aRow[ $aColumns[$i] ];
            }
            $page++;
            $output['aaData'][] = $row;
        }

        echo json_encode( $output );
        //$this->output->enable_profiler(TRUE);

    }

    function dataKategoriListAjax(){

        $searchText = $_POST['search']['value'];
        $limit = $_POST['length'];
        $start = $_POST['start'];

        // here order processing
        if(isset($_POST['order'])){
            $orderByColumnIndex = $_POST['order']['0']['column'];
            $orderDir =  $_POST['order']['0']['dir'];
        }
        else {
            $orderByColumnIndex = 1;
            $orderDir = "ASC";
        }

        $result = $this->kategori_model->getKategoriListData($searchText,$orderByColumnIndex,$orderDir, $start,$limit);
        $resultTotalAll = $this->kategori_model->count_all();
        $resultTotalFilter  = $this->kategori_model->count_filtered($searchText);

        $data = array();
        $no = $_POST['start'];
        foreach ($result as $item) {
            $no++;
            $date_created=date_create($item['Created']);
            $date_lastModified=date_create($item['Last_Modified']);
            $row = array();
            $row[] = $no;
            $row[] = $item['Kategori_ID'];
            $row[] = $item['Kategori_Name'];
            $row[] = date_format($date_created,"d M Y")." by ".$item['Created_By'];
            $row[] = date_format($date_lastModified,"d M Y")." by ".$item['Last_Modified_By'];
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $resultTotalAll,
            "recordsFiltered" => $resultTotalFilter,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
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
    
    function deleteKategori(){
        $status = 'success';
        $msg = "Kategori has been deleted successfully !";
        $id_kategori = $this->security->xss_clean($this->input->post("delID"));
        $this->kategori_model->deleteKategori($id_kategori);

        echo json_encode(array('status' => $status, 'msg' => $msg));
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
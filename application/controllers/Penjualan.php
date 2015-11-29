<?php

class Penjualan extends CI_Controller {
	
    function __construct(){
        parent::__construct();
    
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
        $this->is_logged_in();
        $this->load->model('penjualan_model');
        $this->load->model('penjualan_detail_model');
        $this->load->model('barang_model');
        $this->load->model('kategori_model');
        $this->load->model('subkategori_model');
        $this->load->model('merk_model');
        $this->load->model('model_model');
        $this->load->model('satuan_model');
        
    }
    
	function index($start=1)
	{
		//$this->load->model('login_model');
        
        $num_per_page = 10; 
		$start=($start-1)*$num_per_page;
		$limit= $num_per_page;

        $result = $this->penjualan_model->getPenjualanList($start, $limit);
        
        $data['main_content'] = 'penjualan/penjualan_list_view';
        $data['data'] = $result;
        $data['msg'] = null;
		$this->load->view('includes/template_cms', $data);
	}
    
    function getData(){
         $result = $this->barang_model->getBarangList(null, null);
         echo json_encode($result);
    }
    
     function getBarangData($start=1){
         
        parse_str($_SERVER['QUERY_STRING'],$_GET); //converts query string into global GET array variable
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord'];      
        
        if(isset($_GET['searchTerm'])){
            $searchTerm = $_GET['searchTerm'];    
        }else{
            $searchTerm = null;
        }
          
         
        $data = $this->barang_model->getBarangData($page, $limit, $searchTerm);
        //$this->output->set_content_type('application/json')->set_output(json_encode($data));
        
        print_r(json_encode($data));
        exit();
    }
    
    function test(){
        $this->output->enable_profiler(TRUE);
        $result = $this->barang_model->getCountBarangData(null);
        echo $result;
    }
    
   	function getBarangByID($id)
	{
        $result = $this->barang_model->getBarangByID($id);
        
        $data['main_content'] = 'barang_edit_view';
        $data['data'] = $result;
        $data['msg'] = null;
        
        //Data Selection 
        $data['data_kategori'] = $this->kategori_model->getKategoriList(null, null);
        $data['data_subkategori'] = $this->subkategori_model->getSubKategoriList(null, null);
        $data['data_merk'] = $this->merk_model->getMerkList(null, null);
        $data['data_model'] = $this->model_model->getModelList(null, null);
        $data['data_satuan'] = $this->satuan_model->getSatuanList(null, null);
        
		
        $this->load->view('includes/template_cms', $data);
	}
    
    function goToAddNewPenjualan(){
 
        $data['main_content'] = 'penjualan/penjualan_add_view';
        $data['data'] = null;
        $data['msg'] = null;
        
        //Data Selection 
        $data['data_kategori'] = $this->kategori_model->getKategoriList(null, null);
        $data['data_subkategori'] = $this->subkategori_model->getSubKategoriList(null, null);
        $data['data_merk'] = $this->merk_model->getMerkList(null, null);
        $data['data_model'] = $this->model_model->getModelList(null, null);
        $data['data_satuan'] = $this->satuan_model->getSatuanList(null, null);
        
		$this->load->view('includes/template_cms', $data);
    }	
    
     function goToEditPenjualan(){
        
        $data['main_content'] = 'penjualan/penjualan_edit_view';
        $data['data'] = null;
        $data['msg'] = null;
        
        parse_str($_SERVER['QUERY_STRING'],$_GET); //converts query string into global GET array variable
        $id = $_GET['id']; // get the requested page 
        
        //Data Selection 
        $data['data_kategori'] = $this->kategori_model->getKategoriList(null, null);
        $data['data_subkategori'] = $this->subkategori_model->getSubKategoriList(null, null);
        $data['data_merk'] = $this->merk_model->getMerkList(null, null);
        $data['data_model'] = $this->model_model->getModelList(null, null);
        $data['data_satuan'] = $this->satuan_model->getSatuanList(null, null);
        $data['data_penjualan'] = $this->penjualan_model->getPenjualanDetail($id);
        
		$this->load->view('includes/template_cms', $data);
    }
	
	function createPenjualan()
	{
        $this->output->enable_profiler(TRUE);
        $datetime = date('Y-m-d H:i:s', time());
        
        $data = $this->input->post('data');
        
        $data_header=array(
            'Kode_Bon'=>$data[0]['kode'],
            'Tgl_Penjualan'=>$data[0]['tgl_penjualan'],
            'Nama_Pembeli'=>$data[0]['customer'],
            'Status'=>$data[0]['status'],
            "Created_By" => $this->session->userdata('username'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
        
        $this->db->trans_begin();
        $penjualan_id = $this->penjualan_model->createPenjualanHeader($data_header);			
        
        foreach($data[1] as $row){
            $detail_penjualan = array(
                'Penjualan_ID'=>$penjualan_id,
                'Barang_ID'=>$row['id'],
                'Harga_Jual_Normal'=>$row['capital_price'],
                'Harga_Jual'=>$row['price'],
                'Qty'=>$row['quantity'],
                "Created_By" => $this->session->userdata('username'),
    			"Last_Modified"=>$datetime,
    			"Last_Modified_By"=>$this->session->userdata('username')
            );
                
            $query = $this->penjualan_detail_model->createPenjualanDetail($detail_penjualan);
            
            $this->barang_model->kurangStockBarang($row['id'],$row['quantity']);
        }
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            echo '0';
        }
        else
        {
            $this->db->trans_commit();
           	 echo "1";
        }	
	}
    
   	function editBarang($id)
	{
        $datetime = date('Y-m-d H:i:s', time());
        
        $data=array(
            'Kode_Barang'=>$this->input->post('input_val_1'),
            'Barang_Name'=>$this->input->post('input_val_2'),
            'Kategori_ID'=>$this->input->post('input_val_3'),
            'SubKategori_ID'=>$this->input->post('input_val_4'),
            'Merk_ID'=>$this->input->post('input_val_5'),
            'Model_ID'=>$this->input->post('input_val_6'),
            'Harga_Jual'=>$this->input->post('input_val_7'),
            'Harga_Beli'=>$this->input->post('input_val_8'),
            'Satuan_ID'=>$this->input->post('input_val_9'),
            'Qty'=>$this->input->post('input_val_10'),
            'Limit'=>$this->input->post('input_val_11'),
			"Last_Modified"=>$datetime,
			"Last_Modified_By"=>$this->session->userdata('username')
        );
        
	   $query = $this->barang_model->updateBarang($data,$id);			
			
		if($query==1){
		  echo $query;
		}else{
		  echo '0';
		}
		
	}
    
    function deleteKategori($id_kategori)
    {   
        $this->kategori_model->deleteKategori($id_kategori);
        redirect('kategori/index');
    }
    
   	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{ 
            echo $this->session->userdata('username');
			echo 'You don\'t have permission to access this page. <a href="../">Login</a>';	
			die();		
			$this->load->view('login_form');
		}		
	}
	
}
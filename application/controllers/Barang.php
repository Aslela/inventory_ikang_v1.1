<?php

class Barang extends CI_Controller {
	
    function __construct(){
        parent::__construct();
    
        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
        $this->is_logged_in();
        $this->load->model('barang_model',"barang_model");
        $this->load->model('kategori_model');
        $this->load->model('subkategori_model');
        $this->load->model('merk_model');
        $this->load->model('model_model');
        $this->load->model('satuan_model');
        $this->load->model('supplier_model');
        
    }
    
	function index($start=1)
	{
		//$this->load->model('login_model');
        
        $num_per_page = 10; 
		$start=($start-1)*$num_per_page;
		$limit= $num_per_page;

        $result = $this->barang_model->getBarangList($start, $limit);
        
        $data['main_content'] = 'barang/barang_list_view';
        $data['data'] = $result;
        $data['msg'] = null;
		$this->load->view('includes/template_cms', $data);
	}
    
    function getBarangData($start=1){

        $return_arr = array();
        $row_array = array();

        $search = $this->input->post('keyword');
        $data = $this->barang_model->getBarangAutoComplete($start, 10, $search );
        //$this->output->set_content_type('application/json')->set_output(json_encode($data));

        foreach ($data as $row){
            $row_array['id'] = $row['Barang_ID'];
            $row_array['text'] = utf8_encode($row['Barang_Name']);
            array_push($return_arr,$row_array);
        }

        $res['results'] = $return_arr;
        echo json_encode($data);

        //$this->output->enable_profiler(TRUE);
        //exit();
    }
    
   	function getBarangByID($id)
	{
        $result = $this->barang_model->getBarangByID($id);
        
        $data['main_content'] = 'barang/barang_edit_view';
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

    function getBarangPenjualan(){
        $status = "";
        $msg="";
        $namaBarang="";
        $harga="";
        $barangID="";

        $kode = $this->input->post("value");
        $result = $this->barang_model->getBarangByKode($kode);

        if(count($result)== 0){
            $status = "error";
            $msg="Barang dengan kode ini tidak terdaftar.";
        }else{
            $status = "success";
            $msg="";
            $namaBarang = $result->Barang_Name."-".$result->Merk_Name."-".$result->Model_Name;
            $harga = $result->Harga_Jual;
            $barangID = $result->Barang_ID;
        }
        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg,"barangID"=>$barangID,"namaBarang"=>$namaBarang,"harga"=>$harga));
    }

    function getBarangStock(){
        $namaBarang="";
        $harga="";
        $barangID="";

        $kode = $this->input->post("value");
        $result = $this->barang_model->getBarangByKode($kode);

        if(count($result)== 0){
            $status = "error";
            $msg="Barang dengan kode ini tidak terdaftar.";
        }else{
            $status = "success";
            $barangID = $result->Barang_ID;
            $data['data_barang'] = $result;
            $msg=$this->load->view('barang/data_barang_view',$data,true);
        }
        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg,"barangID"=>$barangID));
    }
    
    function goToAddNewBarang(){
 
        $data['main_content'] = 'barang/barang_add-new-item_view';
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

    function goToAddStockBarang(){

        $data['main_content'] = 'barang/barang_add_stock_view';
        $data['data'] = null;
        $data['msg'] = null;

        //Data Selection
        $data['data_supplier'] = $this->supplier_model->getSupplierList(null, null);
        $this->load->view('includes/template_cms', $data);
    }

    function addStockBarang(){
        $datetime = date('Y-m-d H:i:s', time());
        $barangID = $this->input->post('barang');
        $qty = $this->input->post('qty');

        $data=array(
            'Barang_ID'=>$this->input->post('barang'),
            'Supplier_ID'=>$this->input->post('supplier'),
            'Qty'=>$this->input->post('qty'),
            "Created_By" => $this->session->userdata('username'),
            "Last_Modified"=>$datetime,
            "Last_Modified_By"=>$this->session->userdata('username')
        );

        $this->db->trans_begin();
        $query = $this->barang_model->createHistoryBarang($data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo '0';
        }
        else {
            if($query==1){
                $query = $this->barang_model->tambahStockBarang($barangID,$qty);
                if($query==1){
                    $this->db->trans_commit();
                    echo '1';
                }else{
                    $this->db->trans_rollback();
                    echo '0';
                }
            }else{
                $this->db->trans_rollback();
                echo '0';
            }
        }
    }

	function createBarang()
	{
        $status="";
        $msg="";
        $kode = $this->input->post('input_val_1');
        $checkKode = $this->barang_model->checkKodeBarangAdd($kode);
        $datetime = date('Y-m-d H:i:s', time());

        if($checkKode == 0) {
            $data = array(
                'Kode_Barang' => $this->input->post('input_val_1'),
                'Barang_Name' => $this->input->post('input_val_2'),
                'Kategori_ID' => $this->input->post('input_val_3'),
                'SubKategori_ID' => $this->input->post('input_val_4'),
                'Merk_ID' => $this->input->post('input_val_5'),
                'Model_ID' => $this->input->post('input_val_6'),
                'Harga_Jual' => $this->input->post('input_val_7'),
                'Harga_Beli' => $this->input->post('input_val_8'),
                'Satuan_ID' => $this->input->post('input_val_9'),
                'Qty' => $this->input->post('input_val_10'),
                'Limit' => $this->input->post('input_val_11'),
                'Ukuran' => $this->input->post('input_val_12'),
                "Created_By" => $this->session->userdata('username'),
                "Last_Modified" => $datetime,
                "Last_Modified_By" => $this->session->userdata('username')
            );

            $this->db->trans_begin();
            $query = $this->barang_model->createBarang($data);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $status="error";
                $msg="Error while saved data!";
            } else {
                if ($query == 1) {
                    $this->db->trans_commit();
                    $status="success";
                    $msg="Barang berhasil disimpan!";
                } else {
                    $this->db->trans_rollback();
                    $status="error";
                    $msg="Error while saved data!";
                }
            }
        }else{
            //JIKA DUPLICATE KODE BON
            $status="error";
            $msg="Barang dengan kode ini sudah terdaftar !";
        }
        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg));
	}
    
   	function editBarang($id)
	{
        $datetime = date('Y-m-d H:i:s', time());
        $kode = $this->input->post('input_val_1');
        $checkKode = $this->barang_model->checkKodeBarangEdit($kode,$id);

        if($checkKode == 0) {
            $data = array(
                'Kode_Barang' => $this->input->post('input_val_1'),
                'Barang_Name' => $this->input->post('input_val_2'),
                'Kategori_ID' => $this->input->post('input_val_3'),
                'SubKategori_ID' => $this->input->post('input_val_4'),
                'Merk_ID' => $this->input->post('input_val_5'),
                'Model_ID' => $this->input->post('input_val_6'),
                'Harga_Jual' => $this->input->post('input_val_7'),
                'Harga_Beli' => $this->input->post('input_val_8'),
                'Satuan_ID' => $this->input->post('input_val_9'),
                'Qty' => $this->input->post('input_val_10'),
                'Limit' => $this->input->post('input_val_11'),
                'Ukuran' => $this->input->post('input_val_12'),
                "Last_Modified" => $datetime,
                "Last_Modified_By" => $this->session->userdata('username')
            );

            $this->db->trans_begin();
            $query = $this->barang_model->updateBarang($data, $id);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $status="error";
                $msg="Error while saved data!";
            } else {
                $this->db->trans_commit();
                if ($query == 1) {
                    $this->db->trans_commit();
                    $status="success";
                    $msg="Barang berhasil di Update!";
                } else {
                    $this->db->trans_rollback();
                    $status="error";
                    $msg="Error while saved data!";
                }
            }
        }else{
            //JIKA DUPLICATE KODE BON
            $status="error";
            $msg="Barang dengan kode ini sudah terdaftar !";
        }
        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg));
	}

    function barangLimit(){
        $data['main_content'] = 'barang/barang_limit_view';
        $data['data'] = null;
        $data['msg'] = null;

        //$this->output->enable_profiler(TRUE);
        //Data Selection
        $data['data_barang'] = $this->barang_model->getBarangLimit();
        $this->load->view('includes/template_cms', $data);

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
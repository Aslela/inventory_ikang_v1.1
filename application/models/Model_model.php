<?php

class Model_model extends CI_Model {

	function getModelList($start,$limit) //$num=10, $start=0
	{		
		$this->db->select('*'); 
		$this->db->from('tblmmodel a');
		
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Model_Name','asc');
		
		$query = $this->db->get();
		return $query->result_array();
	}

    function getModelListBySearch($start,$limit, $search_name){
        $user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tblmmodel a');
        $this->db->like('a.Model_Name', $search_name);

        $this->db->limit($limit, $start);

        $this->db->order_by('a.Created','asc');

        $query = $this->db->get();
        return $query->result_array();
    }

    function countModelList(){

        $this->db->select('*');
        $this->db->from('tblmmodel a');
        return $this->db->count_all_results();
    }

    function countModelListBySearch($search_name){

        $this->db->select('*');
        $this->db->from('tblmmodel a');
        $this->db->like('a.Model_Name', $search_name);
        return $this->db->count_all_results();
    }

    function createModel($data){
        $this->db->insert('tblmmodel',$data);	
		$result=$this->db->affected_rows();
		return $result;
    }
    
   	function updateModel($data,$id){
		$this->db->where('Model_ID',$id);
		$this->db->update('tblmmodel',$data);
		$result=$this->db->affected_rows();
		return $result;
	}
    
    function deleteModel($id){
    	$this->db->where('Model_ID',$id);
        $this->db->delete('tblmmodel');
	}
}
<?php

class Merk_model extends CI_Model {

	function getMerkList($start,$limit) //$num=10, $start=0
	{		
		$this->db->select('*'); 
		$this->db->from('tblmmerk a');
		
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Merk_Name','asc');
		
		$query = $this->db->get();
		return $query->result_array();
	}

    function getMerkListBySearch($start,$limit, $search_name){
        $user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tblmmerk a');
        $this->db->like('a.Merk_Name', $search_name);

        $this->db->limit($limit, $start);

        $this->db->order_by('a.Merk_Name','asc');

        $query = $this->db->get();
        return $query->result_array();
    }

    function countMerkList(){

        $this->db->select('*');
        $this->db->from('tblmmerk a');
        return $this->db->count_all_results();
    }

    function countMerkListBySearch($search_name){

        $this->db->select('*');
        $this->db->from('tblmmerk a');
        $this->db->like('a.Merk_Name', $search_name);
        return $this->db->count_all_results();
    }
    
    function createMerk($data){
        $this->db->insert('tblmmerk',$data);	
		$result=$this->db->affected_rows();
		return $result;
    }
    
   	function updateMerk($data,$id){
		$this->db->where('Merk_ID',$id);
		$this->db->update('tblmmerk',$data);
		$result=$this->db->affected_rows();
		return $result;
	}
    
    function deleteMerk($id){
    	$this->db->where('Merk_ID',$id);
        $this->db->delete('tblmmerk');
	}
}
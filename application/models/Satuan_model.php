<?php

class Satuan_model extends CI_Model {

	function getSatuanList($start,$limit) //$num=10, $start=0
	{		
		$this->db->select('*'); 
		$this->db->from('tblmsatuan a');
		
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Created','desc');
		
		$query = $this->db->get();
		return $query->result_array();
	}

    function getSatuanListBySearch($start,$limit, $search_name){
        $user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tblmsatuan a');
        $this->db->like('a.Satuan_Name', $search_name);

        $this->db->limit($limit, $start);

        $this->db->order_by('a.Created','desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    function countSatuanList(){

        $this->db->select('*');
        $this->db->from('tblmsatuan a');
        return $this->db->count_all_results();
    }

    function countSatuanListBySearch($search_name){

        $this->db->select('*');
        $this->db->from('tblmsatuan a');
        $this->db->like('a.Satuan_Name', $search_name);
        return $this->db->count_all_results();
    }
    
    function createSatuan($data){
        $this->db->insert('tblmsatuan',$data);	
		$result=$this->db->affected_rows();
		return $result;
    }
    
   	function updateSatuan($data,$id){
		$this->db->where('Satuan_ID',$id);
		$this->db->update('tblmsatuan',$data);
		$result=$this->db->affected_rows();
		return $result;
	}
    
    function deleteSatuan($id){
    	$this->db->where('Satuan_ID',$id);
        $this->db->delete('tblmsatuan');
	}
}
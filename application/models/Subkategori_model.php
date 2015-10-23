<?php

class Subkategori_model extends CI_Model {

	function getSubKategoriList($start,$limit) //$num=10, $start=0
	{		
		$this->db->select('*'); 
		$this->db->from('tblmsubkategori a');
		
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Created','desc');
		
		$query = $this->db->get();
		return $query->result_array();
	}

    function getSubKategoriListBySearch($start,$limit, $search_name){
        $user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tblmsubkategori a');
        $this->db->like('a.SubKategori_Name', $search_name);

        $this->db->limit($limit, $start);

        $this->db->order_by('a.Created','desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    function countSubKategoriList(){

        $this->db->select('*');
        $this->db->from('tblmsubkategori a');
        return $this->db->count_all_results();
    }

    function countSubKategoriListBySearch($search_name){

        $this->db->select('*');
        $this->db->from('tblmsubkategori a');
        $this->db->like('a.SubKategori_Name', $search_name);
        return $this->db->count_all_results();
    }

    function createSubKategori($data){
        $this->db->insert('tblmsubkategori',$data);	
		$result=$this->db->affected_rows();
		return $result;
    }
    
   	function updateSubKategori($data,$id){
		$this->db->where('SubKategori_ID',$id);
		$this->db->update('tblmsubkategori',$data);
		$result=$this->db->affected_rows();
		return $result;
	}
    
    function deleteSubKategori($id){
    	$this->db->where('SubKategori_ID',$id);
        $this->db->delete('tblmsubkategori');
	}
}
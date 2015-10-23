<?php

class Kategori_model extends CI_Model {

	function getKategoriList($start,$limit) //$num=10, $start=0
	{		
		$user = $this->session->userdata('id_user');
		$this->db->select('*'); 
		$this->db->from('tblmkategori a');
		
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Created','desc');
		
		$query = $this->db->get();
		return $query->result_array();
	}
    
    function getKategoriListBySearch($start,$limit, $search_name){
   	    $user = $this->session->userdata('id_user');
		$this->db->select('*'); 
		$this->db->from('tblmkategori a');
        $this->db->like('a.Kategori_Name', $search_name);
	
        $this->db->limit($limit, $start);
		
		$this->db->order_by('a.Created','desc');
		
		$query = $this->db->get();
		return $query->result_array();
    }
    
    function countKategoriList(){
 
		$this->db->select('*'); 
		$this->db->from('tblmkategori a');
        return $this->db->count_all_results();
    }
    
    function countKategoriListBySearch($search_name){
 
		$this->db->select('*'); 
		$this->db->from('tblmkategori a');
        $this->db->like('a.Kategori_Name', $search_name);
        return $this->db->count_all_results();
    }
    
    function createKategori($data){
        $this->db->insert('tblmkategori',$data);	
		$result=$this->db->affected_rows();
		return $result;
    }
    
   	function updateKategori($data,$id){
		$this->db->where('Kategori_ID',$id);
		$this->db->update('tblmkategori',$data);
		$result=$this->db->affected_rows();
		return $result;
	}
    
    function deleteKategori($id){
    	$this->db->where('Kategori_ID',$id);
        $this->db->delete('tblmkategori');
	}
}
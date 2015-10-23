<?php

class Penjualan_detail_model extends CI_Model {

	function getPenjualanList($start,$limit) //$num=10, $start=0
	{		
		$this->db->select('*'); 
		$this->db->from('tbltpenjualan a');
        
		
        if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Created','desc');
		
		$query = $this->db->get();
		return $query->result_array();
	}
    
   	function getBarangByID($id) {		
		$this->db->select('*'); 
		$this->db->from('tbltbarang a');
        $this->db->join('tblmkategori b', 'a.Kategori_ID = b.Kategori_ID');
        $this->db->join('tblmsubkategori c', 'a.SubKategori_ID = c.SubKategori_ID');
        $this->db->join('tblmmerk d', 'a.Merk_ID = d.Merk_ID');
        $this->db->join('tblmmodel e', 'a.Model_ID = e.Model_ID');
		
        $this->db->where('a.Barang_ID',$id);
		
		$query = $this->db->get();
		return $query->row_array();
	}
    
    function createPenjualanDetail($data){
        $this->db->insert('tbltpenjualandetail',$data);	
       	$result=$this->db->affected_rows();
		return $result;
    }
    
   	function updateBarang($data,$id){
		$this->db->where('Barang_ID',$id);
		$this->db->update('tbltbarang',$data);
		$result=$this->db->affected_rows();
		return $result;
	}
    
    function deleteBarang($id){
    	$this->db->where('Barang_ID',$id);
        $this->db->delete('tbltbarang');
	}
}
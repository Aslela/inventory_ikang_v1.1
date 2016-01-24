<?php

class Barang_model extends CI_Model {

	function getBarangList($start,$limit) //$num=10, $start=0
	{		
		$this->db->select('*'); 
		$this->db->from('tbltbarang a');
        $this->db->join('tblmkategori b', 'a.Kategori_ID = b.Kategori_ID');
        $this->db->join('tblmsubkategori c', 'a.SubKategori_ID = c.SubKategori_ID');
        $this->db->join('tblmmerk d', 'a.Merk_ID = d.Merk_ID');
        $this->db->join('tblmmodel e', 'a.Model_ID = e.Model_ID');
        $this->db->join('tblmsatuan s', 'a.Satuan_ID = s.Satuan_ID');
		
        if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Created','desc');
		
		$query = $this->db->get();
		return $query->result_array();
	}
    
    function getBarangData($page,$limit,$search){
   	     	
		$count = $this->getCountBarangData($search);
        
        if( $count > 0 ) {
        	$total_pages = ceil($count/$limit);
        } else {
        	$total_pages = 0;
        }
        
        if ($page > $total_pages) $page=$total_pages;
        $start = $limit*$page - $limit;
           
        $this->db->select('*'); 
		$this->db->from('tbltbarang a');
        $this->db->join('tblmkategori b', 'a.Kategori_ID = b.Kategori_ID');
        $this->db->join('tblmsubkategori c', 'a.SubKategori_ID = c.SubKategori_ID');
        $this->db->join('tblmmerk d', 'a.Merk_ID = d.Merk_ID');
        $this->db->join('tblmmodel e', 'a.Model_ID = e.Model_ID');
        $this->db->join('tblmsatuan s', 'a.Satuan_ID = s.Satuan_ID');
		
        if($search!=null || $search != ""){
            $this->db->like('a.Kode_Barang',$search);
		}
        
        if($total_pages!=0){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Created','desc');
		
        $query = $this->db->get();
        $result = $query->result_array();
        
        $i=0;
        $response=[];
        foreach($result as $row){
            $response->rows[$i]['Barang_ID']=$row['Barang_ID'];
            $response->rows[$i]['Kode_Barang']=$row['Kode_Barang'];
            $response->rows[$i]['Barang_Name']=$row['Barang_Name'];
            $response->rows[$i]['Harga_Jual']=$row['Harga_Jual'];
            $response->rows[$i]['Qty']=$row['Qty'];
            $i++;
        }
             
        $response->page = $page;
        $response->total = $total_pages;
        $response->records = $count;
        
        return $response;
    }

    public function getBarangAutoComplete($page,$limit,$search){
        $this->db->select('*');
        $this->db->from('tbltbarang a');
        $this->db->join('tblmkategori b', 'a.Kategori_ID = b.Kategori_ID');
        $this->db->join('tblmsubkategori c', 'a.SubKategori_ID = c.SubKategori_ID');
        $this->db->join('tblmmerk d', 'a.Merk_ID = d.Merk_ID');
        $this->db->join('tblmmodel e', 'a.Model_ID = e.Model_ID');
        $this->db->join('tblmsatuan s', 'a.Satuan_ID = s.Satuan_ID');

        if($search!=null || $search != ""){
            $this->db->like('a.Barang_Name',$search);
        }

        $this->db->order_by('a.Created','desc');

        $query = $this->db->get();
        return $query->result_array();

    }

    
    public function getCountBarangData($search){
        $this->db->select('*'); 
		$this->db->from('tbltbarang a');
        if($search!=null){
            $this->db->like('a.Kode_Barang',$search);
		}
        $query = $this->db->count_all_results();
        return $query;  
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

    function getBarangByKode($kode) {
        $this->db->select('*');
        $this->db->from('tbltbarang a');
        $this->db->join('tblmkategori b', 'a.Kategori_ID = b.Kategori_ID');
        $this->db->join('tblmsubkategori c', 'a.SubKategori_ID = c.SubKategori_ID');
        $this->db->join('tblmmerk d', 'a.Merk_ID = d.Merk_ID');
        $this->db->join('tblmmodel e', 'a.Model_ID = e.Model_ID');

        $this->db->where('a.Kode_Barang',$kode);

        $query = $this->db->get();
        return $query->row();
    }

    function getBarangLimit(){
        $this->db->select('*');
        $this->db->from('tbltbarang a');

        $this->db->where('(a.limit)*2 > a.qty');
        $this->db->or_where('a.limit > a.qty');
        $this->db->order_by('a.qty','asc');

        $query = $this->db->get();
        return $query->result_array();
    }
    
    function createBarang($data){
        
        $this->db->insert('tbltbarang',$data);	
		$result=$this->db->affected_rows();
        return $result;
	
    }
    
   	function updateBarang($data,$id){
		$this->db->where('Barang_ID',$id);
		$this->db->update('tbltbarang',$data);
		$result=$this->db->affected_rows();
		return $result;
	}
    
    function kurangStockBarang($id_barang, $stock){
        $this->db->set('Qty', 'Qty-'.$stock, FALSE);
   	    $this->db->where('Barang_ID',$id_barang);
		$this->db->update('tbltbarang');
		$result=$this->db->affected_rows();
		return $result;
    }
    
    function tambahStockBarang($id_barang, $stock){
        $this->db->set('Qty', 'Qty+'.$stock, FALSE);
   	    $this->db->where('Barang_ID',$id_barang);
		$this->db->update('tbltbarang');
		$result=$this->db->affected_rows();
		return $result;
    }

    function deleteBarang($id){
    	$this->db->where('Barang_ID',$id);
        $this->db->delete('tbltbarang');
	}
}
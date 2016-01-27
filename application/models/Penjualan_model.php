<?php

class Penjualan_model extends CI_Model {

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

    function getPenjualanHeader($id){
        $this->db->select('a.Penjualan_ID, Kode_Bon, Date_Format(Tgl_Penjualan, "%Y-%m-%d") as Tgl_Penjualan,
        Date_Format(Tgl_Jatuh_Tempo, "%Y-%m-%d") as Tgl_Jatuh_Tempo, Nama_Pembeli, Status, Harga_Hutang,
        Discount, Harga_Total,
        a.Created, a.Created_By, a.Last_Modified, a.Last_Modified_By');
        $this->db->from('tbltpenjualan a');
        $this->db->where('a.Penjualan_ID',$id);
        $query = $this->db->get();
        return $query->row();
    }
    function getPenjualanDetail($id){
        $this->db->select(' b.Penjualan_Detail_ID, b.Barang_ID, c.Barang_Name,b.Qty, c.Kode_Barang, b.status,
            FORMAT(b.Harga_Jual_Normal, 0,"id_ID") as Harga_Jual_Normal,
            FORMAT(b.Harga_Jual, 0,"id_ID") as Harga_Jual,
            FORMAT(b.Harga_Jual*b.Qty,0,"id_ID") as Harga_Total ');
		$this->db->from('tbltpenjualan a');
        $this->db->join('tbltpenjualandetail b', 'a.Penjualan_ID = b.Penjualan_ID');
        $this->db->join('tbltbarang c', 'b.Barang_ID = c.Barang_ID');
        $this->db->where('a.Penjualan_ID',$id);
        $this->db->order_by('b.status','asc');
        $query = $this->db->get();
		return $query->result_array();
    }
    
    function createPenjualanHeader($data){
        $this->db->insert('tbltpenjualan',$data);	
        $last_id = $this->db->insert_id();
        return $last_id;
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
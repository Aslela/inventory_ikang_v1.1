<?php

class Kategori_model extends CI_Model {

    var $column_order = array('Kategori_ID','Kategori_Name',null); //set column field database for datatable orderable
    var $column_search = array('Kategori_Name'); //set column field database for datatable searchable just firstname ,

	function getKategoriList( $sWhere, $sOrder, $sLimit) //$num=10, $start=0
	{
		$user = $this->session->userdata('id_user');
        /*
		$this->db->select('*'); 
		$this->db->from('tblmkategori a');
		
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('a.Kategori_Name','asc');
		
		$query = $this->db->get();*/

        $query = $this->db->query("
           SELECT Kategori_ID, Kategori_Name, Created, Created_By, Last_Modified, Last_Modified_By, Kategori_ID as action
           FROM tblmkategori
            $sWhere
            $sOrder
            $sLimit
        ");
		return $query->result_array();
	}

    function  getKategoriListData ($searchText,$orderByColumnIndex,$orderDir, $start,$limit){
        $this->_dataKategoriQuery($searchText,$orderByColumnIndex,$orderDir);
        // LIMIT
        if($limit!=null || $start!=null){
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
        return $query->result_array();

    }

    function count_filtered($searchText){
        $this->_dataKategoriQuery($searchText,null,null);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all(){
        $this->db->from("tblmkategori");
        return $this->db->count_all_results();
    }


    function _dataKategoriQuery($searchText,$orderByColumnIndex,$orderDir){
        $this->db->select('*');
        $this->db->from('tblmkategori a');

        //WHERE
        $i = 0;
        if($searchText != null && $searchText != ""){
            //Search By Each Column that define in $column_search
            foreach ($this->column_search as $item){
                // first loop
                if($i===0){
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $searchText);
                }
                else {
                    $this->db->or_like($item, $searchText);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket

                $i++;
            }
        }

        //Order by
        if($orderByColumnIndex != null && $orderDir != null ) {
            $this->db->order_by($this->column_order[$orderByColumnIndex], $orderDir);
        }
    }
    
    function getKategoriListBySearch($start,$limit, $search_name){
   	    $user = $this->session->userdata('id_user');
		$this->db->select('*'); 
		$this->db->from('tblmkategori a');
        $this->db->like('a.Kategori_Name', $search_name);
	
        $this->db->limit($limit, $start);
		
		$this->db->order_by('a.Kategori_Name','asc');
		
		$query = $this->db->get();
		return $query->result_array();
    }
    
    function countKategoriList($sWhere){

        $query = $this->db->query("
            SELECT Kategori_ID
            FROM tblmkategori
			$sWhere
        ");

        return $query->num_rows();
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
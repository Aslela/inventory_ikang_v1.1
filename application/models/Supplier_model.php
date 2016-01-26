<?php

class Supplier_model extends CI_Model {

    function getSupplierList($start,$limit) //$num=10, $start=0
    {
        $user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tblmsupplier a');

        if($limit!=null || $start!=null){
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('a.Created','desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    function getSupplierListBySearch($start,$limit, $search_name){
        $user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tblmsupplier a');
        $this->db->like('a.Supplier_Name', $search_name);

        $this->db->limit($limit, $start);

        $this->db->order_by('a.Created','desc');

        $query = $this->db->get();
        return $query->result_array();
    }

    function countSupplierList(){

        $this->db->select('*');
        $this->db->from('tblmsupplier a');
        return $this->db->count_all_results();
    }

    function countSupplierListBySearch($search_name){

        $this->db->select('*');
        $this->db->from('tblmsupplier a');
        $this->db->like('a.Supplier_Name', $search_name);
        return $this->db->count_all_results();
    }

    function createSupplier($data){
        $this->db->insert('tblmsupplier',$data);
        $result=$this->db->affected_rows();
        return $result;
    }

    function updateSupplier($data,$id){
        $this->db->where('Supplier_ID',$id);
        $this->db->update('tblmsupplier',$data);
        $result=$this->db->affected_rows();
        return $result;
    }

    function deleteSupplier($id){
        $this->db->where('Supplier_ID',$id);
        $this->db->delete('tblmsupplier');
    }
}
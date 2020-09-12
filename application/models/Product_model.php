<?php

class Product_Model extends CI_Model{
    
    public function save_product_info($data){
        return $this->db->insert('products', $data);
    }
    
    public function get_all_product(){
        $this->db->select('*');
        $this->db->from('products');
        // $this->db->join('categories','categories.id=products.category_id','categories.name=products.category_id');
        $this->db->order_by('products.id', 'DESC');
        $info = $this->db->get();
        return $info->result();
    }
    
    public function edit_product_info($id){
        $this->db->select('*');
        $this->db->from('products');
        // $this->db->join('categories','categories.id=products.category_id');
        $this->db->where('products.id', $id);
        $info = $this->db->get();
        return $info->row();
    }
    
    public function delete_product_info($id){
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }
    
    public function update_product_info($data,$id){
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }
    
    
    
    public function get_all_published_category(){
        $this->db->select('*');
        $this->db->from('categories');
        $info = $this->db->get();
        return $info->result();
    }
    
}
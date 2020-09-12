<?php
class Category_model extends CI_Model
{
    public function save_category_info($data){
        return $this->db->insert('categories', $data);
    }

    public function getall_category_info(){
        $this->db->select('*');
        $this->db->from('categories');
        $info = $this->db->get();
        return $info->result();
    }

    public function getCategories(){
        $this->db->select("*");
        $this->db->from('categories');
        $query = $this->db->get();
        return $query->result();
    }

    public function edit_category_info($id){
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('id',$id);
        $info = $this->db->get();
        return $info->row();
    }
    
    public function delete_category_info($id){
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }
    
    public function update_category_info($data,$id){
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }
}

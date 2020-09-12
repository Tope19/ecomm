<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile_model extends CI_Model{

    public function getprofile($userid){
        $query = $this->db->select('*')
            ->where('id',$userid)
            ->from('users')
            ->get();
        return $query->row();
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_model extends CI_Model{
    public function insert(){
        $id = $this->input->post('id');
        $user = $this->UserModel->get_by('id', $this->session->userdata['id']);
        $amount = $this->UserModel->get_by('id', $this->session->userdata['id']);
        $fixed = 50000;
        $amount_paid = $amount->amount_paid - $fixed; 
        $payment = array(
            'user_id' => $user->id,
            'amount_paid' =>  - $amount_paid,

        );

        return $this->db->insert('payments', $payment);
    }

    public function get_all_payments(){
        $this->db->order_by('id','desc');
        $this->db->select("*");
        $this->db->from('payments');
        $query = $this->db->get();
        return $query->result();
    }

    public function getpayment($userid){
        $query = $this->db->select('*')
            ->where('id',$userid)
            ->from('payments')
            ->get();
        return $query->row();
    }
}
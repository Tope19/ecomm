<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Commonmodel extends MY_Model
{

    public $table = '';
    var $month_start;
    var $mont_end;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->month_start = date('Y-m-01 00:00:00', strtotime('this month'));
        $this->mont_end = date('Y-m-t 12:59:59', strtotime('this month'));
    }

    function authenticate($username, $secret)
    {
        $this->db->where('email', $username); //->get($this->table)->result();
        $this->db->where('password', md5(trim($secret)));
        $row = $this->db->get(USER_TABLE)->row();
        log_message("debug", $this->db->last_query());
        return $row;
    }


    function register($user_data)
    {
        $affected_rows = $this->db->insert(USER_TABLE, $user_data);
        log_message("debug", $this->db->last_query());
        return $affected_rows;
    }

    function rest_key_exists($key)
    {
        $result = $this->db
            ->where(config_item('rest_key_column'), $key)
            ->count_all_results(config_item('rest_keys_table')) > 0;
        log_message("debug", $this->db->last_query());
        return $result;
    }

    function rest_get_key($key)
    {
        $row = $this->db
            ->where(config_item('rest_key_column'), $key)
            ->get(config_item('rest_keys_table'))
            ->row();
        log_message("debug", $this->db->last_query());
        return $row;
    }

    function rest_insert_key($user_id, $ip_address, $key, $data)
    {
        $data[config_item('rest_key_column')] = $key;
        $data['date_created'] = function_exists('now') ? now() : time();
        $data['user_id'] = $user_id;
        $data['ip_addresses'] = $ip_address;

        $result = $this->db
            ->set($data)
            ->insert(config_item('rest_keys_table'));
        log_message("debug", $this->db->last_query());
        return $result;
    }

    public function getAllUsers(){
		$query = $this->db->get('users');
		return $query->result(); 
	}

	public function insert($user){
		$this->db->insert('users', $user);
		return $this->db->insert_id(); 
	}

	public function getUser($id){
		$query = $this->db->get_where('users',array('id'=>$id));
		return $query->row_array();
	}

	public function activate($data, $id){
		$this->db->where('users.id', $id);
		return $this->db->update('users', $data);
	}
}

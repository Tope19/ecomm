<?php

class MY_Model extends CI_Model {

    public $table;

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->limit(1)->get($this->table)->row();
    }

    public function get_many_by($field_name, $field_value) {
        $result = $this->db->where($field_name, $field_value)->get($this->table)->result();
        log_message("debug", $this->db->last_query());
        return $result;
    }

    public function get_many_by_two_fields($field_name1, $field_value1, $field_name2, $field_value2) {
        $this->db->where($field_name1, $field_value1); //->get($this->table)->result();
        $this->db->where($field_name2, $field_value2);
        $result = $this->db->get($this->table)->result();
        log_message("debug", $this->db->last_query());
        return $result;
    }

    public function get_by($field_name, $field_value) {
        $result = $this->db->where($field_name, $field_value)->get($this->table)->row();
        log_message("debug", $this->db->last_query());
        return $result;
    }

    public function get_by_two_fields($field_name1, $field_value1, $field_name2, $field_value2) {
        $this->db->where($field_name1, $field_value1);
        $this->db->where($field_name2, $field_value2);
        $result = $this->db->get($this->table)->row();
        log_message("debug", $this->db->last_query());
        return $result;
    }

    public function insert($data) {
        $this->db->set($data);
        $this->db->insert($this->table);
        log_message("debug", $this->db->last_query());
        return $this->db->insert_id();
    }

    public function update($id, $data) {

        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $result = $this->db->affected_rows();
        log_message("debug", $this->db->last_query());
        return $result;

//        $this->db->where('id', $id);
//        $this->db->set($data);
//        $this->db->update($this->table);
//        $result = $this->db->affected_rows();
//        log_message("debug", $this->db->last_query());
//        return $result;
    }

    public function update_by_field($field, $field_value, $data) {

        $this->db->where($field, $field_value);
        $this->db->update($this->table, $data);
        $result = $this->db->affected_rows();
        log_message("debug", $this->db->last_query());
        return $result;

//        $this->db->where($field, $field_value);
//        $this->db->set($data);
//        $this->db->update($this->table);
//        $result = $this->db->affected_rows();
//        log_message("debug", $this->db->last_query());
//        return $result;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        log_message("debug", $this->db->last_query());
        return $this->db->affected_rows();
    }

    function execute_custom_query($sql) {
        $this->db->query($sql);
        log_message("debug", $this->db->last_query());
    }

    function get_unsynchronized_data($last_sync_timestamp) {
        $table = $this->table;
        $sql = "select * from " . $table . "
                where created > '" . $last_sync_timestamp . "'";

//        $sql = "select
//                d.id,
//                d.based_plant,
//                d.created,
//                d.driver_full_name,
//                d.driverid,
//                d.employer,
//                d.enrolled,
//                d.left_forefinger,
//                d.left_littlefinger,
//                d.left_middlefinger,
//                d.left_ringfinger,
//                d.left_thumb,
//                d.license_number,
//                d.phone_number,
//                d.reg_no,
//                d.right_forefinger,
//                d.right_littlefinger,
//                d.right_middlefinger,
//                d.right_ringfinger,
//                d.right_thumb
//                from " . $table . " d
//                 where created > '" . $last_sync_timestamp . "'";

        $result = $this->db->query($sql)->result();
        log_message("debug", $this->db->last_query());
        return $result;
    }



    function get_data_from_last_id($last_id) {
        $table = $this->table;
        $sql = "select * from " . $table . "
                where id > '" . $last_id . "'";
        $result = $this->db->query($sql)->result();
        log_message("debug", $this->db->last_query());
        return $result;
    }

    function count_rows($field_name, $field_value) {
        $result = $this->db->where($field_name, $field_value);
        $result = $this->db->count_all_results();
        log_message("debug", $this->db->last_query());
        return $result;
    }

}

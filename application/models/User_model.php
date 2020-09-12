<?php
class User_model extends CI_Model
{
	public function register($enc_password)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'phone' => $this->input->post('phone'),
			'password' => $enc_password
		);

		return $this->db->insert('users', $data);
	}

	public function login($email, $password)
	{

		$this->db->where('email', $email);
		$this->db->where('password', $password);

		$result = $this->db->get('users');

		if ($result->num_rows()  == 1) {
			return $result->row(0)->id;
		} else {
			return false;
		}
	}

	public function check_email_exists($email)
	{
		$query = $this->db->get_where('users', array(
			'email' => $email
		));
		if (empty($query->row_array())) {
			return true;
		} else {
			return false;
		}
	}

    public function chkAdminExist(){
        $chkAdmin = $this->db->where(array('user_status' => 'ADMIN'))->get('users');
        if ($chkAdmin->num_rows() > 0){
            return $chkAdmin->row();
        }
    }

    public function chkUserExist(){
        $chkUser = $this->db->where(array('user_status' => 'USER'))->get('users');
        if ($chkUser->num_rows() > 0){
            return $chkUser->row();
        }
    }

	public function adminExists($email, $password){
	    $chkAdmin = $this->db->where(array('email' => $email, 'password' => $password))->get('users');
	    if ($chkAdmin->num_rows() > 0){
	        return $chkAdmin->row();
        }
	}
	
    public function getallusers(){
		$this->db->order_by('id','desc');
        $this->db->select("*");
        $query = $this->db->from('users');
        $query = $this->db->get();
        return $query->result();

	}
	
	public function get_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }
	
	public function get_userid($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }
	
	//update record
    public function update($table, $update, $id)
    {
        $this->db->where($id);
        $query = $this->db->update($table, $update);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}

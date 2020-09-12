<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('commonmodel');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->data['users'] = $this->commonmodel->getAllUsers();
    }

    public function login(){
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $this->load->view('login_view');
        } else {
            //get email
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user_data = $this->commonmodel->authenticate($email, $password);

            if ($user_data != null && is_object($user_data)) {

                $session_data = array(
                    'id' => $user_data->id,
                    'email' => $user_data->email,
                    'firstname' => $user_data->firstname,
                    'lastname' => $user_data->lastname,
                    'userstatus' => $user_data->role,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($session_data);
                $this->session->set_flashdata(SUCCESS_MESSAGE, 'Login was successful');
                redirect(base_url() . 'AdminDashboard');


            } else {
                $this->session->set_flashdata(ERROR_MESSAGE, 'login is Invalid');
                redirect(base_url() . 'user/login');
            }
        }
    }

    public function register(){
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[14]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[3]|max_length[14]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]|min_length[6]|max_length[50]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|is_unique[users.phone]|required|numeric|exact_length[11]');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|max_length[20]|required');
        $this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() === false) {
            $this->load->view('register_view',$this->data);
        } else{
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $password = md5($this->input->post('password'));


            $user['firstname'] = $firstname;
            $user['lastname'] = $lastname;
            $user['email'] = $email;
            $user['phone'] = $phone;
            $user['password'] = $password;

            $this->commonmodel->insert($user);

            $this->session->set_flashdata(SUCCESS_MESSAGE, 'Your registration was successful! Please login');
            redirect(base_url() . 'user/login');
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata(SUCCESS_MESSAGE, 'Your logged out');
        redirect(base_url());
    }

}

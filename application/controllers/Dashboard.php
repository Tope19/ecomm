<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Commonmodel');
        $this->load->model('User_model', 'users');
        if(!$this->session->userdata("id"))
            return redirect(base_url(). 'user/login');
    }

    public function index(){
        $this->load->view('users/home_view');
    }


}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
    }

    public function index(){
        $data = array();
        $query = $this->Category_model->getCategories();
        $data['CATEGORIES'] = null;
        if ($query){
            $data['CATEGORIES'] = $query;
        }
	    $this->load->view('home_view',$data);
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Category_model');
    }

    public function add_category(){
        $data= array();
        $data['all_categroy'] = $this->Category_model->getall_category_info();
        $this->load->view('admin/categories/home_view',$data);
    }

    public function save_category(){
        $data= array();
        $data['name']=$this->input->post('name');
        $data['description']=$this->input->post('description');

        $this->form_validation->set_rules('name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Category Description', 'trim|required');


        if ($this->form_validation->run() == true) {


            $result = $this->Category_model->save_category_info($data);

            if ($result) {
                $this->session->set_flashdata(SUCCESS_MESSAGE, 'Category Inserted Sucessfully');
                redirect(base_url() . 'Category/add_category');
            } else {
                $this->session->set_flashdata(ERROR_MESSAGE, 'Category Inserted Failed');
                rredirect(base_url() . 'Category/add_category');
            }
        } else {
            $this->session->set_flashdata(ERROR_MESSAGE, validation_errors());
            redirect(base_url() . 'Category/add_category');
        }
    }

    public function delete_category($id){
        $result = $this->Category_model->delete_category_info($id);
        if ($result) {
            $this->session->set_flashdata(SUCCESS_MESSAGE, 'Category Deleted Sucessfully');
            redirect(base_url() . 'Category/add_category');
        } else {
            $this->session->set_flashdata(ERROR_MESSAGE, 'Category Deleted Failed');
            redirect(base_url() . 'Category/add_category');
        }
    }
    
     public function edit_category($id){
        $data= array();
        $data['category_info_by_id'] = $this->Category_model->edit_category_info($id);
        $this->load->view('admin/categories/edit_view',$data);
    }
    
    public function update_category($id){
        $data = array();
        $data['name']=$this->input->post('name');
        $data['description']=$this->input->post('description');
        
        $this->form_validation->set_rules('name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Category Description', 'trim|required');
               
        if($this->form_validation->run() == true){
            $result = $this->Category_model->update_category_info($data,$id);
            if($result){
                $this->session->set_flashdata(SUCCESS_MESSAGE,'Category Updated Sucessfully');
                redirect(base_url() . 'Category/add_category');   
            }
            else{
                $this->session->set_flashdata(ERROR_MESSAGE,'Category Update Failed');
                redirect(base_url() . 'Category/add_category');
            }
        }
        else{
            $this->session->set_flashdata(ERROR_MESSAGE,validation_errors());
            redirect(base_url() . 'Category/add_category');
        }
        
    }
}
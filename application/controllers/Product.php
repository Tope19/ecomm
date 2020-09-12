<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('Product_model');
    }

    public function add_product(){
        $data= array();
        $data['all_published_category']=$this->Product_model->get_all_published_category();
        $data['get_all_product']=$this->Product_model->get_all_product();
        $this->load->view('admin/products/home_view',$data);
    }

    public function save_product(){
        $data = array();
        $data['category_id'] = $this->input->post('category_id');
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['type'] = $this->input->post('type');
        $data['price'] = $this->input->post('price');
        $data['quantityonhand'] = $this->input->post('quantityonhand');

        $this->form_validation->set_rules('category_id', 'Category Id', 'trim|required');
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Product Description', 'trim|required');
        $this->form_validation->set_rules('type', 'Product Type', 'trim|required');
        $this->form_validation->set_rules('price', 'Product Price', 'trim|required');
        $this->form_validation->set_rules('quantityonhand', 'Product Quantity', 'trim|required');

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = APPPATH. '../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 4096;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata(ERROR_MESSAGE, $error);
                redirect(base_url() . 'Product/add_product');
            }
            else{
                $post_image = $this->upload->data();
                $data['image'] = $post_image['file_name'];
            }
        }
        if ($this->form_validation->run() == true) {
            $result = $this->Product_model->save_product_info($data);

            if ($result) {
                $this->session->set_flashdata(SUCCESS_MESSAGE, 'Product Inserted Sucessfully');
                redirect(base_url() . 'Product/add_product');
            } else {
                $this->session->set_flashdata(ERROR_MESSAGE, 'Product Inserted Failed');
                redirect(base_url() . 'Product/add_product');
            }
        } else {
            $this->session->set_flashdata(ERROR_MESSAGE, validation_errors());
            redirect(base_url() . 'Product/add_product');
        }
    }

    public function edit_product($id){
        $data= array();
        $data['all_published_category']=$this->Product_model->get_all_published_category();
        $data['product_info_by_id'] = $this->Product_model->edit_product_info($id);
        $this->load->view('admin/products/edit_view',$data);
    }

    public function update_product($id) {
        $data = array();
        $data['category_id'] = $this->input->post('category_id');
        $data['name'] = $this->input->post('name');
        $data['description'] = $this->input->post('description');
        $data['type'] = $this->input->post('type');
        $data['price'] = $this->input->post('price');
        $data['quantityonhand'] = $this->input->post('quantityonhand');

        $product_delete_image = $this->input->post('product_delete_image');
        $delete_image = substr($product_delete_image, strlen(base_url()));

        $this->form_validation->set_rules('category_id', 'Category Id', 'trim|required');
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Product Description', 'trim|required');
        $this->form_validation->set_rules('type', 'Product Type', 'trim|required');
        $this->form_validation->set_rules('price', 'Product Price', 'trim|required');
        $this->form_validation->set_rules('quantityonhand', 'Product Quantity', 'trim|required');

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = APPPATH. '../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 4096;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata(ERROR_MESSAGE, $error);
                redirect(base_url() . 'Product/add_product');
            }
            else{
                $post_image = $this->upload->data();
                $data['image'] = $post_image['file_name'];
                unlink($delete_image);
            }
        }
        if ($this->form_validation->run() == true) {

            $result = $this->Product_model->update_product_info($data,$id);

            if ($result) {
                $this->session->set_flashdata(SUCCESS_MESSAGE, 'Product Updated Sucessfully');
                redirect(base_url() . 'Product/add_product');
            } else {
                $this->session->set_flashdata(ERROR_MESSAGE, 'Product Update Failed');
                redirect(base_url() . 'Product/add_product');
            }
        } else {
            $this->session->set_flashdata(ERROR_MESSAGE, validation_errors());
            redirect(base_url() . 'Product/add_product');
        }
    }

    public function delete_product($id){
        $delete_image =$this->get_image_by_id($id);
        unlink('uploads/'.$delete_image->image);
        $result = $this->Product_model->delete_product_info($id);
        if ($result) {
            $this->session->set_flashdata(SUCCESS_MESSAGE, 'Product Deleted Sucessfully');
                redirect(base_url() . 'Product/add_product');
        } else {
            $this->session->set_flashdata(ERROR_MESSAGE, 'Product Failed to Delete!');
                redirect(base_url() . 'Product/add_product');
        }
    }

    private function get_image_by_id($id){
        $this->db->select('image');
        $this->db->from('products');
        $this->db->where('products.id', $id);
        $info = $this->db->get();
        return $info->row();
    }
}
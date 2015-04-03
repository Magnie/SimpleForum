<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
    public function __contruct() {
        parent::__construct();
        // Load model for access to the database, namely categories and threads.
        
    }
    
    public function index() {
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }
    
    public function category($category_id = '0', $page = 0) {
        $this->load->model('Forum_model');
        
        $category = $this->Forum_model->get_category($category_id);
        
        
        // Get the data needed for the page.
        //$data['output'] = $category;
        $data['category'] = 'Home';
        $data['parent_id'] = '0';
        $data['parent'] = 'Home';
        if ($category) {
            $data['category'] = $category->name;
            $parent = $this->Forum_model->get_category($category->parent);
            if ($parent) {
                $data['parent_id'] = $parent->id;
                $data['parent'] = $parent->name;
            }
        }
        $data['category_id'] = $category_id;
        $data['categories'] = $this->Forum_model->get_categories($category_id);
        $data['threads'] = $this->Forum_model->get_threads($category_id, $page);
        
        // Render the page.
        $this->load->view('header');
        $this->load->view('category', $data);
        $this->load->view('footer');
    }
    
    public function thread($thread) {
        $this->load->view('header');
        
        $this->load->view('footer');
    }
}
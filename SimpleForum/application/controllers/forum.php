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
    
    public function category($category_id = '-1', $page = 0) {
        if ($category_id == '-1') { redirect('/forum/category/0'); }
        $this->load->model('Forum_model');
        
        $category = $this->Forum_model->get_category($category_id);
        
        
        // Get the data needed for the page.
        //$data['output'] = $category;
        $data['category'] = 'Home';
        $data['parent_id'] = '0';
        
        /*
        TODO: Need to replace with recursive function that provides the full path back to 'home'
        instead of just the parent.
        */
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
        $this->load->model('Forum_model');
        $data['thread'] = $this->Forum_model->get_thread($thread);
        $data['category'] = $this->Forum_model->get_category($data['thread']->category);
        $data['posts'] = $this->Forum_model->get_posts($thread, 0);
        $data['thread_id'] = $thread;
        $this->load->view('header');
        $this->load->view('thread', $data);
        $this->load->view('footer');
    }
    
    public function post($thread) {
        $this->load->model('Forum_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('newPostText', 'Post Text', 'required|min_length[1]|xss_clean');
        
        if ($this->form_validation->run() === FALSE) {
            
        } else {
            $text = $this->input->post('newPostText');
            $author = 'n/a';
            $this->Forum_model->new_post($thread, $author, $text);
        }
        redirect('/forum/thread/'.$thread);
        
    }
}

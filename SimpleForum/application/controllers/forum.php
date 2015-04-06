<?php
error_reporting(-1);
ini_set('display_errors', 'On');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
    public function __contruct() {
        parent::__construct();
        // Load model for access to the database, namely categories and threads.
        
    }
    
    public function index() {
        // Useless home page. Could be used for news or something.
        // Uncomment below to just redirect to the home category.
        //redirect('/forum/category/0');
        $this->load->library('session');
        
        // Render the page.
        $this->header();
        $this->load->view('home');
        $this->load->view('footer');
    }
    
    public function category($category_id = '-1', $page = 0) {
        // View a category.
        $this->load->model('Forum_model');
        $this->load->library('session');
        
        // Avoids the URLs generated in the HTML from leading to the wrong locations.
        // Redirects to the home category.
        if ($category_id == '-1') { redirect('/forum/category/0'); }
        
        // Get the current category data from the database.
        $category = $this->Forum_model->get_category($category_id);
        
        
        // Default data for viewing a category.
        $data['category'] = 'Home';
        $data['parent_id'] = '0';
        $data['parent'] = 'Home';
        $data['category_id'] = $category_id;
        $data['required_type'] = $this->require_type(3);
        
        /*
        TODO: Need to replace with recursive function that provides the full path back to 'home'
        instead of just the parent.
        */
        // Gets the parent directory.
        if ($category) {
            $data['category'] = $category->name;
            $parent = $this->Forum_model->get_category($category->parent);
            if ($parent) {
                $data['parent_id'] = $parent->id;
                $data['parent'] = $parent->name;
            }
        }
        
        // Get list of categories and threads to be displayed.
        $data['categories'] = $this->Forum_model->get_categories($category_id);
        $data['threads'] = $this->Forum_model->get_threads($category_id, $page);
        
        // Render the page.
        $this->header();
        $this->load->view('category', $data);
        $this->load->view('footer');
    }
    
    public function create($category) {
        // Create a thread.
        $this->load->model('Forum_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        
        // Must be a member to create threads.
        if (!$this->require_type(3)) {
            redirect('/forum/category/'.$category);
        }
        
        // Validate data entered into the form.
        $this->form_validation->set_rules('newPostTitle', 'Post Title', 'required|min_length[1]|xss_clean');
        $this->form_validation->set_rules('newPostText', 'Post Text', 'required|min_length[1]|xss_clean');
        
        // If it doesn't pass validation, do something. TODO: Should include error message as to why.
        if ($this->form_validation->run() === FALSE) {
            
        } else {
        // If it does pass validation, add it to the thread.
            $author = $this->session->userdata('username');
            $title = $this->input->post('newPostTitle');
            
            $thread = $this->Forum_model->new_thread($category, $author, $title);
            $text = $this->input->post('newPostText');
            $this->Forum_model->new_post($thread->id, $author, $text);
        }
        // Refresh the most recent document.
        if ($thread) {
            redirect('/forum/thread/'.$thread->id);
        }
    }
    
    public function thread($thread, $page=0) {
        // View a thread
        $this->load->model('Forum_model');
        $this->load->library('session');
        
        // Get the thread data, for thread title.
        // Get category data for navigation back to category.
        // Get posts to be rendered.
        $data['thread'] = $this->Forum_model->get_thread($thread);
        $data['category'] = $this->Forum_model->get_category($data['thread']->category);
        $data['posts'] = $this->Forum_model->get_posts($thread, $page);
        $data['thread_id'] = $thread;
        $data['required_type'] = $this->require_type(3);
        
        // Render the page.
        $this->header();
        $this->load->view('thread', $data);
        $this->load->view('footer');
    }
    
    public function post($thread) {
        // Create a post.
        $this->load->model('Forum_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        
        // Must be a Member to post.
        if (!$this->require_type(3)) {
            redirect('/forum/thread/'.$thread);
        }
        
        // Validate data entered into the form.
        $this->form_validation->set_rules('newPostText', 'Post Text', 'required|min_length[1]|xss_clean');
        
        // If it doesn't pass validation, do something. TODO: Should include error message as to why.
        if ($this->form_validation->run() === FALSE) {
            
        } else {
        // If it does pass validation, add it to the thread.
            $text = $this->input->post('newPostText');
            $author = $this->session->userdata('username');
            $this->Forum_model->new_post($thread, $author, $text);
        }
        // Refresh the most recent document.
        redirect('/forum/thread/'.$thread);
    }
    
    private function header() {
        // Render the header. Menu items, account, etc.
        $logged_in = $this->session->userdata('logged_in');
        
        $url = base_url().'index.php/';
        if ($logged_in) {
            $data['menu'] = array(
                'Home' => $url.'forum/category/0',
                'Account' => $url.'account',
                'Logout' => $url.'auth/logout'
            );
        } else {
            $data['menu'] = array(
                'Home' => $url.'forum/category/0',
                'Login' => $url.'auth/login'
            );
        }
            
        $this->load->view('header', $data);
    }
    
    private function require_type($required) {
        // Check if the user has the required access level.
        $logged_in = $this->session->userdata('logged_in');
        if (!$logged_in) {
            return FALSE;
        } else if ($logged_in <= $required) {
            return TRUE;
        }
        return FALSE;
    }
    
}

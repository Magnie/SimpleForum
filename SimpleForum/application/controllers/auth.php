<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __contruct() {
        parent::__construct();
    }
    
    public function login() {
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
    }
    
    public function submit() {
        $this->load->model('Forum_model');
        $this->load->library('form_validation');
        
        // Validate data entered into the form.
        $this->form_validation->set_rules('userEmail', 'User Email', 'required|xss_clean');
        $this->form_validation->set_rules('userPass', 'User Password', 'required|xss_clean');
        
        // If it doesn't pass validation, do something. TODO: Should include error message as to why.
        if ($this->form_validation->run() === FALSE) {
            redirect('/auth/login');
        } else {
        // If it does pass validation, add it to the thread.
            $userEmail = $this->input->post('userEmail');
            $userPass = $this->input->post('userPass');
            
            $account = $this->Forum_model->check_login($userEmail, $userPass);
            
            if ($account) {
                // Login successful.
                $this->load->library('session');
                $data = array(
                    'logged_in' => $account->type,
                    'id' => $account->id,
                    'username' => $account->display
                );
                $this->session->set_userdata($data);
                
                redirect('/forum/category');
            } else {
                // Login failure.
                redirect('/auth/login');
            }
        }
    }
    
    public function register() {
        $this->load->view('header');
        $this->load->view('register');
        $this->load->view('footer');
    }
    
    public function create() {
        $this->load->model('Forum_model');
        $this->load->library('form_validation');
        
        // Validate data entered into the form.
        $this->form_validation->set_rules('userEmail', 'User Email', 'required|xss_clean');
        $this->form_validation->set_rules('userPass', 'User Password', 'required|xss_clean');
        $this->form_validation->set_rules('userName', 'Display Name', 'required|xss_clean');
        
        // If it doesn't pass validation, do something. TODO: Should include error message as to why.
        if ($this->form_validation->run() === FALSE) {
            redirect('/auth/register');
        } else {
        // If it does pass validation, add it to the thread.
            $userEmail = $this->input->post('userEmail');
            $userPass = $this->input->post('userPass');
            $userName = $this->input->post('userName');
            
            $account = $this->Forum_model->create_login($userEmail, $userPass, $userName);
            
            if ($account) {
                // Register successful.
                redirect('/auth/login');
            } else {
                // Register failure.
                redirect('/auth/register');
            }
            
        }
    }
    
    public function logout() {
    	$this->load->library('session');
    	$this->session->sess_destroy();
    	redirect('/forum/category/0');
    }
}

?>

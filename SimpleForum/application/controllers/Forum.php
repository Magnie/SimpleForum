<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
    public function index() {
        //$this->load->view('header.php');
        //$this->load->view('home');
        //$this->load->view('footer');
        echo 'test';
    }
    
    public function category($category = 'home') {
        $this->load->model('ForumModel');
        
        $this->load->view('header.php');
    }
    
    public function thread($thread) {
    
    }
}

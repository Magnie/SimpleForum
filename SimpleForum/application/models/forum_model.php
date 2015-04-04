<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_category($category) {
        $limit = 1;
        $query = $this->db->get_where('sf_categories', array('id' => $category), $limit)->result();
        if (!$query) {
            $query = array(null);
        }
        return $query[0];
    }
    
    public function get_categories($parent = 'home') {
        $limit = 128;
        $offset = 0;
        $query = $this->db->get_where('sf_categories', array('parent' => $parent), $limit, $offset);
        return $query->result();
    }
    
    public function get_thread($thread) {
        $limit = 1;
        $query = $this->db->get_where('sf_topics', array('id' => $thread), $limit)->result();
        if (!$query) {
            $query = array(null);
        }
        return $query[0];
    }
    
    public function get_threads($category, $page) {
        $limit = 20;
        $offset = $page * $limit;
        $query = $this->db->get_where('sf_topics', array('category' => $category), $limit, $offset);
        return $query->result();
    }
    
    public function get_posts($thread, $page) {
        $limit = 40;
        $offset = $page * $limit;
        $query = $this->db->get_where('sf_posts', array('topic' => $thread), $limit, $offset);
        return $query->result();
    }
    
    public function new_post($thread, $author, $text) {
        $data = array(
            'topic' => $thread,
            'author' => $author,
            'post' => $text
        );
        $this->db->insert('sf_posts', $data);
    }
}

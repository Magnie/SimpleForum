<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_category($category) {
        // Get category information from the database.
        $limit = 1;
        $query = $this->db->get_where('sf_categories', array('id' => $category), $limit)->result();
        if (!$query) {
            $query = array(null);
        }
        return $query[0];
    }
    
    public function get_categories($parent = 'home') {
        // Get a list of categories based on the parent.
        $limit = 128;
        $offset = 0;
        $query = $this->db->get_where('sf_categories', array('parent' => $parent), $limit, $offset);
        return $query->result();
    }
    
    public function get_thread($thread) {
        // Get a thread.
        $limit = 1;
        $query = $this->db->get_where('sf_topics', array('id' => $thread), $limit)->result();
        if (!$query) {
            $query = array(null);
        }
        return $query[0];
    }
    
    public function get_threads($category, $page) {
        // Get a list of threads based on the category.
        $limit = 20;
        $offset = $page * $limit;
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where('sf_topics', array('category' => $category), $limit, $offset);
        
        return $query->result();
    }
    
    public function new_thread($category, $author, $title) {
        // Insert a new post into the database.
        $data = array(
            'category' => $category,
            'author' => $author,
            'title' => $title
        );
        $query = $this->db->insert('sf_topics', $data);
        $query = $this->get_threads($category, 0)[0];
        return $query;
    }
    
    public function get_posts($thread, $page) {
        // Get a list of posts based on the thread.
        $limit = 40;
        $offset = $page * $limit;
        $query = $this->db->get_where('sf_posts', array('topic' => $thread), $limit, $offset);
        return $query->result();
    }
    
    public function new_post($thread, $author, $text) {
        // Insert a new post into the database.
        $data = array(
            'topic' => $thread,
            'author' => $author,
            'post' => $text
        );
        $this->db->insert('sf_posts', $data);
    }
}

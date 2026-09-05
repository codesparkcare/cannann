<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

    public function get_published_blogs($limit = null) {
        $this->db->where('status', 'published');
        $this->db->order_by('id', 'DESC');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get('blogs');
        return $query->result_array();
    }

    public function get_all_blogs() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('blogs');
        return $query->result_array();
    }

    public function get_blog_by_slug($slug) {
        $this->db->where('slug', $slug);
        $this->db->where('status', 'published');
        $query = $this->db->get('blogs');
        $result = $query->row_array();
        if ($result) {
            // increment view count
            $this->db->where('id', $result['id']);
            $this->db->set('views_count', 'views_count+1', FALSE);
            $this->db->update('blogs');
        }
        return $result;
    }

    public function get_blog($id) {
        return $this->db->get_where('blogs', array('id' => $id))->row_array();
    }

    public function get_recent_blogs($exclude_id = null, $limit = 3) {
        $this->db->where('status', 'published');
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('blogs');
        return $query->result_array();
    }

    public function add_blog($data) {
        return $this->db->insert('blogs', $data);
    }

    public function update_blog($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('blogs', $data);
    }

    public function delete_blog($id) {
        $this->db->where('id', $id);
        return $this->db->delete('blogs');
    }
}

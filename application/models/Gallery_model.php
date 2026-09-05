<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    public function get_active_gallery($category = null) {
        $this->db->where('status', 'active');
        if ($category && $category !== 'all') {
            $this->db->where('category', $category);
        }
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('gallery');
        return $query->result_array();
    }

    public function get_all_gallery() {
        $this->db->order_by('sort_order', 'ASC');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('gallery');
        return $query->result_array();
    }

    public function get_gallery_item($id) {
        return $this->db->get_where('gallery', array('id' => $id))->row_array();
    }

    public function add_gallery($data) {
        return $this->db->insert('gallery', $data);
    }

    public function update_gallery($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('gallery', $data);
    }

    public function delete_gallery($id) {
        $this->db->where('id', $id);
        return $this->db->delete('gallery');
    }
}

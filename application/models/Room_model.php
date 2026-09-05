<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room_model extends CI_Model {

    // Category Methods
    public function get_active_categories() {
        $this->db->where('status', 'active');
        $query = $this->db->get('room_categories');
        return $query->result_array();
    }

    public function get_all_categories() {
        $query = $this->db->get('room_categories');
        return $query->result_array();
    }

    public function get_category($id) {
        return $this->db->get_where('room_categories', array('id' => $id))->row_array();
    }

    public function add_category($data) {
        return $this->db->insert('room_categories', $data);
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('room_categories', $data);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('room_categories');
    }

    // Room Methods
    public function get_featured_rooms($limit = 6) {
        $this->db->select('rooms.*, room_categories.name as category_name');
        $this->db->from('rooms');
        $this->db->join('room_categories', 'room_categories.id = rooms.category_id', 'left');
        $this->db->where('rooms.status', 'available');
        $this->db->where('rooms.is_featured', 1);
        $this->db->order_by('rooms.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_rooms($category_id = null) {
        $this->db->select('rooms.*, room_categories.name as category_name');
        $this->db->from('rooms');
        $this->db->join('room_categories', 'room_categories.id = rooms.category_id', 'left');
        if ($category_id) {
            $this->db->where('rooms.category_id', $category_id);
        }
        $this->db->order_by('rooms.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_room_by_slug($slug) {
        $this->db->select('rooms.*, room_categories.name as category_name');
        $this->db->from('rooms');
        $this->db->join('room_categories', 'room_categories.id = rooms.category_id', 'left');
        $this->db->where('rooms.slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_room($id) {
        $this->db->select('rooms.*, room_categories.name as category_name');
        $this->db->from('rooms');
        $this->db->join('room_categories', 'room_categories.id = rooms.category_id', 'left');
        $this->db->where('rooms.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function add_room($data) {
        return $this->db->insert('rooms', $data);
    }

    public function update_room($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('rooms', $data);
    }

    public function delete_room($id) {
        $this->db->where('id', $id);
        return $this->db->delete('rooms');
    }

    public function get_related_rooms($category_id, $current_id, $limit = 3) {
        $this->db->select('rooms.*, room_categories.name as category_name');
        $this->db->from('rooms');
        $this->db->join('room_categories', 'room_categories.id = rooms.category_id', 'left');
        $this->db->where('rooms.id !=', $current_id);
        $this->db->where('rooms.status', 'available');
        $this->db->order_by('rooms.id', 'RANDOM');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}

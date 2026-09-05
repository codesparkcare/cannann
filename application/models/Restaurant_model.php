<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_model extends CI_Model {

    // Category Methods
    public function get_active_categories() {
        $this->db->where('status', 'active');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get('restaurant_categories');
        return $query->result_array();
    }

    public function get_all_categories() {
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get('restaurant_categories');
        return $query->result_array();
    }

    public function get_category($id) {
        return $this->db->get_where('restaurant_categories', array('id' => $id))->row_array();
    }

    public function add_category($data) {
        return $this->db->insert('restaurant_categories', $data);
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('restaurant_categories', $data);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('restaurant_categories');
    }

    // Items Methods
    public function get_all_items($category_id = null) {
        $this->db->select('restaurant_items.*, restaurant_categories.name as category_name');
        $this->db->from('restaurant_items');
        $this->db->join('restaurant_categories', 'restaurant_categories.id = restaurant_items.category_id', 'left');
        if ($category_id) {
            $this->db->where('restaurant_items.category_id', $category_id);
        }
        $this->db->order_by('restaurant_items.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_special_items($limit = 6) {
        $this->db->select('restaurant_items.*, restaurant_categories.name as category_name');
        $this->db->from('restaurant_items');
        $this->db->join('restaurant_categories', 'restaurant_categories.id = restaurant_items.category_id', 'left');
        $this->db->where('restaurant_items.status', 'active');
        $this->db->where('restaurant_items.is_special', 1);
        $this->db->order_by('restaurant_items.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_item($id) {
        $this->db->select('restaurant_items.*, restaurant_categories.name as category_name');
        $this->db->from('restaurant_items');
        $this->db->join('restaurant_categories', 'restaurant_categories.id = restaurant_items.category_id', 'left');
        $this->db->where('restaurant_items.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function add_item($data) {
        return $this->db->insert('restaurant_items', $data);
    }

    public function update_item($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('restaurant_items', $data);
    }

    public function delete_item($id) {
        $this->db->where('id', $id);
        return $this->db->delete('restaurant_items');
    }

    // Table Reservations
    public function add_reservation($data) {
        return $this->db->insert('table_reservations', $data);
    }

    public function get_all_reservations() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('table_reservations');
        return $query->result_array();
    }

    public function update_reservation_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('table_reservations', array('status' => $status));
    }

    public function delete_reservation($id) {
        $this->db->where('id', $id);
        return $this->db->delete('table_reservations');
    }
}

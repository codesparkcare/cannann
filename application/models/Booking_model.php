<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function create_booking($data) {
        $this->db->insert('bookings', $data);
        return $this->db->insert_id();
    }

    public function get_all_bookings() {
        $this->db->select('bookings.*, rooms.title as room_title, room_categories.name as category_name');
        $this->db->from('bookings');
        $this->db->join('rooms', 'rooms.id = bookings.room_id', 'left');
        $this->db->join('room_categories', 'room_categories.id = bookings.room_category_id', 'left');
        $this->db->order_by('bookings.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_booking($id) {
        $this->db->select('bookings.*, rooms.title as room_title, room_categories.name as category_name');
        $this->db->from('bookings');
        $this->db->join('rooms', 'rooms.id = bookings.room_id', 'left');
        $this->db->join('room_categories', 'room_categories.id = bookings.room_category_id', 'left');
        $this->db->where('bookings.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('bookings', array('status' => $status));
    }

    public function delete_booking($id) {
        $this->db->where('id', $id);
        return $this->db->delete('bookings');
    }
}

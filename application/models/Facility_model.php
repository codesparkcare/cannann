<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facility_model extends CI_Model {

    public function get_active_facilities() {
        $this->db->where('status', 'active');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get('facilities');
        return $query->result_array();
    }

    public function get_all_facilities() {
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get('facilities');
        return $query->result_array();
    }

    public function get_facility($id) {
        return $this->db->get_where('facilities', array('id' => $id))->row_array();
    }

    public function add_facility($data) {
        return $this->db->insert('facilities', $data);
    }

    public function update_facility($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('facilities', $data);
    }

    public function delete_facility($id) {
        $this->db->where('id', $id);
        return $this->db->delete('facilities');
    }
}

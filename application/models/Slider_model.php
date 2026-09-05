<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {

    public function get_active_sliders() {
        $this->db->where('status', 'active');
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get('sliders');
        return $query->result_array();
    }

    public function get_all_sliders() {
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get('sliders');
        return $query->result_array();
    }

    public function get_slider($id) {
        return $this->db->get_where('sliders', array('id' => $id))->row_array();
    }

    public function add_slider($data) {
        return $this->db->insert('sliders', $data);
    }

    public function update_slider($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('sliders', $data);
    }

    public function delete_slider($id) {
        $this->db->where('id', $id);
        return $this->db->delete('sliders');
    }
}

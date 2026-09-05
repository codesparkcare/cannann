<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial_model extends CI_Model {

    public function get_active_testimonials() {
        $this->db->where('status', 'active');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('testimonials');
        return $query->result_array();
    }

    public function get_all_testimonials() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('testimonials');
        return $query->result_array();
    }

    public function get_testimonial($id) {
        return $this->db->get_where('testimonials', array('id' => $id))->row_array();
    }

    public function add_testimonial($data) {
        return $this->db->insert('testimonials', $data);
    }

    public function update_testimonial($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('testimonials', $data);
    }

    public function delete_testimonial($id) {
        $this->db->where('id', $id);
        return $this->db->delete('testimonials');
    }
}

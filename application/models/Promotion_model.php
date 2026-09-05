<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion_model extends CI_Model {

    public function get_active_promotions() {
        $this->db->where('status', 'active');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('promotions');
        return $query->result_array();
    }

    public function get_all_promotions() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('promotions');
        return $query->result_array();
    }

    public function get_promotion($id) {
        return $this->db->get_where('promotions', array('id' => $id))->row_array();
    }

    public function add_promotion($data) {
        return $this->db->insert('promotions', $data);
    }

    public function update_promotion($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('promotions', $data);
    }

    public function delete_promotion($id) {
        $this->db->where('id', $id);
        return $this->db->delete('promotions');
    }
}

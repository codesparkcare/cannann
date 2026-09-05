<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    public function add_contact($data) {
        return $this->db->insert('contacts', $data);
    }

    public function get_all_contacts() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('contacts');
        return $query->result_array();
    }

    public function get_contact($id) {
        return $this->db->get_where('contacts', array('id' => $id))->row_array();
    }

    public function update_status($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('contacts', array('status' => $status));
    }

    public function delete_contact($id) {
        $this->db->where('id', $id);
        return $this->db->delete('contacts');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function get_settings() {
        $query = $this->db->get('site_settings');
        return $query->row_array();
    }

    public function update_settings($data) {
        $this->db->where('id', 1);
        return $this->db->update('site_settings', $data);
    }
}

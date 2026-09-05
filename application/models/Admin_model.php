<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->ensure_admin_table();
    }

    /**
     * Ensure admin_users table exists and has a default account
     */
    private function ensure_admin_table() {
        if (!$this->db->table_exists('admin_users')) {
            $this->load->dbforge();
            $fields = array(
                'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
                'username' => array('type' => 'VARCHAR', 'constraint' => '100', 'unique' => TRUE),
                'email' => array('type' => 'VARCHAR', 'constraint' => '150', 'unique' => TRUE),
                'password' => array('type' => 'VARCHAR', 'constraint' => '255'),
                'name' => array('type' => 'VARCHAR', 'constraint' => '150', 'default' => 'Admin Manager'),
                'role' => array('type' => 'VARCHAR', 'constraint' => '50', 'default' => 'superadmin'),
                'status' => array('type' => 'VARCHAR', 'constraint' => '20', 'default' => 'active'),
                'last_login' => array('type' => 'DATETIME', 'null' => TRUE),
                'created_at' => array('type' => 'DATETIME', 'null' => TRUE),
                'updated_at' => array('type' => 'DATETIME', 'null' => TRUE)
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('admin_users', TRUE);
        }

        // Seed default admin if empty
        $count = $this->db->count_all('admin_users');
        if ($count === 0) {
            $this->db->insert('admin_users', array(
                'username'   => 'admin',
                'email'      => 'admin@hotelcanaann.com',
                'password'   => password_hash('Admin@123', PASSWORD_BCRYPT),
                'name'       => 'Hotel General Manager',
                'role'       => 'superadmin',
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));
        }
    }

    /**
     * Authenticate by username or email
     */
    public function authenticate($login_identity, $password) {
        $this->db->group_start();
        $this->db->where('username', $login_identity);
        $this->db->or_where('email', $login_identity);
        $this->db->group_end();
        $this->db->where('status', 'active');
        $query = $this->db->get('admin_users');
        $user = $query->row_array();

        if ($user) {
            // Verify BCrypt hash
            if (password_verify($password, $user['password'])) {
                $this->update_last_login($user['id']);
                return $user;
            }
            // Fallback for plain text or legacy MD5 if ever imported
            if ($user['password'] === $password || $user['password'] === md5($password)) {
                // Auto rehash to modern bcrypt
                $this->update_password($user['id'], $password);
                $this->update_last_login($user['id']);
                return $user;
            }
        }
        return false;
    }

    public function get_user_by_id($id) {
        $query = $this->db->get_where('admin_users', array('id' => $id));
        return $query->row_array();
    }

    public function update_profile($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('admin_users', $data);
    }

    public function update_password($id, $new_password) {
        $hash = password_hash($new_password, PASSWORD_BCRYPT);
        $this->db->where('id', $id);
        return $this->db->update('admin_users', array(
            'password'   => $hash,
            'updated_at' => date('Y-m-d H:i:s')
        ));
    }

    public function update_last_login($id) {
        $this->db->where('id', $id);
        return $this->db->update('admin_users', array(
            'last_login' => date('Y-m-d H:i:s')
        ));
    }
}

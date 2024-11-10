<?php
class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row(); 
    }

    public function update_user($email, $data) {
        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }
}
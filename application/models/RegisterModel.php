<?php
class RegisterModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_user($data) {
        if (!$this->db->insert('users', $data)) {
            throw new Exception('Database error: ' . $this->db->error()['message']);
        }
        return true;
    }
}
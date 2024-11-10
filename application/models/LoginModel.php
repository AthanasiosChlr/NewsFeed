<?php
class LoginModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check_user($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row();
    }
}

<?php
class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row();
    }

    //User Registration
    public function insert_user($data) {
        if (!$this->db->insert('users', $data)) {
            throw new Exception('Database error: ' . $this->db->error()['message']);
        }
        return true;
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function update_user_by_id($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function update_user($email, $data) {
        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }

    public function update_password($email, $password) {
        $data = array(
            'password' => $password,
            'reset_token' => null,
            'token_expiry' => null
        );
        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }

    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function store_reset_token($email, $token)
    {
        $data = array(
            'reset_token' => $token,
            'token_expiry' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        );
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }

    public function get_user_by_token($token)
    {
        $this->db->where('reset_token', $token);
        $this->db->where('token_expiry >', date('Y-m-d H:i:s'));
        return $this->db->get('users')->row();
    }
}
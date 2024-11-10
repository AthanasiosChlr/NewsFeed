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

    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}
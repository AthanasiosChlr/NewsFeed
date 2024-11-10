<?php
class MessagesModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function send_message($data)
    {
        return $this->db->insert('messages', $data);
    }

    public function get_messages_by_recipient($email)
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->where('recipient_email', $email);
        $query = $this->db->get('messages');
        return $query->result();
    }

    public function get_messages_by_sender($email)
    {
        $this->db->where('sender_email', $email);
        $query = $this->db->get('messages');
        return $query->result();
    }

    public function delete_message($message_id)
    {
        $this->db->where('id', $message_id);
        return $this->db->delete('messages');
    }
}

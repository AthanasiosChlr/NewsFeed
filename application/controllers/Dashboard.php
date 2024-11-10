<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('session');
    $this->load->database();
    $this->load->model('UserModel');
    $this->load->model('MessagesModel');
  }

  public function index()
  {
    $email = $this->session->userdata('email');
    $user = $this->UserModel->get_user_by_email($email);

    $data['content'] = 'pages/dashboard';

    if ($user) {
      $data['user'] = $user;
      $this->load->view('templates/main_template', $data);
    } else {
      $this->session->set_flashdata('error', 'User not found');
      redirect('');
    }
  }

  public function update_profile()
  {
    $email = $this->session->userdata('email');
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $new_email = $this->input->post('email');
    $password = $this->input->post('password');

    $data = array();

    if (!empty($first_name)) {
      $data['first_name'] = $first_name;
    }

    if (!empty($last_name)) {
      $data['last_name'] = $last_name;
    }

    if (!empty($new_email)) {
      $data['email'] = $new_email;
    }

    if (!empty($password)) {
      $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($data)) {
      if ($this->UserModel->update_user($email, $data)) {
        $updated_user = $this->UserModel->get_user_by_email($new_email ? $new_email : $email);
        $this->session->set_userdata('user', $updated_user);
        if (isset($data['email'])) {
          $this->session->set_userdata('email', $data['email']);
        }
        $this->session->set_flashdata('success', 'Profile updated successfully');
        redirect('dashboard');
      } else {
        $this->session->set_flashdata('error', 'Profile update failed');
        redirect('dashboard');
      }
    } else {
      $this->session->set_flashdata('error', 'No changes to update');
      redirect('dashboard');
    }
  }

  public function messages()
  {
    $email = $this->session->userdata('email');
    $user = $this->UserModel->get_user_by_email($email);
    $user = $this->session->userdata('user');
    if (!$user) {
      redirect('');
    }

    $data['user'] = $user;
    $data['messages'] = $this->MessagesModel->get_messages_by_recipient($user->email);

    $data['content'] = 'pages/messages';
    $this->load->view('templates/main_template', $data);
  }

  public function send_message()
  {
    $user = $this->session->userdata('user');
    if (!$user) {
      redirect('');
    }

    $data['user'] = $user;
    $data['content'] = 'pages/send_message';
    $this->load->view('templates/main_template', $data);
  }

  public function submit_message()
  {
    $email = $this->input->post('email');
    $message = $this->input->post('message');

    $user = $this->UserModel->get_user_by_email($email);

    if (!$user && !$admin) {
      $this->session->set_flashdata('error', 'Recipient not found');
      redirect('user_send_message_page');
    }

    $recipient = $user ? $user : $admin;

    $data = array(
      'recipient_email' => $email,
      'first_name' => $recipient->first_name,
      'last_name' => $recipient->last_name,
      'message' => $message,
      'sender_email' => $this->session->userdata('email')
    );

    if ($this->MessagesModel->send_message($data)) {
      $this->session->set_flashdata('success', 'Message sent successfully');
    } else {
      $this->session->set_flashdata('error', 'Failed to send message');
    }
    redirect('send_message');
  }

  public function delete_message()
  {
    $message_id = $this->input->post('message_id');

    if ($this->MessagesModel->delete_message($message_id)) {
      $this->session->set_flashdata('success', 'Message deleted successfully.');
    } else {
      $this->session->set_flashdata('error', 'Failed to delete the message.');
    }

    redirect(base_url('/messages'));
  }
}

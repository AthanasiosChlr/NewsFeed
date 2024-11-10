<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('session');
    $this->load->database();
    $this->load->model('UserModel');
    $this->load->model('MessagesModel');
    $this->load->model('LoginModel');
  }

  public function login() {
    $data['content'] = 'pages/admin_login'; 
    $this->load->view('templates/main_template', $data);
  }

  public function admin_login() {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $user = $this->LoginModel->check_user($email);

    if ($user && password_verify($password, $user->password)&& $user->role == 'admin') {
        $this->session->set_userdata('email', $email);
        $this->session->set_userdata('user', $user);
        redirect('/');
    } else {
        $this->session->set_flashdata('error', 'Wrong Credentials');
        redirect('/admin');
    }
}

  public function customers() {
    $user = $this->session->userdata('user'); 
    $data['user'] = $user;
    $customers = $this->UserModel->get_all_users();
    $data['customers'] = $customers;

    $data['content'] = 'pages/customers'; 
    $this->load->view('templates/main_template', $data);
  }

  public function view_user_messages($user_id) {
    $user = $this->session->userdata('user'); 
    if (!$user || $user->role != 'admin') {
      $this->session->set_flashdata('error', 'Access denied');
      redirect('admin');
    }

    $viewed_user = $this->UserModel->get_user_by_id($user_id);
    if (!$viewed_user) {
      $this->session->set_flashdata('error', 'User not found');
      redirect('customers');
    }

    $messages = $this->MessagesModel->get_messages_by_sender($viewed_user->email);

    usort($messages, function($a, $b) {
      return strtotime($b->created_at) - strtotime($a->created_at);
    });

    $data['messages'] = $messages;
    $data['user'] = $user; 

    $data['content'] = 'pages/view_user_messages'; 
    $this->load->view('templates/main_template', $data);
}

  public function update_customer($id) {
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $data = array();

    if (!empty($first_name)) {
      $data['first_name'] = $first_name;
    }

    if (!empty($last_name)) {
      $data['last_name'] = $last_name;
    }

    if (!empty($email)) {
      $data['email'] = $email;
    }

    if (!empty($password)) {
      $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    if (!empty($data)) {
      if ($this->UserModel->update_user_by_id($id, $data)) {
        $this->session->set_flashdata('success', 'Customer updated successfully');
      } else {
        $this->session->set_flashdata('error', 'Failed to update customer');
      }
    } else {
      $this->session->set_flashdata('error', 'No changes to update');
    }
    redirect('customers');
  }

  public function delete_customer($id) {
    if ($this->UserModel->delete_user($id)) {
      $this->session->set_flashdata('success', 'Customer deleted successfully');
    } else {
      $this->session->set_flashdata('error', 'Failed to delete customer');
    }
    redirect('customers');
  }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library(array('session', 'form_validation'));
    $this->load->database();
    $this->load->model('UserModel');
    $this->load->model('MessagesModel');
  }

  public function showLogin() {
    $data['content'] = 'pages/admin_login'; 
    $this->load->view('templates/main_template', $data);
  }

  // Verify user login credentials
  public function processLogin() {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', validation_errors());
      redirect('admin');
      return;
    }

    // Retrieve email and password from POST data
    $email = $this->input->post('email', TRUE);
    $password = $this->input->post('password', TRUE);

    // Check if user exists in the database
    $user = $this->UserModel->get_user_by_email($email);

    // Verify password and set session data if valid
    if ($user && password_verify($password, $user->password)) {
      // Check if the user is an admin
      if ($user->role === 'admin') {
        // Store user data in session
        $this->session->set_userdata('email', $email);
        $this->session->set_userdata('user', $user);
        redirect('dashboard');
      } else {
        $this->session->set_flashdata('error', 'You do not have admin privileges');
        redirect('admin');
      }
    } else {
      $this->session->set_flashdata('error', 'Invalid email or password');
      redirect('admin');
    }
  }


  public function customers() {
    $user = $this->session->userdata('user'); 
    if (!$user || $user->role != 'admin') {
      $this->session->set_flashdata('error', 'Access denied');
      redirect('admin');
    }

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
    $user = $this->session->userdata('user'); 
    if (!$user || $user->role != 'admin') {
      $this->session->set_flashdata('error', 'Access denied');
      redirect('admin');
    }

    if ($this->UserModel->delete_user($id)) {
      $this->session->set_flashdata('success', 'Customer deleted successfully');
    } else {
      $this->session->set_flashdata('error', 'Failed to delete customer');
    }
    redirect('customers');
  }
}
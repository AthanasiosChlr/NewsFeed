<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('session');
    $this->load->database();
    $this->load->model('LoginModel');
    $this->load->model('UserModel');
    $this->load->model('RegisterModel');
    $this->load->model('NewsModel');
  }

  public function index()
  {
    $email = $this->session->userdata('email');
    $user = $this->session->userdata('user');

    if ($email) {
      $user = $this->UserModel->get_user_by_email($email);
    }

    $news = $this->NewsModel->get_latest_news();

    $data['user'] = $user;
    $data['news'] = $news;

    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function verify()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $user = $this->LoginModel->check_user($email);

    if ($user && password_verify($password, $user->password)) {
      $this->session->set_userdata('email', $email);
      $this->session->set_userdata('user', $user);
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'message' => 'Wrong Credentials']);
    }
  }

  public function register_user()
  {
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $retype_password = $this->input->post('retype_password');

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($retype_password)) {
      $response = array('success' => false, 'message' => 'All fields are required');
      echo json_encode($response);
      return;
    }

    if ($password !== $retype_password) {
      $response = array('success' => false, 'message' => 'Passwords do not match');
      echo json_encode($response);
      return;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $data = array(
      'first_name' => $first_name,
      'last_name' => $last_name,
      'email' => $email,
      'password' => $hashed_password
    );

    try {
      if ($this->RegisterModel->insert_user($data)) {
        $response = array('success' => true, 'message' => 'Registration successful');
      } else {
        $response = array('success' => false, 'message' => 'Registration failed');
      }
    } catch (Exception $e) {
      $db_error = $this->db->error();
      if (isset($db_error['code']) && $db_error['code'] == 1062) {
        $response = array('success' => false, 'message' => 'Email already exists');
      } else {
        $response = array('success' => false, 'message' => 'An error occurred. Please try again.');
      }
    }

    echo json_encode($response);
  }

  public function check_email_exists()
  {
    $email = $this->input->post('email');
    $exists = $this->UserModel->email_exists($email);
    echo json_encode(['exists' => $exists]);
  }
  public function get_user_details()
  {
    $email = $this->session->userdata('email');
    if ($email) {
      $user = $this->UserModel->get_user_by_email($email);
      echo json_encode(['success' => true, 'user' => $user]);
    } else {
      echo json_encode(['success' => false, 'message' => 'User not logged in']);
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('user');
    $this->session->sess_destroy();
    redirect('/');
  }

  public function error_404()
  {
    $this->output->set_status_header('404');
    $data['content'] = 'pages/error_404';
    $this->load->view('templates/main_template', $data);
  }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
        $this->load->model('UserModel');
        $this->load->model('NewsModel');
    }

    // Homepage load method
    public function index()
    {
        // Get the current user from the session
        $user = $this->session->userdata('user');
        $data['email'] = $this->session->userdata('email');
        $data['user'] = $user;

        // Fetch the latest news from NewsModel
        $news = $this->NewsModel->get_latest_news();
        $data['news'] = $news;

        // Set the content view to the homepage
        $data['content'] = 'pages/homepage';

        // Load the main template view with the data
        $this->load->view('templates/main_template', $data);
    }

    // Verify user login credentials
    public function processLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
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
                echo json_encode(['success' => false, 'message' => 'Only users can log in']);
                return;
            }

            // Store user data in session
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('user', $user);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Wrong Credentials']);
        }
    }

    public function register_user()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            return;
        }

        // Retrieve form data from POST
        $first_name = $this->input->post('first_name', TRUE);
        $last_name = $this->input->post('last_name', TRUE);
        $email = $this->input->post('email', TRUE);
        $password = password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT);

        $user_data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password
        ];

        // Insert user data into the database
        if ($this->UserModel->insert_user($user_data)) {
            echo json_encode(['success' => true, 'message' => 'User registered successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to register user']);
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

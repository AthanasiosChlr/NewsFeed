<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasswordResetController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->model('UserModel');
    }

    public function request_password_reset()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $response = array('success' => false, 'message' => validation_errors());
        } else {
            $email = $this->input->post('email');

            $user = $this->UserModel->get_user_by_email($email);

            if ($user) {
                $token = bin2hex(random_bytes(50));

                $this->UserModel->store_reset_token($email, $token);

                $reset_link = base_url('reset_password/' . $token);
                $message = "<html><head></head><body><p>Hello NewsFeed User,</p><p>Click the following link to reset your password: <a href='$reset_link'>$reset_link</a></p></body></html>";

                $this->email->from('athanasios.chlr@gmail.com', 'NewsFeed');
                $this->email->to($email);
                $this->email->subject('Password Reset');
                $this->email->message($message);

                $this->email->send();
                $response = array('success' => true, 'message' => 'Password reset email sent successfully.');
            }
        }

        echo json_encode($response);
    }

    public function reset_password($token)
    {
        $user = $this->UserModel->get_user_by_token($token);

        if ($user) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $data['token'] = $token;
                $data['content'] = 'pages/reset_password';
                $this->load->view('templates/main_template', $data);
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                if ($this->UserModel->update_password($user->email, $password)) {
                    $this->session->set_flashdata('message', 'Password has been reset successfully.');
                    redirect('');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update the password. Please try again.');
                    redirect('reset_password/' . $token);
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired token.');
            redirect('');
        }
    }
}
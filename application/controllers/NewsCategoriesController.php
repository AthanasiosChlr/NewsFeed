<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewsCategoriesController extends CI_Controller
{
    private $api_key;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->database();
        $this->load->model('UserModel');
        $this->load->model('NewsModel');
    }

    private function load_news_view($category = null, $query = null)
    {
        $user = $this->session->userdata('user');
        $data['news'] = $this->NewsModel->get_latest_news($category, $query);
        $data['user'] = $user;
        $data['content'] = 'pages/homepage';
        $this->load->view('templates/main_template', $data);
    }

    public function technology()
    {
        $this->load_news_view('technology');
    }

    public function business()
    {
        $this->load_news_view('business');
    }

    public function entertainment()
    {
        $this->load_news_view('entertainment');
    }

    public function science()
    {
        $this->load_news_view('science');
    }

    public function health()
    {
        $this->load_news_view('health');
    }

    public function lifestyle()
    {
        $this->load_news_view('lifestyle');
    }

    public function food()
    {
        $this->load_news_view('food');
    }

    public function education()
    {
        $this->load_news_view('education');
    }

    public function sports()
    {
        $this->load_news_view('sports');
    }

    public function tourism()
    {
        $this->load_news_view('tourism');
    }

    public function politics()
    {
        $this->load_news_view('politics');
    }

    public function search()
    {
        // Get the search query from the GET parameters
        $query = $this->input->get('query');
        $this->load_news_view(null, $query);
    }
}

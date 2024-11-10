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
    $this->load->model('LoginModel');
    $this->load->model('UserModel');
    $this->load->model('RegisterModel');
    $this->load->model('NewsModel');

    // Retrieve the API key from the environment variables
    $this->api_key = $_ENV['NEWS_API_KEY'] ?? null;

    if (!$this->api_key) {
      log_message('error', 'API key is not set in the environment variables.');
    }
  }

  public function search()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=gr&q=' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';

    $this->load->view('templates/main_template', $data);
  }

  public function technology()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=technology' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';

    $this->load->view('templates/main_template', $data);
  }

  public function business()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=business' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function entertainment()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=entertainment' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function science()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=science' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function health()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=health' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function lifestyle()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=lifestyle' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function food()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=food' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function education()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=education' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function sports()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=sports' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function tourism()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=tourism' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }

  public function politics()
  {
    $query = $this->input->get('query');
    $user = $this->session->userdata('user');

    if (!$this->api_key) {
      $data['news'] = array();
    } else {
      $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us&category=politics' . urlencode($query);
      $response = @file_get_contents($api_url);

      if ($response === FALSE) {
        $data['news'] = array();
      } else {
        $data['news'] = json_decode($response, true)['results'];
      }
    }

    $data['user'] = $user;
    $data['content'] = 'pages/homepage';
    $this->load->view('templates/main_template', $data);
  }
}

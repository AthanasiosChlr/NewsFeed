<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewsModel extends CI_Model
{
    private $api_key;

    public function __construct()
    {
        parent::__construct();
        // Retrieve the API key from the environment variables
        $this->api_key = $_ENV['NEWS_API_KEY'] ?? null;

        if (!$this->api_key) {
            log_message('error', 'API key is not set in the environment variables.');
        }
    }

    public function get_latest_news($category = null, $query = null)
    {
        if (!$this->api_key) {
            return array();
        }

        $api_url = 'https://newsdata.io/api/1/news?apikey=' . $this->api_key . '&country=us';
        if ($category) {
            $api_url .= '&category=' . urlencode($category);
        }
        if ($query) {
            $api_url .= '&q=' . urlencode($query);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === FALSE || $http_code !== 200) {
            $error = curl_error($ch);
            log_message('error', 'Failed to fetch news from API: ' . $error);
            curl_close($ch);
            return array();
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Failed to decode JSON response: ' . json_last_error_msg());
            return array();
        }

        log_message('debug', 'News API response: ' . print_r($data, true));

        return isset($data['results']) ? $data['results'] : array();
    }
}

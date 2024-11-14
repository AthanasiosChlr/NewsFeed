<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewsModel extends CI_Model
{
    public function get_latest_news()
    {
        // Retrieve the API key from the environment variables
        $api_key = $_ENV['NEWS_API_KEY'] ?? null;

        if (!$api_key) {
            log_message('error', 'API key is not set in the environment variables.');
            return array();
        }

        // Construct the API URL using the API key
        $api_url = 'ghttps://newsdata.io/api/1/news?apikey=' . $api_key . '&country=us';

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Check for errors
        if ($response === FALSE || $http_code !== 200) {
            $error = curl_error($ch);
            log_message('error', 'Failed to fetch news from API: ' . $error);
            curl_close($ch);
            return array();
        }

        // Close cURL
        curl_close($ch);

        // Decode the JSON response
        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Failed to decode JSON response: ' . json_last_error_msg());
            return array();
        }

        log_message('debug', 'News API response: ' . print_r($data, true));

        return isset($data['results']) ? $data['results'] : array();
    }
}

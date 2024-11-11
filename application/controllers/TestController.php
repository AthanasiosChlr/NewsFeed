<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TestController extends CI_Controller
{
    public function index()
    {
        // Load the database library
        $this->load->database();

        // Get environment variables
        $hostname = isset($_ENV['MYSQL_HOST']) ? $_ENV['MYSQL_HOST'] : 'Not set';
        $username = isset($_ENV['MYSQL_USER']) ? $_ENV['MYSQL_USER'] : 'Not set';
        $password = isset($_ENV['MYSQL_PASS']) ? $_ENV['MYSQL_PASS'] : 'Not set';
        $database = isset($_ENV['MYSQL_DB']) ? $_ENV['MYSQL_DB'] : 'Not set';

        // Print environment variables
        echo 'MYSQL_HOST: ' . $hostname . '<br>';
        echo 'MYSQL_USER: ' . $username . '<br>';
        echo 'MYSQL_PASS: ' . $password . '<br>';
        echo 'MYSQL_DB: ' . $database . '<br>';

        // Attempt to connect to the database
        $mysqli = new mysqli($hostname, $username, $password, $database);

        // Check connection
        if ($mysqli->connect_error) {
            die('Connection failed: ' . $mysqli->connect_error);
        } else {
            echo 'Connected successfully to the database.';
        }

        // Close the connection
        $mysqli->close();
    }
}
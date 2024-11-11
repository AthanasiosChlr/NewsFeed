<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TestController extends CI_Controller
{
    public function index()
    {
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

        // Attempt to connect to the database using mysqli
        $mysqli = @new mysqli($hostname, $username, $password, $database);

        // Check connection
        if ($mysqli->connect_error) {
            echo 'Connection failed: ' . $mysqli->connect_error . '<br>';
            echo 'Error number: ' . $mysqli->connect_errno . '<br>';
            echo 'Host info: ' . $mysqli->host_info . '<br>';
            echo 'SQLSTATE: ' . $mysqli->sqlstate . '<br>';
        } else {
            echo 'Connected successfully to the database.';
        }

        // Close the connection
        $mysqli->close();
    }
}
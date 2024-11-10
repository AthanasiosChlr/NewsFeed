<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$env_loaded = getenv('TEST_VARIABLE');
$env_loaded_env = $_ENV['TEST_VARIABLE'] ?? null;
$env_loaded_server = $_SERVER['TEST_VARIABLE'] ?? null;

if ($env_loaded === false && $env_loaded_env === null && $env_loaded_server === null) {
    echo "Environment variable not set or .env file not loaded.\n";
    echo "Current directory: " . __DIR__ . "\n";
    echo "Files in current directory:\n";
    print_r(scandir(__DIR__));
    echo "\nContents of .env file:\n";
    echo file_get_contents(__DIR__ . '/.env');
} else {
    echo "getenv: " . $env_loaded . "\n";
    echo "_ENV: " . $env_loaded_env . "\n";
    echo "_SERVER: " . $env_loaded_server . "\n";
}

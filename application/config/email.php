<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => $_ENV['SMTP_HOST'],
                    'smtp_port' => $_ENV['SMTP_PORT'],
                    'smtp_user' => $_ENV['SMTP_USER'],
                    'smtp_pass' => $_ENV['SMTP_PASS'],
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE,
                    'newline' => "\r\n"
                );
?>
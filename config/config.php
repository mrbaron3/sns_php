<?php

ini_set('display_errors', 1);

define('DNS','mysql:dbhost=localhost;dbname=test_sns_php');
define('DB_USERNAME','dbuser');
define('DB_PASSWORD','testapp');

//define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/sns_php/public_html');

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();
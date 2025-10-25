<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'hanisoft');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');


// session
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Lax');
session_name('APPSESSID');
session_start();
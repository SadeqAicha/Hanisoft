<?php
require_once __DIR__ . '/../../auth/app/config.php';
require_once __DIR__ . '/../../auth/app/middleware/auth.php';
require_once __DIR__ . '/../../auth/app/helpers.php';
require_login();
$u = current_user();
if($u['role']!='admin'){
    header('Location: ../index.php');
    exit;
}
?>
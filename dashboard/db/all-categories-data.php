<?php
require_once __DIR__ . '/../../auth/app/config.php';
require_once __DIR__ . '/../../auth/app/db.php';
$stmt = DB::conn()->query("SELECT * from categories");
$data = $stmt->fetchAll();

echo json_encode($data);
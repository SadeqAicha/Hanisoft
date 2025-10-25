<?php
header("content-type: application/json");
$data = json_decode(file_get_contents('php://input'),true);


require_once __DIR__ . '/../../auth/app/config.php';
require_once __DIR__ . '/../../auth/app/db.php';
$stmt = DB::conn()->prepare("DELETE from categories where category_id = :id");
$stmt->execute(['id'=>$data['id']]);

echo json_encode(['success'=>true]);
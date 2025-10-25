<?php
header('Content-Type: application/json');

try {
    require_once __DIR__ . '/../../auth/app/config.php';
    require_once __DIR__ . '/../../auth/app/db.php';

    $stmt = DB::conn()->query("SELECT * FROM messages");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}

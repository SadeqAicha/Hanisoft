<?php
header("content-type: application/json");
$data = json_decode(file_get_contents('php://input'),true);


require_once __DIR__ . '/../../auth/app/config.php';
require_once __DIR__ . '/../../auth/app/db.php';
$stmt = DB::conn()->prepare("SELECT * FROM posts WHERE post_id = :id");
$stmt->execute(['id'=>$data['id']]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($post) {
    $imagePath =$post['post_image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

$stmt = DB::conn()->prepare("DELETE from posts where post_id = :id");
$stmt->execute(['id'=>$data['id']]);

echo json_encode(['success'=>true]);
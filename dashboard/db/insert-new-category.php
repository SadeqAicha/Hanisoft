<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'),true);

require_once __DIR__ . '/../../auth/app/config.php';
require_once __DIR__ . '/../../auth/app/db.php';
$stmt = DB::conn()->query("SELECT * from categories");
$all_categories = $stmt->fetchAll();
for ($i = 0; $i < count($all_categories); $i++) {
        if($all_categories[$i]['category_name'] == $data['category']){
        echo(json_encode(['success'=> false]));
        exit;
    }
}

$stmt = DB::conn()->prepare("INSERT into categories (category_name) values(:category)");
$stmt->execute(['category'=>$data['category']]);

echo(json_encode(['success'=> true]));

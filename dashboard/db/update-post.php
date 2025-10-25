<?php
require_once __DIR__ . '/../../auth/app/config.php';
require_once __DIR__ . '/../../auth/app/db.php';
if(isset($_POST['id'])){
    if(!empty($_POST['title'])){
        $title = $_POST['title'];
        $stmt = DB::conn()->prepare("UPDATE posts SET post_title = :title Where post_id=:id");
        $stmt->execute(['title'=>$title,'id'=>$_POST['id']]);
    }
        
    if(!empty($_POST['category'])){
        $category = $_POST['category'];
        $stmt = DB::conn()->prepare("UPDATE posts SET post_category = :category Where post_id=:id");
        $stmt->execute(['category'=>$category,'id'=>$_POST['id']]);
    }

    if(!empty($_POST['content'])){
        $content = $_POST['content'];
        $stmt = DB::conn()->prepare("UPDATE posts SET post_content = :content Where post_id=:id");
        $stmt->execute(['content'=>$content,'id'=>$_POST['id']]);
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        //dalete 
        $stmt = DB::conn()->prepare("SELECT * FROM posts WHERE post_id = :id");
        $stmt->execute(['id'=>$_POST['id']]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        $imagePath =$post['post_image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        //update
        $image = $_FILES['image'];
        $destination = 'uploads/'.time();
        move_uploaded_file($image['tmp_name'],$destination);
        $stmt = DB::conn()->prepare("UPDATE posts SET post_image = :img Where post_id=:id");
        $stmt->execute(['img'=>$destination,'id'=>$_POST['id']]);
    }
    echo json_encode(['success'=>true]);
}

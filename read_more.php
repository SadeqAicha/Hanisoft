<?php
require_once __DIR__ . '/auth/app/config.php';
require_once __DIR__ . '/auth/app/db.php';
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Post ID is missing.");
}
$stmt = DB::conn()->prepare("SELECT * FROM posts WHERE post_id = :id");
$stmt->execute([':id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) {
    die("Erreur.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanisoft - <?php echo htmlspecialchars($post['post_title']); ?></title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include("include/header.php"); ?>

<div class="content">
    <div class="container">
        <div class="post" id="post" style="margin-top: 110px;">
            <div class="post-image">
                <img src="dashboard/db/<?php echo htmlspecialchars($post['post_image']); ?>" alt="image">
            </div>
            <div class="post-title">
                <b><?php echo htmlspecialchars($post['post_title']); ?></b>
            </div>
            <div class="post-details">
                <p class="post-info">
                    <span><i class="fa-solid fa-user"></i> Aicha</span>
                    <span><i class="fa-solid fa-tags"></i> <?php echo htmlspecialchars($post['post_category']); ?></span>
                    <span><i class="fa-solid fa-calendar-days"></i> <?php echo htmlspecialchars($post['post_date']); ?></span>
                </p>
                <p><?php echo nl2br(htmlspecialchars($post['post_content'])); ?></p>
            </div>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


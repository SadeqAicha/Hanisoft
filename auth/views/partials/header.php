<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e($title); ?></title>
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="auth/public/css/styles.css">
  <!--For icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!--Bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script defer src="auth/public/js/app.js"></script>
</head>

<body>

<?php include("include/header.php"); ?>
<div class="container auth-header">
<div class="header">
  <div class="badge"><?php echo e($title ?? ''); ?></div>
  <div class="badge">
    <?php if ($u = current_user()): ?>
      Bienvenue, <?php echo e($u['name']); ?> | <a href="auth/routes/logout.php">Se déconnecter</a>
    <?php else: ?>
      <a href="login.php">Se connecter</a> • <a href="register.php">s'inscrire</a>
    <?php endif; ?>
  </div>
</div>

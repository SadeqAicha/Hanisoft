<?php
include("include/is-admin.php");
require_once __DIR__ . '/../auth/app/config.php';
require_once __DIR__ . '/../auth/app/db.php';
require_once __DIR__ . '/../auth/app/middleware/auth.php';
require_once __DIR__ . '/../auth/app/csrf.php';
require_once __DIR__ . '/../auth/app/helpers.php';
require_admin();

// Traitement du changement de rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $uid = (int)($_POST['user_id'] ?? 0);
    $role = ($_POST['role'] ?? 'user') === 'admin' ? 'admin' : 'user';
    if ($uid > 0) {
        $stmt = DB::conn()->prepare('UPDATE users SET role = ? WHERE id = ?');
        $stmt->execute([$role, $uid]);
        header('Location: utilisateurs.php');
        exit;
    }
}

// Récupération des utilisateurs
$stmt = DB::conn()->query('SELECT id, name, email, role, created_at FROM users ORDER BY id DESC');
$users = $stmt->fetchAll();

$adminNum = 0;
for ($i = 0; $i < count($users); $i++) {
    if ($users[$i]['role'] == 'admin') {
        $adminNum++;
    }
}

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hanisoft dashboard - Gestion des utilisateurs</title>
  <link rel="stylesheet" href="css/dashboard.css">
  <!--For icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!--Bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="content text-white">
<div class="container-fluid">
<div class="row">
  <!-- Start Side area -->
  <?php include("include/dashboard-side-area.php") ?>
  <!-- End Side area -->
  <!-- Start New post -->
  <div class="col-md-10" class="main-area">
    <h1 class="section-title"><i class="fa-solid fa-users"></i> Utilisateurs</h1>
    <div class="stats">
      <div class="stat-card">
          <div class="stat-number" id="users_num"><?php echo e(count($users)); ?></div>
          <div class="stat-label">Utilisateur</div>
      </div>
      <div class="stat-card">
          <div class="stat-number" id="admin_num"><?php echo e($adminNum); ?></div>
          <div class="stat-label">Admin</div>
      </div>
    </div>
    <div class="search-box">
      <input onkeyup="searchArticles()" type="text" id="searchInput" placeholder="Rechercher un compte...">
      <button onclick="searchArticles()" class="search-btn" onclick="searchArticles()">Recherche</button>
    </div>
    <table class="table table-dark">
      <thead>
        <tr>
          <th>#</th>
          <th>Nom d'utilisateur</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Créé le</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $row): ?>
        <tr class="compte_info">
          <td><?php echo e($row['id']); ?></td>
          <td class="compte_name"><?php echo e($row['name']); ?></td>
          <td class="compte_email"><?php echo e($row['email']); ?></td>
          <td>
            <span class="<?php echo $row['role']==='admin' ? 'role-admin' : 'role-user'; ?>">
              <?php echo e($row['role']); ?>
            </span>
          </td>
          <td><?php echo e($row['created_at']); ?></td>
          <td>
            <form method="post" style="display:inline">
              <?php csrf_field(); ?>
              <input type="hidden" name="user_id" value="<?php echo e($row['id']); ?>">
              <?php $u = current_user();
              if ($row['role'] !== 'admin'): ?>
                <button class="btn btn-primary" type="submit" name="role" value="admin">Promouvoir en Admin</button>
              <?php elseif($u['name']!=$row['name']): ?>
                <button class="btn btn-danger" type="submit" name="role" value="user">Rétrograder en Utilisateur</button>
              <?php endif; ?>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
</div>
</div>
</body>
    <script src="js/utilisateurs.js"></script>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
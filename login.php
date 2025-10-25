<?php
require_once __DIR__ . '/auth/app/config.php';
require_once __DIR__ . '/auth/app/db.php';
require_once __DIR__ . '/auth/app/middleware/auth.php';
require_once __DIR__ . '/auth/app/csrf.php';
require_once __DIR__ . '/auth/app/helpers.php';

if (current_user()) {
  header('Location: dashboard/new-post.php');
  exit;
}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') $errors[] = 'Tous les champs sont obligatoires.';

    if (!$errors) {
        $stmt = DB::conn()->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($password, $user['password_hash'])) {
            $errors[] = 'Identifiants incorrects.';
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            if($user['role']=='admin')
              header('Location: dashboard/new-post.php');
            else 
              header('Location: index.php');
            exit;
        }
    }
}

$title = 'Hanisoft - Connexion';
include __DIR__ . '/auth/views/partials/header.php';
?>
<?php if ($errors): ?>
  <div class="error"><?php echo e(implode('<br>', $errors)); ?></div>
<?php endif; ?>
<form method="post" data-validate>
  <?php csrf_field(); ?>
  <label>Email</label>
  <input type="email" name="email" required value="<?php echo e($_POST['email'] ?? ''); ?>">
  <label>Mot de passe</label>
  <input type="password" name="password" required>
  <button type="submit">Se connecter</button>
  <div class="nav">Nouvel utilisateur ? <a href="register.php">Créer un compte</a></div>
</form>
<?php include __DIR__ . '/auth/views/partials/footer.php'; ?>
<?php include("include/footer.php"); ?>
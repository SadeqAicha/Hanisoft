<?php
require_once __DIR__ . '/auth/app/config.php';
require_once __DIR__ . '/auth/app/db.php';
require_once __DIR__ . '/auth/app/middleware/auth.php';
require_once __DIR__ . '/auth/app/csrf.php';
require_once __DIR__ . '/auth/app/helpers.php';
if (!current_user()) {
  header('Location: login.php');
  exit;
}
$title = 'Hanisoft - Profile';
$u = current_user();
include __DIR__ . '/auth/views/partials/header.php';
?>
<p>Username : <strong><?php echo e($u['name']); ?></strong></p>
<p>Email : <strong><?php echo e($u['email']); ?></strong></p>
<p>Rôle actuel : 
   <span class="<?php echo $u['role']==='admin' ? 'role-admin' : 'role-user'; ?>">
       <?php echo e($u['role']); ?>
   </span>
</p>
<p><a href="edit_profile.php">Changer les info de votre profile</a></p>
<?php if ($u['role'] === 'admin'): ?>
  <p><a href="dashboard/new-post.php">Espace administrateur</a></p>
<?php endif; ?>
<?php include __DIR__ . '/auth/views/partials/footer.php'; ?>
<?php include("include/footer.php"); ?>
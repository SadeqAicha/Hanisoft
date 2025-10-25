<?php
require_once __DIR__ . '/auth/app/config.php';
require_once __DIR__ . '/auth/app/db.php';
require_once __DIR__ . '/auth/app/helpers.php';
require_once __DIR__ . '/auth/app/csrf.php';

if (!isset($_SESSION['pending_user'])) {
    header("Location: register.php");
    exit;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $input_code = trim($_POST['code'] ?? '');

    if ($input_code === '') {
        $errors[] = 'Veuillez entrer le code de vérification.';
    } elseif ($input_code != $_SESSION['pending_user']['code']) {
        $errors[] = 'Code de vérification incorrect.';
    } else {
        $user = $_SESSION['pending_user'];
        $stmt = DB::conn()->prepare('INSERT INTO users (name, email, password_hash) VALUES (?,?,?)');
        $stmt->execute([$user['name'], $user['email'], $user['password_hash']]);

        unset($_SESSION['pending_user']);

        $success = true;
    }
}

$title = 'Hanisoft - Vérification du compte';
include("include/header.php");
include __DIR__ . '/auth/views/partials/header.php';
?>

<?php if ($success): ?>
    <div class="success">
        Votre compte a été vérifié et créé avec succès. Vous pouvez maintenant 
        <a href="login.php">vous connecter</a>.
    </div>
<?php else: ?>
    <?php if ($errors): ?>
        <div class="error"><?php echo e(implode('<br>', $errors)); ?></div>
    <?php endif; ?>

    <form method="post" data-validate>
        <?php csrf_field(); ?>
        <label>Entrez le code de vérification envoyé par email :</label>
        <input type="text" name="code" required>
        <button type="submit">Vérifier le compte</button>
    </form>
<?php endif; ?>

<?php
include __DIR__ . '/auth/views/partials/footer.php';
include("include/footer.php");
?>
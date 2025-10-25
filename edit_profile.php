<?php
require_once __DIR__ . '/auth/app/db.php';
require_once __DIR__ . '/auth/app/middleware/auth.php';
require_login();
$user = current_user();

if (!$user) {
    header("Location: login.php");
    exit;
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = DB::conn()->prepare('SELECT password_hash FROM users WHERE id = ?');
    $stmt->execute([$user['id']]);
    $hash = $stmt->fetchColumn();

    if (!password_verify($_POST['current_password'], $hash)) {
        $errors[] = 'Mot de passe actuel incorrect.';
    }else{
        $new_name = trim($_POST['name']);
        if (empty($new_name)) $errors[] = "Le nom ne peut pas être vide.";
        if (!empty($_POST['new_password']) || !empty($_POST['confirm_password'])
        || ($_POST['new_password'] !== $_POST['confirm_password'])){
            $errors[] = 'Le nouveau mot de passe et sa confirmation ne correspondent pas.';
        }
        if (empty($errors)) {
            $stmt = DB::conn()->prepare('UPDATE users SET name = ? WHERE id = ?');
            $stmt->execute([$new_name, $user['id']]);

            if (!empty($_POST['new_password'])) {
                $new_hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $stmt = DB::conn()->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
                $stmt->execute([$new_hash, $user['id']]);
            }
            $success = "Vos informations ont été mises à jour avec succès !";
            $user['name'] = $new_name;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hanisoft -Modifier le Profile</title>
    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/edit_profile.css">
</head>
<body>
<!--Start navbar-->
    <?php include("include/header.php") ?>
<!--End navbar-->
<div class="container " style="width:100%; max-width: 700px;">
    <div class="card p-4">
        <h3 class="mb-4 text-center text-light">Modifier le profile</h3>

        <a href="profile.php" class="mb-3 d-block">&larr; Retour au Profile</a>

        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $err) echo "<div>$err</div>"; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" class="position-relative text-light">
            <div class="mb-3 position-relative">
                <label>Mot de passe actuel</label>
                <input type="password" name="current_password" class="form-control" id="current_password">
                <span class="password-toggle fa-regular fa-eye-slash" onclick="togglePassword('current_password', this)"></span>
            </div>

            <hr class="text-secondary">

            <div class="mb-3">
                <label>Nouveau nom</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>

            <div class="mb-3 position-relative">
                <label>Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control" id="new_password">
                <span class="password-toggle fa-regular fa-eye-slash" onclick="togglePassword('new_password', this)"></span>
            </div>

            <div class="mb-3 position-relative">
                <label>Confirmer le nouveau mot de passe</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                <span class="password-toggle fa-regular fa-eye-slash" onclick="togglePassword('confirm_password', this)"></span>
            </div>

            <button class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>
</div>
<!--Start footer-->
<?php include("include/footer.php") ?>
<!--End footer-->
<!-- Bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePassword(id, el) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        el.classList.add("fa-eye");
        el.classList.remove("fa-eye-slash");
    } else {
        input.type = "password";
        el.classList.add("fa-eye-slash");
        el.classList.remove("fa-eye");
    }
}
</script>
</body>
</html>
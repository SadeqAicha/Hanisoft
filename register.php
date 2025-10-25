<?php
require_once __DIR__ . '/auth/app/config.php';
require_once __DIR__ . '/auth/app/db.php';
require_once __DIR__ . '/auth/app/middleware/auth.php';
require_once __DIR__ . '/auth/app/csrf.php';
require_once __DIR__ . '/auth/app/helpers.php';

require_once __DIR__ . '/include/src/PHPMailer.php';
require_once __DIR__ . '/include/src/SMTP.php';
require_once __DIR__ . '/include/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if ($name === '' || $email === '' || $password === '') $errors[] = 'Tous les champs sont obligatoires.';
    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $name)) {
        $errors[] = 'Le nom doit contenir uniquement des lettres anglaises, des chiffres ou un underscore (_) et avoir une longueur de 3 à 20 caractères.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
    if (strlen($password) < 8) $errors[] = 'Le mot de passe doit comporter au moins 8 caractères.';
    if ($password !== $password_confirm) $errors[] = 'La confirmation du mot de passe ne correspond pas.';

    if (!$errors) {
        // Vérification de l’existence de l’email ou du nom
        $stmt = DB::conn()->prepare('SELECT id FROM users WHERE name = ? OR email = ?');
        $stmt->execute([$name, $email]);
        if ($stmt->fetch()) {
            $errors[] = 'Le nom ou l’email est déjà utilisé.';
        } else {
            // Génération du code de vérification
            $verification_code = rand(100000, 999999);

            // Stocker les infos temporairement dans la session
            $_SESSION['pending_user'] = [
                'name' => $name,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'code' => $verification_code
            ];

            // Envoi du mail
            $mail = new PHPMailer(true);
            try {
                // Configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sadeqai489@gmail.com';
                $mail->Password = 'jbtzmhvmizshxaop';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->Timeout = 10;
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('sadeqai489@gmail.com', 'Hanisoft');
                $mail->addAddress($email, $name);

                $mail->isHTML(true);
                $mail->Subject = 'Code de vérification Hanisoft';
                $mail->Body = '
                    <!DOCTYPE html>
                    <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <title>Code de verification</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f4f4f4;
                                color: #333;
                                padding: 0;
                                margin: 0;
                            }
                            .container {
                                max-width: 600px;
                                margin: 40px auto;
                                background-color: #fff;
                                border-radius: 8px;
                                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                                padding: 30px;
                            }
                            h2 {
                                color: #2c3e50;
                            }
                            .code {
                                font-size: 28px;
                                font-weight: bold;
                                color: #e74c3c;
                                background-color: #ecf0f1;
                                padding: 15px;
                                border-radius: 5px;
                                display: inline-block;
                                letter-spacing: 3px;
                                margin: 20px 0;
                            }
                            p {
                                line-height: 1.6;
                            }
                            .footer {
                                font-size: 12px;
                                color: #777;
                                margin-top: 30px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h2>Bienvenue, ' . htmlspecialchars($name) . ' !</h2>
                            <p>Merci de créer un compte chez <strong>Hanisoft</strong>. Voici votre code de vérification :</p>
                            <div class="code">' . htmlspecialchars($verification_code) . '</div>
                            <p>Ce code est valable pendant <strong>10 minutes</strong>.</p>
                            <p>Si vous n\'avez pas demandé ce code, ignorez ce message.</p>
                            <div class="footer">
                                &copy; ' . date('Y') . ' Hanisoft. Tous droits réservés.
                            </div>
                        </div>
                    </body>
                    </html>
                    ';
                $mail->send();
                ob_clean();
                header("Location: verify.php");
                exit;

            } catch (Exception $e) {
                $errors[] = "Erreur lors de l’envoi du mail : {$mail->ErrorInfo}";
            }
        }
    }
}

$title = 'Hanisoft - Créer un compte';
include("include/header.php");
include __DIR__ . '/auth/views/partials/header.php';
?>

<?php if ($errors): ?>
  <div class="error"><?php echo e(implode('<br>', $errors)); ?></div>
<?php endif; ?>

<form method="post" data-validate>
  <?php csrf_field(); ?>
  <label>Nom d’utilisateur</label>
  <input type="text" name="name" required value="<?php echo e($_POST['name'] ?? ''); ?>">
  <label>Email</label>
  <input type="email" name="email" required value="<?php echo e($_POST['email'] ?? ''); ?>">
  <label>Mot de passe</label>
  <input type="password" name="password" required>
  <label>Confirmer le mot de passe</label>
  <input type="password" name="password_confirm" required>
  <button type="submit">Créer un compte</button>
  <div class="nav">Vous avez déjà un compte ? <a href="login.php">Se connecter</a></div>
</form>

<?php include __DIR__ . '/auth/views/partials/footer.php'; ?>
<?php include("include/footer.php"); ?>
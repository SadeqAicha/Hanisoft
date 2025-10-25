<?php
require_once __DIR__ . '/../db.php';
function current_user() {
    if (!empty($_SESSION['user_id'])) {
        static $cached = null;
        if ($cached !== null) return $cached;
        $stmt = DB::conn()->prepare('SELECT id, name, email, role, created_at FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $cached = $stmt->fetch();
        return $cached ?: null;
    }
    return null;
}
function require_login() {
    if (!current_user()) {
        header('Location: /login.php');
        exit;
    }
}
function require_admin() {
    $u = current_user();
    if (!$u || $u['role'] !== 'admin') {
        http_response_code(403);
        die('غير مسموح: هذه الصفحة للمدير فقط.');
    }
}

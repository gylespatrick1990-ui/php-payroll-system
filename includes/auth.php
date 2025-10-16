<?php
require_once __DIR__ . '/../config/db.php';

function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

function current_user(PDO $pdo): ?array {
    if (!is_logged_in()) return null;
    static $cached = null;
    if ($cached !== null) return $cached;
    $stmt = $pdo->prepare('SELECT user_id, full_name, email, role, created_at FROM users WHERE user_id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $cached = $stmt->fetch() ?: null;
    return $cached;
}

function current_employee(PDO $pdo): ?array {
    $user = current_user($pdo);
    if (!$user) return null;
    $stmt = $pdo->prepare('SELECT * FROM employees WHERE user_id = ?');
    $stmt->execute([$user['user_id']]);
    $emp = $stmt->fetch() ?: null;
    return $emp;
}

function require_login(): void {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . 'pages/login.php');
        exit;
    }
}

function require_admin(PDO $pdo): void {
    require_login();
    $user = current_user($pdo);
    if (!$user || $user['role'] !== 'admin') {
        http_response_code(403);
        echo 'Forbidden';
        exit;
    }
}

function redirect(string $path): void {
    header('Location: ' . BASE_URL . ltrim($path, '/'));
    exit;
}

function h(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

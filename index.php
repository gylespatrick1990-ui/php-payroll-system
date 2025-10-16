<?php
require_once __DIR__ . '/config/db.php';

// Redirect to dashboard if logged in; otherwise to login
if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'pages/dashboard.php');
    exit;
}
header('Location: ' . BASE_URL . 'pages/login.php');
exit;

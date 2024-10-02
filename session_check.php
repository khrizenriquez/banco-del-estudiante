<?php
require_once 'config/config.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: ' . BASE_PATH . '/admin/dashboard');
            break;

        case 'teller':
            header('Location: ' . BASE_PATH . '/teller/dashboard');
            break;

        case 'customer':
            header('Location: ' . BASE_PATH . '/user/dashboard');
            break;

        default:
            session_destroy();
            header('Location: ' . BASE_PATH . '/login?error=invalid_role');
            break;
    }
    exit();
}
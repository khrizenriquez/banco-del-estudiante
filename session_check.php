<?php
require_once 'config/config.php';

@session_start();

$public_pages = ['login', 'register', 'forgot-password'];

$current_page = basename($_SERVER['REQUEST_URI']);

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    if (!in_array($current_page, $public_pages)) {
        header('Location: ' . BASE_PATH . '/login?error=not_logged_in');
        exit();
    }
} else {
    if (in_array($current_page, $public_pages)) {
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
}

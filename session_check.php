<?php
require_once 'config/config.php';

@session_start();

// Definir las páginas públicas (sin autenticación requerida)
$public_pages = ['login', 'register', 'forgot-password', 'register-customer'];

// Obtener la ruta actual
$current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Si no hay sesión activa, solo permitir el acceso a las páginas públicas
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    if (!in_array($current_page, $public_pages)) {
        header('Location: ' . BASE_PATH . '/login?error=not_logged_in');
        exit();
    }
} else {
    // Si ya hay una sesión activa, no permitir acceso a las páginas públicas (redirigir al dashboard correspondiente)
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

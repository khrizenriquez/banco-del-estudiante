<?php
require_once 'config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'controllers/AuthController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/TellerController.php';
require_once 'controllers/UserController.php';

// Parse the URL path
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
$path = trim(str_replace('/desarrolloweb/banco-del-estudiante', '', $request_uri[0]), '/');

// Default to home if no path is provided
$action = $path ?: 'home';

printf($path);

switch ($action) {
    case 'login':
        $authController = new AuthController();
        $authController->showLoginForm();
        break;
    case 'register':
        $authController = new AuthController();
        $authController->showRegisterForm();
        break;
    case 'forgot-password':
        $authController = new AuthController();
        $authController->showForgotPasswordForm();
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'admin_dashboard':
        $adminController = new AdminController();
        $adminController->dashboard();
        break;
    case 'teller_dashboard':
        $tellerController = new TellerController();
        $tellerController->dashboard();
        break;
    case 'user_dashboard':
        $userController = new UserController();
        $userController->dashboard();
        break;
    default:
        // Default to register if no action matches
        $authController = new AuthController();
        $authController->showRegisterForm();
        break;
}
?>

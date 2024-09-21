<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'controllers/AuthController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/TellerController.php';  // Actualizado
require_once 'controllers/UserController.php';
// Otros requires...

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'login':
        $authController = new AuthController();
        $authController->login();
        break;
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'admin_dashboard':
        $adminController = new AdminController();
        $adminController->dashboard();
        break;
    case 'teller_dashboard':                              // Actualizado
        $tellerController = new TellerController();        // Actualizado
        $tellerController->dashboard();                    // Actualizado
        break;
    case 'user_dashboard':
        $userController = new UserController();
        $userController->dashboard();
        break;
    // Otras acciones...
    default:
        $authController = new AuthController();
        $authController->showLoginForm();
        break;
}
?>

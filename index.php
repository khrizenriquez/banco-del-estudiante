<?php
//  Kind of router to handle the different actions
require_once 'config/config.php';

$routes = require_once 'config/routes.php';

// ----------------------------------------------------- Comment these section after testing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ----------------------------------------------------- Comment these section after testing

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

if (isset($routes[$path])) {
    list($controller, $action) = explode('@', $routes[$path]);

    $controllerInstance = new $controller();
    $controllerInstance->$action();
} else {
    include 'views/auth/info.php';
}

//switch ($action) {
//    case 'login':
//        $authController = new AuthController();
//        $authController->showLoginForm();
//        break;
//    case 'register':
//        $authController = new AuthController();
//        $authController->showRegisterForm();
//        break;
//    case 'forgot-password':
//        $authController = new AuthController();
//        $authController->showForgotPasswordForm();
//        break;
//    case 'logout':
//        $authController = new AuthController();
//        $authController->logout();
//        break;
//    // Admin actions
//    case 'admin/dashboard':
//        $adminController = new AdminController();
//        $adminController->dashboard();
//        break;
//    // Teller actions
//    case 'teller-dashboard':
//        $tellerController = new TellerController();
//        $tellerController->dashboard();
//        break;
//    // User actions
//    case 'user-dashboard':
//        $userController = new UserController();
//        $userController->dashboard();
//        break;
//    default:
//        // Default to register if no action matches
//        //$authController = new AuthController();
//        //$authController->showLoginForm();
//        include 'views/auth/info.php';
//        break;
//}
?>

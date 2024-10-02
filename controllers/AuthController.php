<?php
require_once 'LoginController.php';
require_once 'config/config.php';

class AuthController {
    public function login() {
        @session_start();

        $username = $_POST['email'];
        $password = $_POST['password'];

        $loginController = new LoginController();
        $user = $loginController->authenticate($username, $password);

        if ($user) {
            //  Setting up the default values after the login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name'];

            $this->redirectToDashboard($user['role']);
        } else {
            header('Location: ' . BASE_PATH . '/login?error=invalid_credentials');
            exit();
        }
    }

    public function showLoginForm() {
        @session_start();

        if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
            $this->redirectToDashboard($_SESSION['role']);
        } else {
            include 'views/auth/login.php';
        }
    }

    private function redirectToDashboard($role) {
        switch ($role) {
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
    public function showRegisterForm() {
        @session_start();

        if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
            $this->redirectToDashboard($_SESSION['role']);
        } else {
            include 'views/auth/register_user.php';
        }
    }

    public function showForgotPasswordForm() {
        @session_start();

        if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
            $this->redirectToDashboard($_SESSION['role']);
        } else {
            include 'views/auth/forgot_password.php';
        }
    }

    public function showServerInfo() {
        include 'views/auth/info.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_PATH . '/login');
        exit();
    }
}
?>

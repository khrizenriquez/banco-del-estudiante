<?php
require_once 'LoginController.php';
require_once 'config/config.php';
require_once 'models/CustomerModel.php';
require_once 'models/SessionModel.php';

class AuthController {
    public function login() {
        @session_start();

        $username = $_POST['email'];
        $password = $_POST['password'];

        $loginController = new LoginController();
        $user = $loginController->authenticate($username, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name'];

            if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
                throw new Exception('Error: La sesión no se ha guardado correctamente.');
            }

            $ip_address = $this->getUserIP();
            $device_info = $this->getDeviceInfo();
            $location = 'Desconocida';

            $this->logSessionMetadata($user['id'], $ip_address, $device_info, $location);

            $this->redirectToDashboard($user['role']);
        } else {
            header('Location: ' . BASE_PATH . '/login?error=invalid_credentials');
            exit();
        }
    }

    private function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    private function getDeviceInfo() {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    private function logSessionMetadata($user_id, $ip_address, $device_info, $location) {
        $sessionModel = new SessionModel();
        $sessionModel->logSession($user_id, $ip_address, $device_info, $location);
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
                //include 'views/auth/register_user.php';
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

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_number = $_POST['account_number'];
            $email = $_POST['email'];
            $dpi = $_POST['dpi'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                header('Location: ' . BASE_PATH . '/register?error=password_mismatch');
                exit();
            }

            $customerModel = new CustomerModel();
            $result = $customerModel->registerCustomer($account_number, $email, $dpi, $password, $confirm_password);

            if ($result) {
                header('Location: ' . BASE_PATH . '/login?success=registered');
            } else {
                header('Location: ' . BASE_PATH . '/register?error=registration_failed');
            }
            exit();
        }

        include 'views/auth/register_user.php';
    }
}
?>

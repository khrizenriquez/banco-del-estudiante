<?php
class AuthController {
    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new User();
        $user = $userModel->authenticate($username, $password);

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            switch ($user['role']) {
                case 'admin':
                    header('Location: index.php?action=admin_dashboard');
                    break;
                case 'teller':
                    header('Location: index.php?action=teller_dashboard');
                    break;
                case 'user':
                    header('Location: index.php?action=user_dashboard');
                    break;
                default:
                    session_destroy();
                    header('Location: index.php?error=invalid_role');
                    break;
            }
            exit();
        } else {
            header('Location: index.php?action=login&error=invalid_credentials');
            exit();
        }
    }

    public function showLoginForm() {
        include 'views/auth/login.php';
    }

    public function showRegisterForm() {
        include 'views/auth/register_user.php';
    }

    public function showForgotPasswordForm() {
        include 'views/auth/forgot_password.php';
    }

    public function showServerInfo() {
        include 'views/auth/info.php';
    }

    public function logout() {
        $local_base_path = '/desarrolloweb/banco-del-estudiante';
        //session_start();
        //session_destroy();
        header("Location: $local_base_path/");
        exit();
    }

}
?>
<?php

class UserController {
    public function __construct() {
//        session_start();
//        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
//            header('Location: index.php?action=login&error=unauthorized');
//            exit();
//        }
    }

    public function dashboard() {
        include 'views/user/dashboard.php';
    }

    public function createUser() {
        include 'views/user/create_user.php';
    }

    public function createAccount() {
        include 'views/user/create_account.php';
    }

    public function viewAccounts() {
        include 'views/user/view_accounts.php';
    }

    public function viewUsers() {
        include 'views/user/view_users.php';
    }
}
?>
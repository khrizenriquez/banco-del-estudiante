<?php

class AdminController {
    public function __construct() {
//        session_start();
//        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//            header('Location: index.php?action=login&error=unauthorized');
//            exit();
//        }
    }

    public function dashboard() {
        include 'views/admin/dashboard.php';
    }

    public function createUser() {
        include 'views/admin/create_user.php';
    }

    public function createAccount() {
        include 'views/admin/create_account.php';
    }

    public function viewAccounts() {
        include 'views/admin/view_accounts.php';
    }

    public function viewUsers() {
        include 'views/admin/view_users.php';
    }
}
?>
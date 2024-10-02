<?php
require_once 'session_check.php';
class UserController {
    public function __construct() {
        if ($_SESSION['role'] !== 'customer') {
            header('Location: ' . BASE_PATH . '/login?error=unauthorized');
            exit();
        }
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

    public function addThirdPartyAccount() {
        include 'views/user/add_third_party_account.php';
    }

    public function viewTransfer() {
        include 'views/user/transfer.php';
    }

    public function viewAccountStatement() {
        include 'views/user/account_statement.php';
    }
}
?>
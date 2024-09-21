<?php
class TellerController {
    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teller') {
            header('Location: index.php?action=login&error=unauthorized');
            exit();
        }
    }

    public function dashboard() {
        include 'views/teller/dashboard.php';
    }

    public function createAccount() {
        include 'views/teller/create_account.php';
    }

    public function deposit() {
        include 'views/teller/deposit.php';
    }

    public function withdraw() {
        include 'views/teller/withdraw.php';
    }
}
?>

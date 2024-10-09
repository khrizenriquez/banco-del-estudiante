<?php

require_once 'session_check.php';
require_once 'models/UserModel.php';
require_once 'utils/LogAnalyzer.php';

class MaintenanceController {

    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_PATH . '/login?error=unauthorized');
            exit();
        }
    }

    public function showMaintenance() {
        $okCount = countStatusCode(200);
        $errorCount = countStatusCode(500);
        $notFoundCount = countStatusCode(404);
        $mostVisitedPages = getMostVisitedPages(5);
        $errorPages = getErrorPages();

        include 'views/auth/statistics.php';
    }
}
?>

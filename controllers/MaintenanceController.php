<?php
require_once 'session_check.php';
require_once 'utils/LogAnalyzer.php';

class MaintenanceController {
    public function __construct() {
        @session_start();
        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_PATH . '/login?error=unauthorized');
            exit();
        }
    }

    public function showMaintenance() {
        $status200TodayCount = countStatusCode(200, 'today');
        $status404TodayCount = countStatusCode(404, 'today');
        $status500TodayCount = countStatusCode(500, 'today');

        $status200WeekCount = countStatusCode(200, 'week');
        $status404WeekCount = countStatusCode(404, 'week');
        $status500WeekCount = countStatusCode(500, 'week');

        $mostVisitedPages = getMostVisitedPages(10, 'today');

        include 'views/auth/statistics.php';
    }
}

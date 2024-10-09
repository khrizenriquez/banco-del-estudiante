<?php
class MaintenanceModel {
    private $logFile;

    public function __construct() {
        $this->logFile = __DIR__ . '/../logs/banco-del-estudiante.log';
    }

    public function getStatusCodesByDay($period) {
        $lines = $this->getLogFileLines();
        $statusCodesCount = ['200' => 0, '404' => 0, '500' => 0];

        $today = new DateTime();
        $weekAgo = (new DateTime())->modify('-7 days');

        foreach ($lines as $line) {
            preg_match('/\[(.*?)\] (.*?) (\d{3})$/', $line, $matches);

            if (!empty($matches)) {
                $date = new DateTime($matches[2]);
                $statusCode = $matches[3];

                if ($period === 'today' && $date->format('Y-m-d') === $today->format('Y-m-d')) {
                    $statusCodesCount[$statusCode] = ($statusCodesCount[$statusCode] ?? 0) + 1;
                }

                if ($period === 'week' && $date >= $weekAgo && $date <= $today) {
                    $statusCodesCount[$statusCode] = ($statusCodesCount[$statusCode] ?? 0) + 1;
                }
            }
        }

        return $statusCodesCount;
    }

    public function getMostVisitedPages() {
        $lines = $this->getLogFileLines();
        $pageVisits = [];

        foreach ($lines as $line) {
            preg_match('/GET (.*?) /', $line, $matches);
            if (!empty($matches)) {
                $page = $matches[1];
                $pageVisits[$page] = ($pageVisits[$page] ?? 0) + 1;
            }
        }

        arsort($pageVisits);
        return array_slice($pageVisits, 0, 5);
    }

    private function getLogFileLines() {
        if (!file_exists($this->logFile)) {
            return [];
        }

        return file($this->logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
}

?>
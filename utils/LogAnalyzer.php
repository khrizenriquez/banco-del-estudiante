<?php
/*function readLogFile() {
    if (!file_exists(LOG_FILE_PATH)) {
        return [];
    }

    $lines = [];
    $handle = fopen(LOG_FILE_PATH, "r");

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $lines[] = trim($line);
        }
        fclose($handle);
    }

    return $lines;
}*/

function countStatusCode($statusCode, $filter = 'today') {
    $lines = readLogFile();
    $count = 0;

    // Expresión regular actualizada
    $pattern = '/\[(.*?)\]\s+([\d\- :]+)\s+\w+\s+\S+\s+".*?"\s+(\d{3})$/';

    foreach ($lines as $line) {
        if (preg_match($pattern, $line, $matches)) {
            $ip = $matches[1];
            $datetime = $matches[2];
            $status = $matches[3];

            $logDate = strtotime($datetime);

            // Filtrar por fecha
            $dateMatchesFilter = ($filter === 'today' && isToday($logDate)) ||
                ($filter === 'week' && isWithinLastWeek($logDate));

            if ($dateMatchesFilter && $status == $statusCode) {
                $count++;
            }
        }
    }

    return $count;
}

function isToday($timestamp) {
    return date('Y-m-d', $timestamp) === date('Y-m-d');
}

function isWithinLastWeek($timestamp) {
    $oneWeekAgo = strtotime('-7 days');
    return $timestamp >= $oneWeekAgo;
}

function readLogFile() {
    return file(LOG_FILE_PATH, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

function getMostVisitedPages($limit = 5, $filter = 'today') {
    $lines = readLogFile();
    $pageVisits = [];

    $pattern = '/\[(.*?)\]\s+([\d\- :]+)\s+\w+\s+(\S+)/';

    foreach ($lines as $line) {
        if (preg_match($pattern, $line, $matches)) {
            $ip = $matches[1];
            $datetime = $matches[2];
            $page = $matches[3];

            $logDate = strtotime($datetime);

            $dateMatchesFilter = ($filter === 'today' && isToday($logDate)) ||
                ($filter === 'week' && isWithinLastWeek($logDate));

            if ($dateMatchesFilter) {
                if (!isset($pageVisits[$page])) {
                    $pageVisits[$page] = 0;
                }
                $pageVisits[$page]++;
            }
        }
    }

    arsort($pageVisits);

    return array_slice($pageVisits, 0, $limit, true);
}

?>

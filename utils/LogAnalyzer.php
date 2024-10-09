<?php
function readLogFile() {
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
}
function countStatusCode($statusCode) {
    $lines = readLogFile();
    $count = 0;

    foreach ($lines as $line) {
        preg_match('/HTTP\/1\.[01]" (\d{3})/', $line, $matches);
        if (!empty($matches) && $matches[1] == $statusCode) {
            $count++;
        }
    }

    return $count;
}

function getMostVisitedPages($limit = 5) {
    $lines = readLogFile();
    $pageVisits = [];

    foreach ($lines as $line) {
        preg_match('/"GET (.+?) HTTP\/1\.[01]"/', $line, $matches);
        if (!empty($matches)) {
            $page = $matches[1];
            if (!isset($pageVisits[$page])) {
                $pageVisits[$page] = 0;
            }
            $pageVisits[$page]++;
        }
    }

    arsort($pageVisits);

    return array_slice($pageVisits, 0, $limit);
}
function getErrorPages() {
    $lines = readLogFile();
    $errorPages = [];

    foreach ($lines as $line) {
        preg_match('/"GET (.+?) HTTP\/1\.[01]" (\d{3})/', $line, $matches);
        if (!empty($matches)) {
            $page = $matches[1];
            $statusCode = $matches[2];

            if (intval($statusCode) >= 400) {
                if (!isset($errorPages[$page])) {
                    $errorPages[$page] = 0;
                }
                $errorPages[$page]++;
            }
        }
    }

    return $errorPages;
}

?>

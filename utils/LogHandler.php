<?php
define('LOG_FILE_PATH', __DIR__ . '/../logs/banco-del-estudiante.log');

function logRequest($message) {
    $logDir = __DIR__ . '/../logs';

    if (!is_dir($logDir)) {
        if (!mkdir($logDir, 0777, true)) {
            throw new Exception('No se pudo crear el directorio de logs.');
        }
    }

    $logFile = $logDir . '/banco-del-estudiante.log';

    if (!file_exists($logFile)) {
        if (!touch($logFile)) {
            throw new Exception('No se pudo crear el archivo de log.');
        }
    }

    $fileHandle = fopen($logFile, 'a');

    if ($fileHandle) {
        fwrite($fileHandle, $message . PHP_EOL);
        fclose($fileHandle);
    } else {
        throw new Exception("No se pudo abrir el archivo de log para escritura.");
    }
}


function checkLogRotation() {
    $logFile = LOG_FILE_PATH;
    $maxFileSize = 10 * 1024 * 1024; // 10 MB
    //$maxFileSize = 5 * 1024; // 5 KB

    if (file_exists($logFile) && filesize($logFile) > $maxFileSize) {
        $newName = __DIR__ . '/../logs/banco-del-estudiante-' . date('Y-m-d-His') . '.log';
        rename($logFile, $newName);
        touch($logFile);
    }
}
checkLogRotation();

function captureRequestLog() {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $statusCode = http_response_code();
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $time = date("Y-m-d H:i:s");

    $logMessage = sprintf(
        '[%s] %s %s %s "%s" %s',
        $ipAddress,
        $time,
        $requestMethod,
        $requestUri,
        $userAgent,
        $statusCode
    );

    logRequest($logMessage);
}
?>

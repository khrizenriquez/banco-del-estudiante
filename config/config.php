<?php
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    define('BASE_PATH', '/desarrolloweb/banco-del-estudiante');
} else {
    define('BASE_PATH', '');
}

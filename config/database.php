<?php

require_once __DIR__ . '/../load_env.php';

class Database {
    private static $host;
    private static $db_name;
    private static $username;
    private static $password;
    private static $conn;

    public static function init() {
        self::$host = getenv('DB_HOST') ?: 'localhost';
        self::$db_name = getenv('DB_NAME') ?: 'nombre_bd';
        self::$username = getenv('DB_USER') ?: 'root';
        self::$password = getenv('DB_PASS') ?: '';
    }

    public static function getConnection() {
        if (self::$conn === null) {
            self::init();
            self::$conn = new mysqli(self::$host, self::$username, self::$password, self::$db_name);

            if (self::$conn->connect_error) {
                die("Conexión fallida: " . self::$conn->connect_error);
            }
        }

        return self::$conn;
    }
}

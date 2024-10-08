<?php
class SessionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function logSession($user_id, $ip_address, $device_info, $location) {
        $stmt = $this->db->prepare("
            INSERT INTO session_logs (user_id, session_type, ip_address, device_info, location, timestamp) 
            VALUES (?, 'login', ?, ?, ?, NOW())
        ");
        $stmt->bind_param('isss', $user_id, $ip_address, $device_info, $location);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar el log de sesión: " . $stmt->error);
        }
    }
}

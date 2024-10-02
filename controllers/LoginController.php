<?php
require_once 'config/database.php';

class LoginController {
    public function authenticate($username, $password) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT user_id, user_type, password FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $stmt->bind_result($id, $role, $password_hash);
        $stmt->fetch();

        if ($id && $this->verifyPassword($password, $password_hash)) {
            return ['id' => $id, 'role' => $role];
        } else {
            return false;
        }
    }

    private function verifyPassword($password, $password_hash) {
        $hashed_input_password = hash('sha256', $password);

        return $hashed_input_password === $password_hash;
    }
}
?>
<?php
require_once 'config/database.php';

class LoginController {
    public function authenticate($username, $password) {
        $db = Database::getConnection();

        $stmt = $db->prepare("
        SELECT user_id, user_type, username, first_name, password
        FROM users
        WHERE username = ? OR email = ?
    ");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_array(MYSQLI_ASSOC);

            if ($this->verifyPassword($password, $user['password'])) {
                return [
                    'id' => $user['user_id'],
                    'role' => $user['user_type'],
                    'username' => $user['username'],
                    'first_name' => $user['first_name']
                ];
            }
        }

        return false;
    }

    private function verifyPassword($password, $password_hash) {
        $hashed_input_password = hash('sha256', $password);

        return $hashed_input_password === $password_hash;
    }
}
?>
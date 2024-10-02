<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function createTeller($first_name, $last_name, $username, $email, $password, $created_by) {
        $stmt = $this->db->prepare("CALL create_user(?, ?, ?, ?, ?, 'teller', NULL, NULL, ?)");

        $stmt->bind_param('sssssi', $first_name, $last_name, $username, $email, $password, $created_by);

        return $stmt->execute();
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("
            SELECT u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.user_type, u.status, u.created_at, 
                   CONCAT(c.first_name, ' ', c.last_name) AS created_by
            FROM users u
            LEFT JOIN users c ON u.created_by = c.user_id");

        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        return $users;
    }

    public function getUsersByRole($role) {
        $stmt = $this->db->prepare("
            SELECT u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.user_type, u.status, u.created_at, 
                   CONCAT(c.first_name, ' ', c.last_name) AS created_by
            FROM users u
            LEFT JOIN users c ON u.created_by = c.user_id
            WHERE u.user_type = ?");

        $stmt->bind_param('s', $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        return $users;
    }

    public function updateUserStatus($user_id, $status) {
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE user_id = ?");
        $stmt->bind_param('si', $status, $user_id);
        return $stmt->execute();
    }

    public function updateUser($user_id, $first_name, $last_name, $new_password = null) {
        if ($new_password) {
            $stmt = $this->db->prepare("UPDATE users SET first_name = ?, last_name = ?, password = ? WHERE user_id = ?");
            $stmt->bind_param('sssi', $first_name, $last_name, $new_password, $user_id);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ?");
            $stmt->bind_param('ssi', $first_name, $last_name, $user_id);
        }

        return $stmt->execute();
    }

    public function getUserById($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    public function blockUserById($user_id) {
        $stmt = $this->db->prepare("UPDATE users SET status = 'blocked' WHERE user_id = ?");
        $stmt->bind_param('i', $user_id);
        return $stmt->execute();
    }
}
?>

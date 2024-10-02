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

    public function updateUserTeller($user_id, $dpi, $new_password = null) {
        if ($new_password) {
            $hashed_password = hash('sha256', $new_password);
            $stmt = $this->db->prepare("UPDATE users SET dpi = ?, password = ? WHERE user_id = ?");
            $stmt->bind_param('ssi', $dpi, $hashed_password, $user_id);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET dpi = ? WHERE user_id = ?");
            $stmt->bind_param('si', $dpi, $user_id);
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

    public function createCustomer($account_name, $account_number, $email, $dpi, $created_by, $initial_balance = 0) {
        $name_parts = explode(' ', $account_name, 2);
        $first_name = $name_parts[0];
        $last_name = isset($name_parts[1]) ? $name_parts[1] : '';

        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];
        } else {
            $stmt = $this->db->prepare("CALL create_user(?, ?, ?, ?, NULL, 'customer', 'active', NOW(), ?)");
            $stmt->bind_param("ssssi", $first_name, $last_name, $email, $email, $created_by);
            $stmt->execute();
            $user_id = $this->db->insert_id;
        }

        if (!$user_id) {
            return false;
        }

        $stmt = $this->db->prepare("
        INSERT INTO bank_accounts (account_number, account_name, balance, created_at)
        VALUES (?, ?, ?, NOW())
    ");
        $stmt->bind_param("ssd", $account_number, $account_name, $initial_balance);
        $stmt->execute();

        $account_id = $this->db->insert_id;

        if (!$account_id) {
            return false;
        }

        $stmt = $this->db->prepare("
        INSERT INTO user_accounts (user_id, account_id) VALUES (?, ?)
    ");
        $stmt->bind_param("ii", $user_id, $account_id);

        return $stmt->execute();
    }

    public function updateUserDetails($user_id, $dpi, $new_password = null) {
        if ($new_password) {
            $hashed_password = hash('sha256', $new_password);
            $stmt = $this->db->prepare("UPDATE users SET dpi = ?, password = ? WHERE user_id = ?");
            $stmt->bind_param('ssi', $dpi, $hashed_password, $user_id);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET dpi = ? WHERE user_id = ?");
            $stmt->bind_param('si', $dpi, $user_id);
        }

        return $stmt->execute();
    }
}

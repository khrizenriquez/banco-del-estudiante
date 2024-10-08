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
        WHERE u.user_type = ?
    ");
        $stmt->bind_param('s', $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($users as &$user) {
            $stmt = $this->db->prepare("
            SELECT ba.account_number, ba.balance
            FROM bank_accounts ba
            INNER JOIN user_accounts ua ON ba.account_id = ua.account_id
            WHERE ua.user_id = ?
        ");
            $stmt->bind_param('i', $user['user_id']);
            $stmt->execute();
            $accountsResult = $stmt->get_result();
            $user['accounts'] = $accountsResult->fetch_all(MYSQLI_ASSOC);
        }

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

    public function getCustomerById($user_id) {
        $stmt = $this->db->prepare("
        SELECT u.user_id, u.first_name, u.last_name, u.username, u.email, u.dpi, u.created_at, u.status, u.user_type, 
               ba.account_number, ba.balance
        FROM users u
        LEFT JOIN user_accounts ua ON u.user_id = ua.user_id
        LEFT JOIN bank_accounts ba ON ua.account_id = ba.account_id
        WHERE u.user_id = ? AND u.user_type = 'customer'
    ");

        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
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
        $this->db->begin_transaction();

        try {
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
                $password = NULL;
                $username = $email;

                $stmt = $this->db->prepare("CALL create_user(?, ?, ?, ?, ?, 'customer', 'active', NOW(), ?, ?)");
                $stmt->bind_param("sssssis", $first_name, $last_name, $username, $email, $password, $created_by, $dpi);
                $stmt->execute();

                $stmt = $this->db->prepare("SELECT user_id FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows === 1) {
                    $user = $result->fetch_assoc();
                    $user_id = $user['user_id'];
                } else {
                    throw new Exception("Error al crear o recuperar usuario.");
                }
            }

            if (!$user_id) {
                throw new Exception("Error al crear o recuperar usuario.");
            }

            $stmt = $this->db->prepare("
            INSERT INTO bank_accounts (account_number, account_name, balance, created_at)
            VALUES (?, ?, ?, NOW())
        ");
            $stmt->bind_param("ssd", $account_number, $account_name, $initial_balance);
            $stmt->execute();

            $account_id = $this->db->insert_id;

            if (!$account_id) {
                throw new Exception("Error al crear cuenta bancaria.");
            }

            $stmt = $this->db->prepare("
            INSERT INTO user_accounts (user_id, account_id) VALUES (?, ?)
        ");
            $stmt->bind_param("ii", $user_id, $account_id);
            $stmt->execute();

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
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

    public function getBankAccountByNumber($account_number) {
        $stmt = $this->db->prepare("SELECT * FROM bank_accounts WHERE account_number = ?");
        $stmt->bind_param('s', $account_number);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_object();
    }

    public function depositToAccount($account_number, $amount) {
        $account = $this->getBankAccountByNumber($account_number);

        if (!$account) {
            throw new Exception('Cuenta no encontrada');
        }

        $new_balance = $account->balance + $amount;

        $stmt = $this->db->prepare("UPDATE bank_accounts SET balance = ? WHERE account_number = ?");
        $stmt->bind_param('ds', $new_balance, $account_number);

        return $stmt->execute();
    }

    public function withdrawFromAccount($account_number, $amount) {
        $account = $this->getBankAccountByNumber($account_number);

        if (!$account) {
            throw new Exception('Cuenta no encontrada');
        }

        if ($account->balance < $amount) {
            throw new Exception('Saldo insuficiente');
        }

        $new_balance = $account->balance - $amount;

        $stmt = $this->db->prepare("UPDATE bank_accounts SET balance = ? WHERE account_number = ?");
        $stmt->bind_param('ds', $new_balance, $account_number);

        return $stmt->execute();
    }
}

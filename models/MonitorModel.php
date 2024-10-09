<?php
class MonitorModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAccountsCreatedToday() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM bank_accounts WHERE DATE(created_at) = CURDATE()");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getCustomersRegisteredToday() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM users WHERE user_type = 'customer' AND DATE(created_at) = CURDATE()");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getTransactionsToday() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transactions WHERE DATE(transaction_date) = CURDATE()");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getDepositsToday() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transactions WHERE transaction_type = 'deposit' AND DATE(transaction_date) = CURDATE()");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getWithdrawalsToday() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transactions WHERE transaction_type = 'withdrawal' AND DATE(transaction_date) = CURDATE()");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getAccountsCreatedThisMonth() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM bank_accounts WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getCustomersRegisteredThisMonth() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM users WHERE user_type = 'customer' AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getTransactionsThisMonth() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transactions WHERE MONTH(transaction_date) = MONTH(CURDATE()) AND YEAR(transaction_date) = YEAR(CURDATE())");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getDepositsThisMonth() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transactions WHERE transaction_type = 'deposit' AND MONTH(transaction_date) = MONTH(CURDATE())");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getWithdrawalsThisMonth() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transactions WHERE transaction_type = 'withdrawal' AND MONTH(transaction_date) = MONTH(CURDATE())");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
}

?>
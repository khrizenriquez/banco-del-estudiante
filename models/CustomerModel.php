<?php

class CustomerModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function registerCustomer($account_number, $email, $dpi, $password, $confirm_password) {
        $stmt = $this->db->prepare("CALL register_customer(?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $account_number, $email, $dpi, $password, $confirm_password);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Error al registrar o actualizar el usuario.");
        }
    }

    public function getCustomerAccounts($user_id) {
        $stmt = $this->db->prepare("
        SELECT ba.account_number, ba.account_name, ba.balance, tpa.alias
        FROM bank_accounts ba
        INNER JOIN user_accounts ua ON ba.account_id = ua.account_id
        LEFT JOIN third_party_accounts tpa ON ba.account_id = tpa.account_id
        WHERE ua.user_id = ?
    ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAccountStatement($user_id) {
        $stmt = $this->db->prepare("
            SELECT t.transaction_date, t.transaction_type, t.amount, 
                   IF(t.transaction_type = 'transfer', ba.account_number, 'N/A') AS account_number
            FROM transactions t
            LEFT JOIN bank_accounts ba ON t.destination_account_id = ba.account_id
            WHERE t.user_id = ?
            ORDER BY t.transaction_date DESC
        ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalBalance($user_id) {
        $stmt = $this->db->prepare("
        SELECT SUM(t.balance) as total_balance
        FROM (
            SELECT ba.account_id, 
            (COALESCE(SUM(CASE WHEN t.transaction_type = 'deposit' THEN t.amount ELSE 0 END), 0) -
             COALESCE(SUM(CASE WHEN t.transaction_type IN ('withdrawal', 'transfer') THEN t.amount ELSE 0 END), 0)) AS balance
            FROM bank_accounts ba
            LEFT JOIN transactions t ON ba.account_id = t.source_account_id OR ba.account_id = t.destination_account_id
            INNER JOIN user_accounts ua ON ba.account_id = ua.account_id
            WHERE ua.user_id = ?
            GROUP BY ba.account_id
        ) AS t
    ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result['total_balance'];
    }

    public function getAccountTransactions($user_id) {
        $stmt = $this->db->prepare("
        SELECT t.transaction_date, t.transaction_type, t.amount,
               sa.account_number AS source_account_number, 
               da.account_number AS destination_account_number,
               IF(sa.account_id IS NULL, 'third_party', 'bank_account') AS source_account_type,
               IF(da.account_id IS NULL, 'third_party', 'bank_account') AS destination_account_type
        FROM transactions t
        LEFT JOIN bank_accounts sa ON t.source_account_id = sa.account_id
        LEFT JOIN bank_accounts da ON t.destination_account_id = da.account_id
        WHERE t.user_id = ?
        ORDER BY t.transaction_date DESC
    ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addThirdPartyAccount($user_id, $account_number, $alias, $max_amount, $max_transactions) {
        $stmt = $this->db->prepare("
        SELECT account_id FROM bank_accounts WHERE account_number = ?
    ");
        $stmt->bind_param('s', $account_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $account = $result->fetch_assoc();
            $account_id = $account['account_id'];
        } else {
            $stmt = $this->db->prepare("
            INSERT INTO bank_accounts (account_number, account_name, balance) 
            VALUES (?, 'Cuenta de terceros', 0.00)
        ");
            $stmt->bind_param('s', $account_number);
            $stmt->execute();

            $account_id = $this->db->insert_id;
        }

        $stmt = $this->db->prepare("
        INSERT INTO third_party_accounts (user_id, account_id, alias, max_amount, daily_transaction_limit)
        VALUES (?, ?, ?, ?, ?)
    ");
        $stmt->bind_param('iisdi', $user_id, $account_id, $alias, $max_amount, $max_transactions);

        if (!$stmt->execute()) {
            throw new Exception("Error al agregar la cuenta de terceros.");
        }

        return true;
    }

    public function getThirdPartyAccounts($user_id) {
        $stmt = $this->db->prepare("
        SELECT tpa.third_party_id, ba.account_number, tpa.alias, tpa.max_amount, tpa.daily_transaction_limit
        FROM third_party_accounts tpa
        INNER JOIN bank_accounts ba ON tpa.account_id = ba.account_id
        WHERE tpa.user_id = ?
    ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserAccounts($user_id) {
        $stmt = $this->db->prepare("
        SELECT ba.account_id, ba.account_number, ba.account_name, ba.balance
        FROM bank_accounts ba
        INNER JOIN user_accounts ua ON ba.account_id = ua.account_id
        WHERE ua.user_id = ?
    ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getThirdPartyAccountById($third_party_account_id) {
        $stmt = $this->db->prepare("SELECT * FROM third_party_accounts WHERE third_party_id = ?");
        $stmt->bind_param("i", $third_party_account_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getTodayTransactions($user_id, $third_party_account_id) {
        $stmt = $this->db->prepare("
        SELECT * FROM transactions
        WHERE user_id = ? 
        AND destination_account_id = ?
        AND DATE(transaction_date) = CURDATE()
    ");
        $stmt->bind_param('ii', $user_id, $third_party_account_id);
        $stmt->execute();

        $result = $stmt->get_result();

        // Si no hay resultados, devuelve un arreglo vacío
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return []; // Devuelve un arreglo vacío si no hay transacciones
        }
    }


    public function executeTransfer($source_account_id, $destination_account_id, $amount, $user_id) {
        $stmt = $this->db->prepare("
        INSERT INTO transactions (transaction_type, source_account_id, destination_account_id, amount, user_id, transaction_date)
        VALUES ('transfer', ?, ?, ?, ?, NOW())
    ");
        $stmt->bind_param('iiis', $source_account_id, $destination_account_id, $amount, $user_id);
        return $stmt->execute();
    }

    public function bankAccountExists($account_id) {
        $stmt = $this->db->prepare("SELECT account_id FROM bank_accounts WHERE account_id = ?");
        $stmt->bind_param('i', $account_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function transferToThirdParty($source_account_id, $third_party_account_id, $amount, $user_id) {
        $this->db->begin_transaction();

        try {
            $insertTransaction = $this->db->prepare("
            INSERT INTO transactions (transaction_type, source_account_id, destination_account_id, amount, user_id)
            VALUES ('transfer', ?, ?, ?, ?)
        ");
            $insertTransaction->bind_param('iidi', $source_account_id, $third_party_account_id, $amount, $user_id);
            $insertTransaction->execute();

            $this->db->commit();

            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    public function getAccountBalance($account_id) {
        $stmt = $this->db->prepare("
        SELECT 
            COALESCE(SUM(CASE 
                WHEN t.transaction_type = 'deposit' THEN t.amount 
                WHEN t.transaction_type = 'withdrawal' THEN -t.amount 
                WHEN t.transaction_type = 'transfer' AND t.source_account_id = ? THEN -t.amount 
                WHEN t.transaction_type = 'transfer' AND t.destination_account_id = ? THEN t.amount 
                ELSE 0 END), 0) AS balance
        FROM transactions t
        WHERE t.source_account_id = ? OR t.destination_account_id = ?
    ");
        $stmt->bind_param('iiii', $account_id, $account_id, $account_id, $account_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        return $result['balance'];
    }
}

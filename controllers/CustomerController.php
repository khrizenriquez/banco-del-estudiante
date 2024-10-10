<?php
require_once 'session_check.php';
require_once 'config/config.php';
require_once 'models/UserModel.php';
class CustomerController {
    public function __construct() {
        @session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
            header('Location: ' . BASE_PATH . '/login?error=unauthorized');
            exit();
        }
    }

    public function createUser() {
        include 'views/user/create_user.php';
    }

    public function createAccount() {
        include 'views/user/create_account.php';
    }

    public function viewAccounts() {
        include 'views/user/view_accounts.php';
    }

    public function viewUsers() {
        include 'views/user/view_users.php';
    }

    public function viewTransfer() {
        $user_id = $_SESSION['user_id'];
        $customerModel = new CustomerModel();

        $user_accounts = $customerModel->getUserAccounts($user_id);
        $third_party_accounts = $customerModel->getThirdPartyAccounts($user_id);

        include 'views/user/transfer.php';
    }


    public function showAddThirdPartyForm() {
        include 'views/user/add_third_party_account.php';
    }

    public function showAccountDetails($account_number) {
        $user_id = $_SESSION['user_id'];
        $customerModel = new CustomerModel();
        $account = $customerModel->getAccountDetails($user_id, $account_number);

        if (!$account) {
            header('Location: ' . BASE_PATH . '/user/dashboard?error=account_not_found');
            exit();
        }

        include 'views/user/account_details.php';
    }

    public function showAccountStatement() {
        @session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_PATH . '/login?error=not_logged_in');
            exit();
        }

        $user_id = $_SESSION['user_id'];

        $transactions = $this->customerModel->getAccountStatement($user_id);

        $total_balance = $this->customerModel->getTotalBalance($user_id);

        include 'views/user/account_statement.php';
    }

    public function viewAccountStatement() {
        $user_id = $_SESSION['user_id'];
        $customerModel = new CustomerModel();

        $transactions = $customerModel->getAccountTransactions($user_id);
        $total_balance = $customerModel->getTotalBalance($user_id);

        include 'views/user/account_statement.php';
    }

    public function addThirdPartyAccount() {
        @session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_PATH . '/login?error=not_logged_in');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $account_number = $_POST['account_number'];
        $alias = $_POST['alias'];
        $max_amount = $_POST['max_amount'];
        $max_transactions = $_POST['max_transactions'];

        try {
            $customerModel = new CustomerModel();
            $result = $customerModel->addThirdPartyAccount($user_id, $account_number, $alias, $max_amount, $max_transactions);

            if ($result) {
                header('Location: ' . BASE_PATH . '/user/agregar-cuentas-de-terceros?success=third_party_added');
            } else {
                header('Location: ' . BASE_PATH . '/user/agregar-cuentas-de-terceros?error=add_failed');
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
            exit();
            header('Location: ' . BASE_PATH . '/user/agregar-cuentas-de-terceros?error=add_failed');
        }

        exit();
    }

    public function showManageAccounts() {
        $customerModel = new CustomerModel();
        $user_id = $_SESSION['user_id'];

        $user_accounts = $customerModel->getUserAccounts($user_id);

        foreach ($user_accounts as &$account) {
            $account['balance'] = $customerModel->getAccountBalance($account['account_id']);
        }

        $third_party_accounts = $customerModel->getThirdPartyAccounts($user_id);

        include 'views/user/dashboard.php';
    }

    public function handleTransfer() {
        @session_start();

        // Validar que el usuario esté logueado
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_PATH . '/login?error=not_logged_in');
            exit();
        }

        $user_id = $_SESSION['user_id'];
        $source_account_id = isset($_POST['source_account_id']) ? $_POST['source_account_id'] : null;
        $third_party_account_id = isset($_POST['third_party_account_id']) ? $_POST['third_party_account_id'] : null;
        $transfer_amount = isset($_POST['transfer_amount']) ? floatval($_POST['transfer_amount']) : null;

        if ($source_account_id === null || $third_party_account_id === null || $transfer_amount === null) {
            header('Location: ' . BASE_PATH . '/user/transferencia-a-terceros?error=missing_data');
            exit();
        }

        try {
            $customerModel = new CustomerModel();

            // Obtener la cuenta de terceros seleccionada
            $third_party_account = $customerModel->getThirdPartyAccountById($third_party_account_id);

            // Validar que la cuenta de terceros exista
            if (!$third_party_account) {
                header('Location: ' . BASE_PATH . '/user/transferencia-a-terceros?error=third_party_not_found');
                exit();
            }

            // Validar que el monto no exceda el máximo permitido
            if ($transfer_amount > $third_party_account['max_amount']) {
                header('Location: ' . BASE_PATH . '/user/transferencia-a-terceros?error=max_amount_exceeded');
                exit();
            }

            // Obtener transacciones realizadas hoy
            $today_transactions = $customerModel->getTodayTransactions($user_id, $third_party_account_id);

            // Asegurarse de que $today_transactions es un arreglo
            if (!is_array($today_transactions)) {
                $today_transactions = [];
            }

            // Validar el límite de transacciones diarias
            if (count($today_transactions) >= $third_party_account['daily_transaction_limit']) {
                header('Location: ' . BASE_PATH . '/user/transferencia-a-terceros?error=transaction_limit_exceeded');
                exit();
            }

            // Realizar la transferencia
            $result = $customerModel->transferToThirdParty($source_account_id, $third_party_account['account_id'], $transfer_amount, $user_id);

            if ($result) {
                header('Location: ' . BASE_PATH . '/user/transferencia-a-terceros?success=transfer_completed');
            } else {
                header('Location: ' . BASE_PATH . '/user/transferencia-a-terceros?error=transfer_failed');
            }

        } catch (Exception $e) {
            header('Location: ' . BASE_PATH . '/user/transferencia-a-terceros?error=' . urlencode($e->getMessage()));
        }

        exit();
    }

}
?>
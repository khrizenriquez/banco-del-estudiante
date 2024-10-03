<?php
require_once 'session_check.php';
class TellerController {
    public function __construct() {
        if ($_SESSION['role'] !== 'teller') {
            header('Location: ' . BASE_PATH . '/login?error=unauthorized');
            exit();
        }
    }

    public function showDashboard() {
        $userModel = new UserModel();
        $users = $userModel->getUsersByRole('customer');
        include 'views/teller/dashboard.php';
    }

    public function showCreateAccount() {
        include 'views/teller/create_account.php';
    }

    public function showDeposit() {
        include 'views/teller/deposit.php';
    }

    public function showWithdraw() {
        include 'views/teller/withdraw.php';
    }

    public function showEditUser($user_id) {
        $userModel = new UserModel();
        $user = $userModel->getCustomerById($user_id);

        if (!$user) {
            header('Location: ' . BASE_PATH . '/teller/dashboard?error=user_not_found');
            exit();
        }

        if ($user->user_type === 'admin') {
            header('Location: ' . BASE_PATH . '/teller/dashboard?error=edit_admin_not_allowed');
            exit();
        }

        include 'views/teller/edit_account.php';
    }

    public function updateUser() {
        $user_id = $_POST['user_id'];
        $dpi = $_POST['dpi'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];

        if (!empty($new_password) && $new_password !== $confirm_new_password) {
            header('Location: ' . BASE_PATH . '/teller/usuarios/' . $user_id . '?error=password_mismatch');
            exit();
        }

        $userModel = new UserModel();

        $resultUser = $userModel->updateUserDetails($user_id, $dpi, $new_password);

        if ($resultUser) {
            header('Location: ' . BASE_PATH . '/teller/dashboard?success=user_updated');
        } else {
            header('Location: ' . BASE_PATH . '/teller/usuarios/' . $user_id . '?error=update_failed');
        }
        exit();
    }


    private function getDummyUser($id) {
        return (object) [
            'user_id' => $id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'account_number' => '12312312312',
            'username' => 'johndoe@example.com',
            'dpi' => '1234567890123',
            'status' => 'active',
            'created_at' => '2023-09-20 10:00:00'
        ];
    }

    private function updateUserStatus($id, $status) {
        $pdo = new PDO('mysql:host=localhost;dbname=Proyecto_2_Desarrollo_Web', 'root', '');
        $stmt = $pdo->prepare('UPDATE users SET status = ? WHERE user_id = ?');
        $stmt->execute([$status, $id]);
    }

    private function getUserById($id) {
        $pdo = new PDO('mysql:host=localhost;dbname=Proyecto_2_Desarrollo_Web', 'root', '');
        $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

//    public function storeAccount() {
//        $account_name = $_POST['account_name'];
//        $account_number = $_POST['account_number'];
//        $email = $_POST['email'];
//        $dpi = $_POST['dpi'];
//        $initial_balance = $_POST['initial_balance'];
//        $created_by = $_SESSION['user_id'];
//
//        if (empty($account_name) || empty($account_number) || empty($email) || empty($dpi) || empty($initial_balance)) {
//            header('Location: ' . BASE_PATH . '/teller/create-account?error=missing_fields');
//            exit();
//        }
//
//        $userModel = new UserModel();
//        $result = $userModel->createCustomer($account_name, $account_number, $email, $dpi, $created_by, $initial_balance);
//
//        if ($result) {
//            header('Location: ' . BASE_PATH . '/teller/dashboard?success=account_created');
//        } else {
//            header('Location: ' . BASE_PATH . '/teller/create-account?error=create_failed');
//        }
//        exit();
//    }

    public function storeAccount() {
        $account_name = $_POST['account_name'];
        $account_number = $_POST['account_number'];
        $email = $_POST['email'];
        $dpi = $_POST['dpi'];
        $initial_balance = $_POST['initial_balance'];
        $created_by = $_SESSION['user_id'];

        if (empty($account_name) || empty($account_number) || empty($email) || empty($dpi) || empty($initial_balance)) {
            header('Location: ' . BASE_PATH . '/teller/create-account?error=missing_fields');
            exit();
        }

        try {
            $userModel = new UserModel();
            $result = $userModel->createCustomer($account_name, $account_number, $email, $dpi, $created_by, $initial_balance);

            if ($result) {
                header('Location: ' . BASE_PATH . '/teller/dashboard?success=account_created');
            } else {
                header('Location: ' . BASE_PATH . '/teller/usuarios?error=create_failed');
            }
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                header('Location: ' . BASE_PATH . '/teller/usuarios?error=duplicate_account');
            } else {
                header('Location: ' . BASE_PATH . '/teller/usuarios?error=unexpected_error');
            }
        }

        exit();
    }

}
?>

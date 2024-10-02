<?php
require_once 'session_check.php';
require_once 'models/UserModel.php';

class AdminController {
    public function __construct() {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_PATH . '/login?error=unauthorized');
            exit();
        }
    }

    public function dashboard() {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();
        include 'views/admin/dashboard.php';
    }

    public function createUser() {
        include 'views/admin/create_users.php';
    }

    public function createAccount() {
        include 'views/admin/create_account.php';
    }

    public function viewAccounts() {
        include 'views/admin/view_accounts.php';
    }

    public function viewUsers() {
        include 'views/admin/view_users.php';
    }

    public function editUser($user_id) {
        $userModel = new UserModel();
        $user = $userModel->getUserById($user_id);

        if (!$user) {
            header('Location: '.BASE_PATH.'/admin/dashboard?error=user_not_found');
            exit();
        }

        //  Temporal dummy data
        //$user = $this->getDummyUser($id);

        if ($user->user_type === 'admin') {
            header('Location: '.BASE_PATH.'/admin/dashboard?error=edit_admin_not_allowed');
            exit();
        }
        include 'views/admin/edit_users.php';
    }

    private function getDummyUser($id) {
        return (object) [
            'user_id' => $id,
            'first_name' => 'Fulano',
            'last_name' => 'de Tal',
            'account_number' => '12312312312',
            'username' => 'fulanito@example.com',
            'dpi' => '1234567890123',
            'status' => 'active',
            'created_at' => '2023-09-20 10:00:00'
        ];
    }

    public function createTeller() {
        $first_name = $_POST['account_name'];
        $last_name = $_POST['account_lastname'];
        $username = $_POST['account_user'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // The best option is validate the data before send it to the database
        if ($password !== $confirm_password) {
            header('Location: '.BASE_PATH.'/admin/create-teller?error=password_mismatch');
            exit();
        }

        $created_by = $_SESSION['user_id'];

        $userModel = new UserModel();
        $result = $userModel->createTeller($first_name, $last_name, $username, $email, $password, $created_by);

        if ($result) {
            header('Location: '.BASE_PATH.'/admin/dashboard?success=teller_created');
        } else {
            header('Location: '.BASE_PATH.'/admin/create-teller?error=create_failed');
        }
        exit();
    }

    public function updateUser() {
        $user_id = $_POST['user_id'];
        $account_name = $_POST['account_name'];
        $account_lastname = $_POST['account_lastname'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];

        if (!empty($new_password) && $new_password !== $confirm_new_password) {
            header('Location: '.BASE_PATH.'/admin/usuarios/'.$user_id.'?error=password_mismatch');
            exit();
        }

        $userModel = new UserModel();
        $result = $userModel->updateUser($user_id, $account_name, $account_lastname, $new_password);

        if ($result) {
            header('Location: '.BASE_PATH.'/admin/dashboard?success=user_updated');
        } else {
            header('Location: '.BASE_PATH.'/admin/usuarios/'.$user_id.'?error=update_failed');
        }
        exit();
    }

    public function blockUser($user_id) {
        $userModel = new UserModel();

        $user = $userModel->getUserById($user_id);

        if (!$user || $user->status === 'blocked') {
            header('Location: ' . BASE_PATH . '/admin/dashboard?error=user_not_found_or_already_blocked');
            exit();
        }

        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_PATH . '/admin/dashboard?error=unauthorized');
            exit();
        }

        $result = $userModel->blockUserById($user_id);

        if ($result) {
            header('Location: ' . BASE_PATH . '/admin/dashboard?success=user_blocked');
        } else {
            header('Location: ' . BASE_PATH . '/admin/dashboard?error=block_failed');
        }
        exit();
    }

    public function toggleUserStatus($user_id) {
        $userModel = new UserModel();

        $user = $userModel->getUserById($user_id);

        if (!$user) {
            header('Location: ' . BASE_PATH . '/admin/dashboard?error=user_not_found');
            exit();
        }

        if ($_SESSION['role'] !== 'admin') {
            header('Location: ' . BASE_PATH . '/admin/dashboard?error=unauthorized');
            exit();
        }

        if ($user->status === 'active') {
            $result = $userModel->updateUserStatus($user_id, 'blocked');
            $message = $result ? 'user_blocked' : 'block_failed';
        } else if ($user->status === 'blocked') {
            $result = $userModel->updateUserStatus($user_id, 'active');
            $message = $result ? 'user_unblocked' : 'unblock_failed';
        }

        header('Location: ' . BASE_PATH . '/admin/dashboard?success=' . $message);
        exit();
    }
}

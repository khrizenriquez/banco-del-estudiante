<?php

class AdminController {
    public function __construct() {
//        session_start();
//        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//            header('Location: index.php?action=login&error=unauthorized');
//            exit();
//        }
    }

    public function dashboard() {
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

    public function editUser($id) {
        //$user = $this->getUserById($id);
        $user = $this->getDummyUser($id);

        if ($user) {
            include 'views/admin/edit_users.php';
        } else {
            echo "Usuario no encontrado.";
        }
    }

    public function blockUser($id) {
        $user = $this->getDummyUser($id);

        if ($user) {
            //$this->updateUserStatus($id, 'blocked');
            echo "El usuario ha sido bloqueado correctamente.";
        } else {
            echo "Usuario no encontrado.";
        }
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
}
?>
<?php
require_once 'session_check.php';
class TellerController {
    public function __construct() {
        if ($_SESSION['role'] !== 'teller') {
            header('Location: ' . BASE_PATH . '/login?error=unauthorized');
            exit();
        }
    }

    public function dashboard() {
        include 'views/teller/dashboard.php';
    }

    public function createAccount() {
        include 'views/teller/create_account.php';
    }

    public function deposit() {
        include 'views/teller/deposit.php';
    }

    public function withdraw() {
        include 'views/teller/withdraw.php';
    }

    public function editUser($id) {
        //$user = $this->getUserById($id);
        $user = $this->getDummyUser($id);

        if ($user) {
            include 'views/teller/edit_account.php';
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
}
?>

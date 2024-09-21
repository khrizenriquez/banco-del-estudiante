<?php
class UserController {
    public function authenticate($username, $password, $password_hash, $id, $role) {
        // Conectar a la base de datos y verificar las credenciales
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT id, role, password_hash FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $stmt->bind_result($id, $role, $password_hash);
        $stmt->fetch();

        if ($id && password_verify($password, $password_hash)) {
            return ['id' => $id, 'role' => $role];
        } else {
            return false;
        }
    }

    // Otros métodos del modelo de usuario
}

?>
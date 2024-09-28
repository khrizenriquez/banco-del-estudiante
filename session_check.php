<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('Location: index.php?action=login');
    exit();
}

switch ($_SESSION['role']) {
    case 'admin':
        break;

    case 'teller':
        if (!in_array($action, ['teller_dashboard', 'teller_usuarios', 'teller_depositos', 'teller_retiros'])) {
            header('Location: index.php?action=teller_dashboard&error=access_denied');
            exit();
        }
        break;

    case 'customer':
        if (!in_array($action, ['user_dashboard', 'user_transferencia_a_terceros', 'user_agregar_cuentas_de_terceros', 'user_estado_de_cuenta'])) {
            header('Location: index.php?action=user_dashboard&error=access_denied');
            exit();
        }
        break;

    default:
        session_destroy();
        header('Location: index.php?action=login&error=invalid_role');
        exit();
}
?>
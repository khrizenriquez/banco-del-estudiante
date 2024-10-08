<?php
require_once 'config/config.php';
$routes = require 'config/routes.php';

$user_formatted = $_SESSION['first_name'].' ('.$_SESSION['username'].')';
$user_role = $_SESSION['role'];

$menu_options = ['<i class="fa-solid fa-arrow-right-from-bracket"></i>' => '/logout'];
// Check the routes.php file to know the exact route for each role
if ($user_role === 'admin') {
    $menu_options = array_merge([
        'Gestionar cajeros' => '/admin/dashboard',
        'Crear cajeros' => '/admin/usuarios',
        'Monitor de transferencias' => '/admin/monitor'
    ], $menu_options);
} elseif ($user_role === 'teller') {
    $menu_options = array_merge([
        'Gestionar usuarios' => '/teller/dashboard',
        'Crear usuarios' => '/teller/usuarios',
        'Depositos' => '/teller/depositos',
        'Retiros' => '/teller/retiros',
    ], $menu_options);
} elseif ($user_role === 'customer') {
    $menu_options = array_merge([
        'Gestionar cuentas' => '/user/dashboard',
        'Agregar cuentas de terceros' => '/user/agregar-cuentas-de-terceros',
        'Transferencia a terceros' => '/user/transferencia-a-terceros',
        'Estado de cuenta' => '/user/estado-de-cuenta',
    ], $menu_options);
}

// Helpers variables
$menu_without_last = array_slice($menu_options, 0, -1);
$last_menu_item = end($menu_options);
$last_menu_label = key($menu_options);
?>
<p class="text-center has-background-link-15 has-text-primary-15-invert">🏦 Bienvenido, <?= htmlspecialchars($user_formatted); ?>!</p>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <?php foreach ($menu_without_last as $option => $link): ?>
                <a class="navbar-item" href="<?= BASE_PATH.$link; ?>">
                    <?= htmlspecialchars($option); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-danger" href="<?= BASE_PATH.$last_menu_item; ?>">
                        <strong><?= $last_menu_label; ?></strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

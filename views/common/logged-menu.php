<?php
$routes = require 'config/routes.php';

$user_name = 'John Doe';
$user_role = 'teller';
$local_base_path = '/desarrolloweb/banco-del-estudiante';

$menu_options = ['Cerrar sesión' => '/logout'];
// Check the routes.php file to know the exact route for each role
if ($user_role === 'admin') {
    $menu_options = array_merge([
        'Gestionar cajeros' => '/admin/dashboard',
        'Crear usuarios' => '/admin/dashboard/create',
        'Monitor de transferencias' => '/admin/monitor'
    ], $menu_options);
} elseif ($user_role === 'teller') {
    $menu_options = array_merge([
        'Crear usuarios' => '/teller-dashboard',
        'Gestionar usuarios' => '/teller/crear-usuarios',
        'Depositos' => '/teller/depositos',
        'Retiros' => '/teller/retiros',
    ], $menu_options);
} elseif ($user_role === 'user') {
    $menu_options = array_merge([
        'Gestionar cuentas' => '/user/dashboard',
        'Estado de cuenta' => '/user/estado-de-cuenta',
        'Agregar cuentas de terceros' => '/user/agregar-cuentas-de-terceros',
        'Transferencia a terceros' => '/user/transferencia-a-terceros',
    ], $menu_options);
}

// Helpers variables
$menu_without_last = array_slice($menu_options, 0, -1);
$last_menu_item = end($menu_options);
$last_menu_label = key($menu_options);
?>
<p>🏦 Bienvenido, <?= htmlspecialchars($user_name); ?>!</p>
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
                <a class="navbar-item" href="<?= $local_base_path.$link; ?>">
                    <?= htmlspecialchars($option); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button is-danger" href="<?= $local_base_path.$last_menu_item; ?>">
                        <strong><?= htmlspecialchars($last_menu_label); ?></strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

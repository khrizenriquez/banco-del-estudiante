<?php
$page_title = "Gestionar usuarios :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'user_not_found'): ?>
    <div class="notification is-danger">
        <p>El usuario solicitado no fue encontrado. Por favor, verifica el ID del usuario e inténtalo nuevamente.</p>
    </div>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] === 'edit_admin_not_allowed'): ?>
    <div class="notification is-warning">
        <p>No tienes permiso para editar administradores. Solo los usuarios no administrativos pueden ser modificados.</p>
    </div>
<?php endif; ?>

<section class="container mt-6">
    <div class="table-container">
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>ID de Usuario</th>
                <th>Nombre Completo</th>
                <th>Tipo de Usuario</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['user_id']; ?></td>
                    <td><?= $user['full_name']; ?></td>
                    <td><?= ucfirst($user['user_type']); ?></td>
                    <td><?= ucfirst($user['status']); ?></td>
                    <td><?= $user['created_at']; ?></td>
                    <td><?= $user['created_by'] ?: 'N/A'; ?></td>
                    <td>
                        <?php if ($user['user_type'] !== 'admin'): ?>
                            <a href="<?= BASE_PATH; ?>/admin/usuarios/<?= $user['user_id']; ?>" class="button is-small is-warning">Editar</a>

                            <?php if ($user['status'] === 'active'): ?>
                                <a href="<?= BASE_PATH; ?>/admin/usuarios/<?= $user['user_id']; ?>/toggle-status" class="button is-small is-danger">Bloquear</a>
                            <?php else: ?>
                                <a href="<?= BASE_PATH; ?>/admin/usuarios/<?= $user['user_id']; ?>/toggle-status" class="button is-small is-link">Desbloquear</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

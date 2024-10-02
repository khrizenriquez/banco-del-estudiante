<?php
$page_title = "Gestionar usuarios :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

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
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['user_id']); ?></td>
                        <td><?= htmlspecialchars($user['full_name']); ?></td>
                        <td><?= htmlspecialchars(ucfirst($user['user_type'])); ?></td>
                        <td><?= htmlspecialchars(ucfirst($user['status'])); ?></td>
                        <td><?= htmlspecialchars($user['created_at']); ?></td>
                        <td><?= htmlspecialchars($user['created_by']) ?: 'N/A'; ?></td>
                        <td>
                            <a href="<?= BASE_PATH; ?>/teller/usuarios/<?= htmlspecialchars($user['user_id']); ?>" class="button is-small is-warning">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No se encontraron usuarios.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

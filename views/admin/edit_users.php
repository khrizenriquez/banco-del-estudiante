<?php
$page_title = "Editar Usuario :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'edit_admin_not_allowed'): ?>
    <p class="error">Ocurrió un error.</p>
<?php endif; ?>

<section class="container is-max-tablet mt-6">
    <form action="<?= BASE_PATH; ?>/admin/update-user" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars(@$user->user_id); ?>">

        <div class="field">
            <label class="label has-text-primary-00">Usuario (No Editable)</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_user" value="<?= htmlspecialchars(@$user->username); ?>" disabled>
                <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Nombre</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_name" value="<?= htmlspecialchars(@$user->first_name); ?>" required>
                <span class="icon is-small is-left">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Apellido</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_lastname" value="<?= htmlspecialchars(@$user->last_name); ?>" required>
                <span class="icon is-small is-left">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Nueva Contraseña (Dejar en blanco si no desea cambiar)</label>
            <div class="control has-icons-left">
                <input class="input" type="password" name="new_password" placeholder="Ingrese nueva contraseña (opcional)">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Confirmar Nueva Contraseña</label>
            <div class="control has-icons-left">
                <input class="input" type="password" name="confirm_new_password" placeholder="Confirme la nueva contraseña (opcional)">
                <span class="icon is-small is-left">
                    <i class="fas fa-check-circle"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Guardar Cambios</button>
            </div>
        </div>
    </form>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

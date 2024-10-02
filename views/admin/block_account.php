<?php
$page_title = "Editar usuarios :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container is-max-tablet mt-6">
    <form action="/teller/usuarios/<?= htmlspecialchars($user->user_id); ?>/block" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->user_id); ?>">

        <div class="field">
            <label class="label">Bloquear Usuario</label>
            <p>¿Estás seguro que deseas bloquear a <strong><?= htmlspecialchars($user->first_name . ' ' . $user->last_name); ?></strong>?</p>
        </div>

        <div class="field">
            <button class="button is-danger" type="submit">Bloquear Usuario</button>
        </div>
    </form>

</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

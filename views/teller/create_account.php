<?php
$page_title = "Crear usuarios :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<?php if (isset($_GET['error'])): ?>
    <div class="notification is-danger">
        <?php if ($_GET['error'] === 'duplicate_account'): ?>
            <p>El número de cuenta ya existe. Por favor, elija un número de cuenta diferente.</p>
        <?php elseif ($_GET['error'] === 'missing_fields'): ?>
            <p>Por favor, complete todos los campos.</p>
        <?php else: ?>
            <p>Ocurrió un error inesperado. Por favor, intente nuevamente.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>


<section class="container is-max-tablet mt-6">
    <form action="<?= BASE_PATH; ?>/teller/create-user" method="POST">
        <div class="field">
            <label class="label has-text-primary-00">Nombre de la cuenta</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_name" placeholder="Ingrese el nombre de la cuenta" value="<?= htmlspecialchars($account_name ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <span class="icon is-small is-left">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Número de Cuenta Bancaria</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_number" placeholder="Ingrese el número de cuenta" value="<?= htmlspecialchars($account_number ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-id-card"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Correo Electrónico</label>
            <div class="control has-icons-left">
                <input class="input" type="email" name="email" placeholder="Ingrese el correo electrónico" value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">DPI</label>
            <div class="control has-icons-left">
                <input class="input" type="number" name="dpi" placeholder="Ingrese el DPI" value="<?= htmlspecialchars($dpi ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <span class="icon is-small is-left">
                    <i class="fas fa-id-badge"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Monto Inicial</label>
            <div class="control has-icons-left">
                <input class="input" type="number" name="initial_balance" placeholder="Ingrese el monto inicial" step="0.01" value="<?= htmlspecialchars($initial_balance ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                <span class="icon is-small is-left">
                    <i class="fa-solid fa-money-bills"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Crear Usuario</button>
            </div>
        </div>
    </form>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

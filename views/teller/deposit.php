<?php
$page_title = "Depositos :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<?php if (isset($_GET['error'])): ?>
    <div class="notification is-danger">
        <?= htmlspecialchars($_GET['error']); ?>
    </div>
<?php elseif (isset($_GET['success'])): ?>
    <div class="notification is-success">
        Depósito realizado con éxito.
    </div>
<?php endif; ?>

<section class="container is-max-tablet mt-6">
    <form action="<?= BASE_PATH; ?>/teller/deposito" method="POST">
        <div class="field">
            <label class="label  has-text-primary-00">Número de Cuenta</label>
            <div class="control">
                <input class="input" type="text" name="account_number" placeholder="Ingrese el número de cuenta" required>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Cantidad a Depositar</label>
            <div class="control">
                <input class="input" type="number" name="amount" placeholder="Ingrese la cantidad" step="0.01" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Realizar Depósito</button>
            </div>
        </div>
    </form>
</section>


<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

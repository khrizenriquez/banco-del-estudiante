<?php
$page_title = "Agregar cuentas de terceros :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container is-max-tablet mt-6">
    <h1 class="title">Agregar Cuenta de Terceros</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="notification is-success">
            <?php
            switch ($_GET['success']) {
                case 'third_party_added':
                    echo 'La cuenta de terceros ha sido agregada con éxito.';
                    break;
                default:
                    echo 'Operación realizada con éxito.';
            }
            ?>
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="notification is-danger">
            <?php
            switch ($_GET['error']) {
                case 'add_failed':
                    echo 'Error al agregar la cuenta de terceros. Inténtalo de nuevo.';
                    break;
                case 'La cuenta bancaria no existe.':
                    echo 'La cuenta bancaria ingresada no existe. Por favor verifica los datos.';
                    break;
                case 'invalid_account':
                    echo 'La cuenta ingresada es inválida.';
                    break;
                default:
                    echo 'Ha ocurrido un error inesperado. Por favor, intenta nuevamente.';
            }
            ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_PATH ?>/user/agregar-terceros" method="POST">
        <div class="field">
            <label class="label">Número de Cuenta</label>
            <div class="control">
                <input class="input" type="text" name="account_number" placeholder="Ingrese el número de cuenta" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Monto Máximo a Transferir</label>
            <div class="control">
                <input class="input" type="number" name="max_amount" placeholder="Ingrese el monto máximo" step="0.01" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Cantidad Máxima de Transacciones Diarias</label>
            <div class="control">
                <input class="input" type="number" name="max_transactions" placeholder="Ingrese la cantidad máxima" required>
            </div>
        </div>

        <div class="field">
            <label class="label">Alias de la Cuenta</label>
            <div class="control">
                <input class="input" type="text" name="alias" placeholder="Ingrese un alias para la cuenta" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Agregar Cuenta</button>
            </div>
        </div>
    </form>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

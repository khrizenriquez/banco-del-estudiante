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

    <form action="/user/agregar-cuenta-terceros" method="POST">
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

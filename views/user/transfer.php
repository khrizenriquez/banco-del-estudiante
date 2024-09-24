<?php
$page_title = "Agregar cuentas de terceros :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>


<section class="container is-max-tablet mt-6">
    <h1 class="title">Transferir a Cuenta de Terceros</h1>

    <form action="/user/transferencia-terceros" method="POST">
        <div class="field">
            <label class="label">Seleccionar Cuenta de Terceros</label>
            <div class="control">
                <div class="select">
                    <select name="third_party_account_id" required>
                        <option value="1">Cuenta 1 (Alias: Cuenta Personal)</option>
                        <option value="2">Cuenta 2 (Alias: Ahorros)</option>
                        <option value="3">Cuenta 3 (Alias: Emergencias)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label">Cantidad a Transferir</label>
            <div class="control">
                <input class="input" type="number" name="transfer_amount" placeholder="Ingrese la cantidad" step="0.01" required>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Transferir</button>
            </div>
        </div>
    </form>
</section>




<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

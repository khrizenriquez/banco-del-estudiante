<?php
$page_title = "Crear usuarios :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container is-max-tablet mt-6">
    <form action="/teller/create-user" method="POST">
        <div class="field">
            <label class="label has-text-primary-00">Nombre de la cuenta</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_name" placeholder="Ingrese el nombre de la cuenta" required>
                <span class="icon is-small is-left">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Número de Cuenta Bancaria</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_number" placeholder="Ingrese el número de cuenta" required>
                <span class="icon is-small is-left">
                <i class="fas fa-id-card"></i>
            </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Correo Electrónico</label>
            <div class="control has-icons-left">
                <input class="input" type="email" name="email" placeholder="Ingrese el correo electrónico" required>
                <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
            </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">DPI</label>
            <div class="control has-icons-left">
                <input class="input" type="number" name="dpi" placeholder="Ingrese el DPI" required>
                <span class="icon is-small is-left">
                <i class="fas fa-id-badge"></i>
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

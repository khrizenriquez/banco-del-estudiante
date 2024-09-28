<?php
$page_title = "Crear cajeros :: Banco del estudiante";
require_once './views/common/logged-header.php';
?>

<body class="theme-light">

<?php
require_once './views/common/logged-menu.php';
?>

<section class="container is-max-tablet mt-6">
    <form action="/teller/create-user" method="POST">
        <div class="field">
            <label class="label has-text-primary-00">Nombre del cajero</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_name" placeholder="Ingrese el nombre de la cuenta" required>
                <span class="icon is-small is-left">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Usuario</label>
            <div class="control has-icons-left">
                <input class="input" type="text" name="account_user" placeholder="Ingrese el nombre del usuario" required>
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
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
            <label class="label has-text-primary-00">Contraseña</label>
            <div class="control has-icons-left">
                <input class="input" type="password" name="password" placeholder="Ingrese la contraseña" required>
                <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
            </div>
        </div>

        <div class="field">
            <label class="label has-text-primary-00">Confirmar Contraseña</label>
            <div class="control has-icons-left">
                <input class="input" type="password" name="confirm_password" placeholder="Confirme la contraseña" required>
                <span class="icon is-small is-left">
                <i class="fas fa-check-circle"></i>
            </span>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Crear cajeros</button>
            </div>
        </div>
    </form>
</section>

<?php
require_once './views/common/logged-scripts.php';
?>
</body>
</html>

<?php
require_once './views/common/header.php';
?>
<body class="theme-light">

<section class="section">
    <div class="container login-container">
        <div class="box">
            <img class="logo" src="./assets/images/umg-logo.png" alt="Logo">
            <h1 class="title">Crear cuenta</h1>
            <form action="/register" method="POST">
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="Número de cuenta" name="account_number" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="email" placeholder="Correo" name="email" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="DPI" name="dpi" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="password" placeholder="Clave" name="password" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="password" placeholder="Confirmar Clave" name="confirm_password" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="button is-primary is-fullwidth" type="submit" value="Registrar">
                    </div>
                </div>
            </form>
            <a href="<?= $local_base_path; ?>/login">¿Ya tienes cuenta? Iniciar sesión</a>
        </div>
    </div>
</section>

</body>
</html>

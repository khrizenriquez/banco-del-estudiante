<?php
$page_title = "Banco del estudiante :: Olvidé la contraseña";
require_once './views/common/header.php';
?>
<body class="theme-light">
<section class="section">
    <div class="container login-container">
        <div class="box">
            <img class="logo" src="<?= BASE_PATH; ?>/assets/images/umg-logo.png" alt="Logo">
            <h1 class="title">Olvidé la contraseña</h1>
            <form action="/forgot-password" method="POST">
                <div class="field">
                    <div class="control">
                        <input class="input" type="email" placeholder="Correo" name="email" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="button is-primary is-fullwidth" type="submit" value="Enviar">
                    </div>
                </div>
            </form>
            <a href="<?= BASE_PATH; ?>/login">Regresar al inicio de sesión</a>
        </div>
    </div>
</section>
</body>
</html>

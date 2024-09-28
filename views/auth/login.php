<?php
$page_title = "Banco del estudiante :: Inicio de sesión";
require_once './views/common/header.php';
?>
<body class="theme-light">

<section class="section">
    <div class="container login-container">
        <div class="box">
            <img class="logo" src="./assets/images/umg-logo.png" alt="Logo">
            <h1 class="title">Inicia sesión</h1>
            <form action="/login" method="POST">
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="Correo" name="email" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="password" placeholder="Clave" name="password" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="button is-primary is-fullwidth" type="submit" value="Iniciar sesión">
                    </div>
                </div>
            </form>
            <a href="<?= $local_base_path; ?>/forgot-password">¿Olvidaste tú contraseña?</a>
            <a href="<?= $local_base_path; ?>/register">Crear cuenta</a>
        </div>
    </div>
</section>

</body>
</html>

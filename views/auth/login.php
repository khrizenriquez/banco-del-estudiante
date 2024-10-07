<?php
$page_title = "Banco del estudiante :: Inicio de sesión";
require_once './views/common/header.php';
?>
<body class="theme-light">

<section class="section">
    <div class="container login-container">
        <div class="box">
            <img class="logo" src="<?= BASE_PATH; ?>/assets/images/umg-logo.png" alt="Logo">
            <h1 class="title">Inicia sesión</h1>

            <?php if (isset($_GET['error'])): ?>
                <div class="notification is-danger">
                    <?php
                    switch ($_GET['error']) {
                        case 'unauthorized':
                            echo 'Acceso no autorizado. Inicia sesión para continuar.';
                            break;
                        case 'invalid_credentials':
                            echo 'Credenciales inválidas. Verifica tu correo y contraseña.';
                            break;
                        case 'invalid_role':
                            echo 'Rol inválido. Comunícate con el administrador.';
                            break;
                        case 'not_logged_in':
                            echo 'Debes iniciar sesión para acceder a esta página.';
                            break;
                        default:
                            echo 'Ha ocurrido un error inesperado. Inténtalo de nuevo.';
                    }
                    ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="notification is-success">
                    <?php
                    switch ($_GET['success']) {
                        case 'registered':
                            echo 'Registro exitoso. Ahora puedes iniciar sesión.';
                            break;
                        default:
                            echo 'Operación realizada con éxito.';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_PATH; ?>/login" method="POST">
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="Correo" name="email" required value="toor@miumg.edu.gt">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="password" placeholder="Clave" name="password" required value="toor">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="button is-primary is-fullwidth" type="submit" value="Iniciar sesión">
                    </div>
                </div>
            </form>
            <a href="<?= BASE_PATH; ?>/forgot-password">¿Olvidaste tú contraseña?</a>
            <a href="<?= BASE_PATH; ?>/register">Crear cuenta</a>
        </div>
    </div>
</section>

</body>
</html>

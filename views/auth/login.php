<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link rel="stylesheet" href="./assets/css/vendor/bulma.min.css">

    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>Login</title>
</head>
<body>

<section class="section">
    <div class="container login-container">
        <div class="box">
            <img src="./assets/images/umg-logo.png" alt="Logo">
            <h1 class="title">Sign in</h1>
            <form action="/login" method="POST">
                <div class="field">
                    <div class="control">
                        <input class="input" type="text" placeholder="Email or phone" name="email" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input" type="password" placeholder="Password" name="password" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="button is-primary is-fullwidth" type="submit" value="Next">
                    </div>
                </div>
            </form>
            <a href="/forgot-password">Forgot password?</a>
            <div class="small-text">
                Not your computer? Use Guest mode to sign in privately. <a href="#">Learn more</a>
            </div>
            <a href="/register">Create account</a>
        </div>
    </div>
</section>

</body>
</html>

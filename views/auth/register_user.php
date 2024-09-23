<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link rel="stylesheet" href="./assets/css/vendor/bulma.min.css">

    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #1c1c1c;
            padding: 40px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .register-container h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .register-container img {
            display: block;
            margin: 0 auto 20px;
            width: 80px;
        }

        .register-container input[type="text"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
            background-color: #333;
            border: 1px solid #555;
            color: white;
            border-radius: 4px;
        }

        .register-container input[type="submit"] {
            background-color: #1a73e8;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .register-container input[type="submit"]:hover {
            background-color: #1765c1;
        }

        .register-container a {
            color: #1a73e8;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-top: 10px;
            text-align: center;
        }

    </style>
</head>
<body>

    <section class="section">
        <div class="container login-container">
            <div class="box">
                <img src="./assets/images/umg-logo.png" alt="Logo">
                <h1 class="title">Create Account</h1>
                <form action="/register" method="POST">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="Account Number" name="account_number" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input" type="email" placeholder="Email" name="email" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="DPI" name="dpi" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input" type="password" placeholder="Password" name="password" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="input" type="password" placeholder="Confirm Password" name="confirm_password" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="button is-primary is-fullwidth" type="submit" value="Register">
                        </div>
                    </div>
                </form>
                <a href="/login">Already have an account? Sign in</a>
            </div>
        </div>
    </section>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link rel="stylesheet" href="./assets/css/vendor/bulma.min.css">

    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/login.css">

    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f8fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .forgot-container {
            background-color: white;
            padding: 30px;
            width: 350px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .forgot-container h1 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .forgot-container input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .forgot-container input[type="submit"] {
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

        .forgot-container input[type="submit"]:hover {
            background-color: #1765c1;
        }

        .forgot-container a {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #1a73e8;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <section class="section">
        <div class="container login-container">
            <div class="box">
                <img src="./assets/images/umg-logo.png" alt="Logo">
                <h1 class="title">Forgot Password</h1>
                <form action="/forgot-password" method="POST">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="email" placeholder="Email" name="email" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="button is-primary is-fullwidth" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
                <a href="/login">Back to login</a>
            </div>
        </div>
    </section>
</body>
</html>

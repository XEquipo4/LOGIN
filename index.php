<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
session_unset();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #1A73E8; /* Azul */
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 360px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #1A73E8;
        }

        input {
            width: 92%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #1A73E8;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            margin-top: 12px;
            transition: 0.3s;
        }

        button:hover {
            background: #1259b1;
        }

        .error {
            background: #ffdddd;
            color: #b30000;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2>Iniciar Sesión</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form action="validar_login.php" method="POST">

        <input type="text" name="numero_control"
               placeholder="Número de control" required>

        <input type="password" name="password"
               placeholder="Contraseña" required>

        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>

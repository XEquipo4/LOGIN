<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef1f5;
        }
        .login-box {
            margin-top: 100px;
            padding: 30px;
            border-radius: 15px;
            background: white;
            box-shadow: 0px 4px 18px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 login-box">

            <h3 class="text-center mb-3">Iniciar Sesión</h3>

            <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>

            <form action="validar_login.php" method="POST">

                <label class="form-label">Número de Control</label>
                <input type="text" name="numero_control" class="form-control" required>

                <label class="form-label mt-2">Contraseña</label>
                <input type="password" name="password" class="form-control" required>

                <button class="btn btn-primary w-100 mt-3">Entrar</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-lg p-3">
                <h3 class="text-center">Iniciar Sesión</h3>

                <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
                <?php endif; ?>

                <form action="validar_login.php" method="POST">

                    <label>Número de Control</label>
                    <input type="text" name="numero_control" class="form-control" required>

                    <label class="mt-2">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>

                    <button class="btn btn-primary mt-3 w-100">Entrar</button>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #EAF3FF; /* azul claro */
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: #FFFFFF; /* blanco */
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
        }

        h3 {
            color: #0D6EFD; /* azul principal */
            font-weight: 700;
        }

        label {
            font-weight: 600;
            color: #000; /* negro */
        }

        .btn-primary {
            background: #0D6EFD;
            border: none;
            font-weight: bold;
            padding: 10px;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: #0954c7;
        }
    </style>

</head>

<body>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-4">

        <div class="login-card">

            <h3 class="text-center mb-4">Iniciar Sesión</h3>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
            <?php endif; ?>

            <form action="validar_login.php" method="POST">

                <label>Número de Control</label>
                <input type="text" name="numero_control" class="form-control mb-3" required>

                <label>Contraseña</label>
                <input type="password" name="password" class="form-control mb-4" required>

                <button class="btn btn-primary w-100">Entrar</button>

            </form>

        </div>

    </div>
</div>

</body>
</html>

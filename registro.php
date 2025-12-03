<?php
session_start();
$mensaje = isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
session_unset();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #34A853; /* Verde */
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .register-box {
            width: 380px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #34A853;
        }

        input, select {
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
            background: #34A853;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            margin-top: 12px;
            transition: 0.3s;
        }

        button:hover {
            background: #1f7a36;
        }

        .btn-blue {
            background: #1A73E8 !important;
        }
        .btn-blue:hover {
            background: #1259b1 !important;
        }

        .msg {
            background: #e8ffd9;
            color: #2d7a00;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
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

<div class="register-box">
    <h2>Registrar Usuario</h2>

    <?php if ($mensaje): ?>
        <div class="msg"><?= $mensaje ?></div>
    <?php endif; ?>

    <form action="guardar_usuario.php" method="POST">
        
        <input type="text" name="numero_control"
               placeholder="Número de control" required>

        <input type="text" name="nombre"
               placeholder="Nombre completo" required>

        <input type="password" name="password"
               placeholder="Contraseña" required>

        <select name="rol" required>
            <option value="" disabled selected>Selecciona el rol</option>
            <option value="alumno">Alumno</option>
            <option value="maestro">Maestro</option>
            <option value="administrador">Administrador</option>
        </select>

        <button type="submit">Registrar</button>
    </form>

    <form action="index.php" method="GET">
        <button class="btn-blue">Volver al login</button>
    </form>

</div>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "maestro") {
    header("Location: ../index.php");
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil del Maestro</title>

    <style>
        body {
            margin: 0;
            background: #1A73E8;
            font-family: Arial;
            color: #fff;
        }

        .container {
            margin: 50px auto;
            width: 80%;
            max-width: 700px;
            background: #ffffff;
            color: #000;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        h2 {
            color: #1A73E8;
        }

        a.btn {
            display: inline-block;
            padding: 12px 18px;
            background: #1A73E8;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 20px;
            transition: 0.3s;
        }

        a.btn:hover {
            background: #1259b1;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Perfil del Maestro</h2>

    <p><strong>Nombre:</strong> <?= $usuario ?></p>
    <p><strong>Rol:</strong> Maestro</p>

    <a href="dashboard.php" class="btn">Volver al Dashboard</a>
    <a href="../logout.php" class="btn">Cerrar sesión</a>
</div>

</body>
</html>

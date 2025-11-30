<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != "alumno") {
    header("Location: ../index.php");
    exit;
}

$nombre = $_SESSION['nombre'];
$numero = $_SESSION['numero_control'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil del Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f4f7fc;
        }
        .card-profile {
            border-radius: 15px;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .profile-header {
            background-color: #0d6efd;
            color: white;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Perfil del Alumno</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="card-profile">
        
        <div class="profile-header mb-3">
            <h3 class="m-0">📘 Mi Perfil</h3>
        </div>

        <h5><b>Nombre:</b></h5>
        <p><?php echo $nombre; ?></p>

        <h5><b>Número de Control:</b></h5>
        <p><?php echo $numero; ?></p>

        <a href="dashboard.php" class="btn btn-primary mt-3">⬅ Regresar</a>

    </div>

</div>

</body>
</html>

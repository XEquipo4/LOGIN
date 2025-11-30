<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'maestro') {
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
    <title>Dashboard Maestro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body { background-color: #f3f6fa; }
        .card-custom {
            border-radius: 12px;
            transition: 0.3s;
        }
        .card-custom:hover {
            transform: scale(1.03);
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Panel del Maestro</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="text-center mb-4">
        <h2 class="fw-bold">Bienvenido, Prof. <?php echo $nombre; ?> 👋</h2>
        <p class="text-secondary">Número de empleado: <b><?php echo $numero; ?></b></p>
    </div>

    <div class="row">

        <div class="col-md-6 mb-3">
            <a href="perfil.php" style="text-decoration:none;">
                <div class="card card-custom shadow p-3">
                    <h4 class="text-primary">👤 Mi Perfil</h4>
                    <p>Ver información de tu cuenta.</p>
                </div>
            </a>
        </div>

        <div class="col-md-6 mb-3">
            <a href="subir_calificaciones.php" style="text-decoration:none;">
                <div class="card card-custom shadow p-3">
                    <h4 class="text-primary">📤 Subir Calificaciones</h4>
                    <p>Registrar las calificaciones de tus alumnos.</p>
                </div>
            </a>
        </div>

    </div>
</div>

</body>
</html>

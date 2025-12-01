<?php
session_start();

// Validar sesión y rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'alumno') {
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
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f3f6fa; font-family: 'Poppins', sans-serif; }
        .card-custom { border-radius: 12px; transition: 0.3s; padding: 20px; }
        .card-custom:hover { transform: scale(1.03); box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .navbar { background-color: #0d6efd; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Panel del Alumno</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4 text-center">
    <h2 class="fw-bold">Bienvenido, <?php echo $nombre; ?> 👋</h2>
    <p class="text-secondary">Número de control: <b><?php echo $numero; ?></b></p>
</div>

<div class="container mt-4">
    <div class="row">

        <!-- Perfil -->
        <div class="col-md-6 mb-3">
            <a href="perfil.php" style="text-decoration:none;">
                <div class="card card-custom shadow p-3">
                    <h4 class="text-primary">📘 Mi Perfil</h4>
                    <p>Ver la información de tu cuenta.</p>
                </div>
            </a>
        </div>

        <!-- Calificaciones -->
        <div class="col-md-6 mb-3">
            <a href="calificaciones.php" style="text-decoration:none;">
                <div class="card card-custom shadow p-3">
                    <h4 class="text-primary">📊 Calificaciones</h4>
                    <p>Consulta tus materias y evaluaciones.</p>
                </div>
            </a>
        </div>

    </div>
</div>

</body>
</html>

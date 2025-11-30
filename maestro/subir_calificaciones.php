<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'maestro') {
    header("Location: ../index.php");
    exit;
}

$maestro = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Calificaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #eef2f7;
        }
        .card {
            border-radius: 12px;
            padding: 20px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Panel Maestro</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <h2 class="text-center fw-bold">📘 Subir Calificaciones</h2>
    <p class="text-center text-secondary">Maestro: <b><?php echo $maestro; ?></b></p>

    <div class="card shadow col-md-6 mx-auto">

        <form action="subir_calificaciones_procesar.php" method="POST">

            <label class="fw-bold mt-2">Número de Control</label>
            <input type="text" name="numero_control" class="form-control" required>

            <label class="fw-bold mt-3">Materia</label>
            <input type="text" name="materia" class="form-control" required>

            <label class="fw-bold mt-3">Calificación</label>
            <input type="number" name="calificacion" class="form-control" min="0" max="100" step="0.1" required>

            <button class="btn btn-primary w-100 mt-4">Guardar Calificación</button>
        </form>

    </div>
</div>

</body>
</html>

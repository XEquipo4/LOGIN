<?php
session_start();
require "../conexion.php";

// Verificar rol
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro'){
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Materia</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Registrar Nueva Materia</h2>

    <!-- ALERTAS -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= $_SESSION['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <?= $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <!-- FIN ALERTAS -->

    <form action="guardar_materia.php" method="POST" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Nombre de la materia:</label>
            <input type="text" name="nombre" required class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Carrera:</label>
            <input type="text" name="carrera" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Materia</button>
        <a href="dashboard.php" class="btn btn-secondary">Regresar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

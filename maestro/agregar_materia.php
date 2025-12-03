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

    <form action="guardar_materia.php" method="POST" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Nombre de la materia:</label>
            <input type="text" name="nombre" required class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Clave:</label>
            <input type="text" name="clave" required class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Materia</button>
        <a href="dashboard_maestro.php" class="btn btn-secondary">Regresar</a>
    </form>
</div>

</body>
</html>

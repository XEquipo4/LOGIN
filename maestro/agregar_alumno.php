<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Agregar Alumno</h2>

    <form action="guardar_alumno.php" method="post">

        <div class="mb-3">
            <label>Número de Control:</label>
            <input type="text" name="numero_control" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nombre Completo:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Alumno</button>

    </form>

</div>

</body>
</html>

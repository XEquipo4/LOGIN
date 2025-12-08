<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

$numero = $_GET['nc'];

// Buscar alumno por número de control
$sql = "SELECT * FROM alumnos WHERE numero_control = ?";
$stmt = sqlsrv_query($conn, $sql, array($numero));
$alumno = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$alumno) {
    die("No se encontró el alumno.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Alumno Seleccionado</h2>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>ID:</strong> <?= $alumno['id_alumno'] ?></li>
        <li class="list-group-item"><strong>Número Control:</strong> <?= $alumno['numero_control'] ?></li>
        <li class="list-group-item"><strong>Nombre:</strong> <?= $alumno['nombre'] ?></li>
        <li class="list-group-item"><strong>Fecha:</strong> <?= $alumno['fecha_registro']->format('Y-m-d') ?></li>
    </ul>

    <a href="asignar_materias.php?id=<?= $alumno['id_alumno'] ?>" class="btn btn-success">Asignar Materias</a>
    <a href="materias_asignadas.php?id=<?= $alumno['id_alumno'] ?>" class="btn btn-info">Ver Materias</a>

    <a href="seleccionar_alumno.php" class="btn btn-secondary">Volver</a>

</div>

</body>
</html>

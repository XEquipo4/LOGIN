<?php
session_start();
require "../conexion.php";
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') header("Location: ../index.php");

// Obtener alumnos y materias para subir calificaciones
$alumnos = sqlsrv_query($conn, "SELECT id, nombre FROM usuarios WHERE rol='alumno'");
$materias = sqlsrv_query($conn, "SELECT id, nombre FROM materias");

// Procesar formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_alumno = $_POST['alumno'];
    $id_materia = $_POST['materia'];
    $calificacion = $_POST['calificacion'];

    $sql = "INSERT INTO calificaciones (id_alumno, id_materia, calificacion)
            VALUES (?, ?, ?)";
    sqlsrv_query($conn, $sql, array($id_alumno, $id_materia, $calificacion));
    header("Location: subir_calificaciones.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Subir Calificaciones</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
<h2>Subir Calificaciones</h2>
<form method="POST">
<div class="mb-3">
    <label>Alumno</label>
    <select name="alumno" class="form-control" required>
        <?php while($a = sqlsrv_fetch_array($alumnos, SQLSRV_FETCH_ASSOC)): ?>
            <option value="<?= $a['id'] ?>"><?= $a['nombre'] ?></option>
        <?php endwhile; ?>
    </select>
</div>
<div class="mb-3">
    <label>Materia</label>
    <select name="materia" class="form-control" required>
        <?php while($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)): ?>
            <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
        <?php endwhile; ?>
    </select>
</div>
<div class="mb-3">
    <label>Calificación</label>
    <input type="number" step="0.01" name="calificacion" class="form-control" required>
</div>
<button class="btn btn-primary">Guardar</button>
</form>
</div>
</body>
</html>

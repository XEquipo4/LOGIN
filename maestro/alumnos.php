<?php
session_start();
require "../conexion.php";
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') header("Location: ../index.php");

$alumnos = sqlsrv_query($conn, "SELECT * FROM usuarios WHERE rol='alumno'");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Alumnos</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
<h2>Alumnos</h2>
<a href="alumno_agregar.php" class="btn btn-success mb-3">+ Agregar Alumno</a>
<table class="table table-bordered">
<thead>
<tr>
<th>Nombre</th>
<th>Número de control</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php while($a = sqlsrv_fetch_array($alumnos, SQLSRV_FETCH_ASSOC)): ?>
<tr>
<td><?= $a['nombre'] ?></td>
<td><?= $a['numero_control'] ?></td>
<td>
    <a href="editar_alumno.php?id=<?= $a['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
    <a href="eliminar_alumno.php?id=<?= $a['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
    <a href="asignar_materia.php?id=<?= $a['id'] ?>" class="btn btn-primary btn-sm">Asignar Materia</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</body>
</html>

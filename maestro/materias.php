<?php
session_start();
require "../conexion.php";
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') header("Location: ../index.php");

$materias = sqlsrv_query($conn, "SELECT * FROM materias");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Materias</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
<h2>Materias</h2>
<table class="table table-bordered">
<thead>
<tr>
<th>Nombre</th>
<th>Clave</th>
<th>Descripción</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<?php while($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)): ?>
<tr>
<td><?= $m['nombre'] ?></td>
<td><?= $m['clave'] ?></td>
<td><?= $m['descripcion'] ?></td>
<td>
    <a href="editar_materia.php?id=<?= $m['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
    <a href="eliminar_materia.php?id=<?= $m['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<a href="crear_materia.php" class="btn btn-primary">+ Crear Materia</a>
</div>
</body>
</html>

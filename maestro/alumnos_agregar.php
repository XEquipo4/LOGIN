<?php
session_start();
require "../conexion.php";
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') header("Location: ../index.php");

if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero_control'];
    $password = $_POST['password'];
    sqlsrv_query($conn,"INSERT INTO usuarios(nombre, numero_control, password, rol) VALUES(?, ?, ?, 'alumno')", array($nombre,$numero,$password));
    header("Location: alumnos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Alumno</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
<h2>Agregar Alumno</h2>
<form method="POST">
<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control" required>
</div>
<div class="mb-3">
<label>Número de control</label>
<input type="text" name="numero_control" class="form-control" required>
</div>
<div class="mb-3">
<label>Contraseña</label>
<input type="password" name="password" class="form-control" required>
</div>
<button class="btn btn-primary">Agregar</button>
</form>
</div>
</body>
</html>

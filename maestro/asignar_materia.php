<?php
session_start();
require "../conexion.php";
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') header("Location: ../index.php");

$id_alumno = $_GET['id'];
$alumno = sqlsrv_query($conn,"SELECT nombre FROM usuarios WHERE id=?", array($id_alumno));
$alumno = sqlsrv_fetch_array($alumno, SQLSRV_FETCH_ASSOC);

$materias = sqlsrv_query($conn,"SELECT * FROM materias");

if($_SERVER['REQUEST_METHOD']==='POST'){
    $id_materia = $_POST['materia'];
    sqlsrv_query($conn,"INSERT INTO alumno_materia(id_alumno,id_materia) VALUES(?,?)", array($id_alumno,$id_materia));
    header("Location: alumnos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Asignar Materia</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
<h2>Asignar Materia a <?= $alumno['nombre'] ?></h2>
<form method="POST">
<div class="mb-3">
<label>Materia</label>
<select name="materia" class="form-control" required>
<?php while($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)): ?>
<option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
<?php endwhile; ?>
</select>
</div>
<button class="btn btn-primary">Asignar</button>
</form>
</div>
</body>
</html>

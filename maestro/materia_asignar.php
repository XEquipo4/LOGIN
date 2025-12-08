<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

$alumno_id = $_GET['id'];

// obtener alumno
$alumno = sqlsrv_query($conn, "SELECT * FROM alumnos WHERE id_alumno = ?", [$alumno_id]);
$alumno = sqlsrv_fetch_array($alumno, SQLSRV_FETCH_ASSOC);

// obtener materias asignadas
$sql = "SELECT m.nombre 
        FROM materias m 
        INNER JOIN alumno_materia am ON m.id = am.materia_id
        WHERE am.alumno_id = ?";

$stmt = sqlsrv_query($conn, $sql, [$alumno_id]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Materias Asignadas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Materias Asignadas a <?= $alumno['nombre'] ?></h2>

    <ul class="list-group">
        <?php while ($m = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
            <li class="list-group-item"><?= $m['nombre'] ?></li>
        <?php endwhile; ?>
    </ul>

    <a href="gestionar_alumnos.php" class="btn btn-secondary mt-3">Regresar</a>

</div>

</body>
</html>

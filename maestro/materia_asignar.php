<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

$alumno_id = $_GET['id'];

// Obtener alumno
$sqlAlumno = "SELECT * FROM alumnos WHERE id_alumno = ?";
$stmtAlumno = sqlsrv_query($conn, $sqlAlumno, array($alumno_id));
$alumno = sqlsrv_fetch_array($stmtAlumno, SQLSRV_FETCH_ASSOC);

// Obtener materias asignadas
$sqlAsignadas = "
SELECT am.id, m.nombre, m.carrera, m.clave, am.calificacion
FROM alumno_materia am
INNER JOIN materias m ON am.materia_id = m.id
WHERE am.alumno_id = ?
ORDER BY m.nombre
";
$stmtAsig = sqlsrv_query($conn, $sqlAsignadas, array($alumno_id));
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

    <h2>Materias Asignadas a: <?= $alumno['nombre'] ?></h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Materia</th>
                <th>Carrera</th>
                <th>Clave</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($m = sqlsrv_fetch_array($stmtAsig, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= $m['nombre'] ?></td>
                    <td><?= $m['carrera'] ?></td>
                    <td><?= $m['clave'] ?></td>
                    <td><?= $m['calificacion'] !== null ? $m['calificacion'] : '—' ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="alumnos.php" class="btn btn-secondary">Volver</a>

</div>

</body>
</html>

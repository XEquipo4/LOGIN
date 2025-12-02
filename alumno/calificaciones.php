<?php
session_start();
require "../conexion.php";

// Validar sesión y rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'alumno') {
    header("Location: ../index.php");
    exit;
}

$numero = $_SESSION['numero_control']; 
$nombre = $_SESSION['nombre'];

// Consultar calificaciones del alumno
$sql = "SELECT m.nombre AS materia, am.calificacion
        FROM alumno_materia am
        INNER JOIN materias m ON am.materia_id = m.id
        INNER JOIN alumnos a ON am.alumno_id = a.id_alumno
        WHERE a.numero_control = ?";

$params = array($numero);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f3f6fa; font-family: 'Poppins', sans-serif; }
        .navbar { background-color: #0d6efd; }
        table { background-color: #fff; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Calificaciones</span>
        <a href="dashboard.php" class="btn btn-light btn-sm">Volver</a>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Calificaciones de <?php echo $nombre; ?></h3>
    <table class="table table-striped mt-3">
        <thead class="table-primary">
            <tr>
                <th>Materia</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['materia']; ?></td>
                    <td><?php echo $row['calificacion']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
session_start();
require "../conexion.php";

// Verificar sesión
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'alumno') {
    header("Location: ../index.php");
    exit;
}

$numero = $_SESSION['numero_control'];
$nombre = $_SESSION['nombre'];

// Consulta de calificaciones del alumno
$sql = "SELECT materia, calificacion, fecha_registro 
        FROM calificaciones 
        WHERE numero_control = ?";

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
    <title>Mis Calificaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f3f6fa;
        }
        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Calificaciones del Alumno</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="text-center mb-4">
        <h2 class="fw-bold">📊 Calificaciones de <?php echo $nombre; ?></h2>
        <p class="text-secondary">Número de control: <b><?php echo $numero; ?></b></p>
    </div>

    <div class="card shadow p-3">

        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Materia</th>
                    <th>Calificación</th>
                    <th>Fecha Registro</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $tieneCalificaciones = false;

                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { 
                    $tieneCalificaciones = true;
                ?>
                <tr>
                    <td><?php echo $row['materia']; ?></td>
                    <td><b><?php echo $row['calificacion']; ?></b></td>
                    <td><?php echo $row['fecha_registro']->format('Y-m-d'); ?></td>
                </tr>
                <?php } ?>

                <?php if (!$tieneCalificaciones) { ?>
                    <tr>
                        <td colspan="3" class="text-center text-danger">
                            No tienes calificaciones registradas todavía.
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>

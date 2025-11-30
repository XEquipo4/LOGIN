<?php
session_start();
require "../conexion.php";

if ($_SESSION['rol'] != "maestro") {
    header("Location: ../index.php");
    exit;
}

$sql = "SELECT * FROM calificaciones";
$stmt = sqlsrv_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones Registradas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Panel Maestro</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <h2 class="fw-bold text-center">📊 Calificaciones Registradas</h2>

    <table class="table table-striped table-bordered mt-3 shadow">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>No. Control</th>
                <th>Materia</th>
                <th>Calificación</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['numero_control']; ?></td>
                <td><?php echo $row['materia']; ?></td>
                <td><?php echo $row['calificacion']; ?></td>
                <td><?php echo $row['fecha_registro']->format('Y-m-d'); ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>

</div>

</body>
</html>

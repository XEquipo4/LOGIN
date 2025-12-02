<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

$sql = "SELECT * FROM alumnos ORDER BY id_alumno DESC";
$stmt = sqlsrv_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de Alumnos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Gestión de Alumnos</h2>
    <a href="agregar_alumno.php" class="btn btn-primary mb-3">Agregar Alumno</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Número Control</th>
                <th>Nombre</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($a = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= $a['id_alumno'] ?></td>
                    <td><?= $a['numero_control'] ?></td>
                    <td><?= $a['nombre'] ?></td>
                    <td><?= $a['fecha_registro']->format("Y-m-d") ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>

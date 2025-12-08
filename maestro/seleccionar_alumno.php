<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

// Traer usuarios con rol alumno
$sql = "SELECT * FROM usuarios WHERE rol = 'alumno' ORDER BY nombre ASC";
$stmt = sqlsrv_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Seleccionar Alumno</h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Número Control</th>
                <th>Nombre</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($u = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['numero_control'] ?></td>
                    <td><?= $u['nombre'] ?></td>
                    <td>
                        <a href="alumno_detalle.php?nc=<?= $u['numero_control'] ?>" class="btn btn-primary btn-sm">
                            Seleccionar
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>

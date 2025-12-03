<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['materia_id'])) {
    header("Location: subir_calificaciones.php");
    exit;
}

$materia_id = $_GET['materia_id'];

$sql = "
    SELECT ma.id, u.nombre, u.numero_control, ma.calificacion
    FROM materias_asignadas ma
    INNER JOIN usuarios u ON u.id = ma.alumno_id
    WHERE ma.materia_id = ?
";
$params = array($materia_id);
$alumnos = sqlsrv_query($conn, $sql, $params);

// Obtener nombre de la materia
$sqlMateria = "SELECT nombre FROM materias WHERE id = ?";
$materiaInfo = sqlsrv_query($conn, $sqlMateria, array($materia_id));
$materia = sqlsrv_fetch_array($materiaInfo, SQLSRV_FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Calificaciones</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-primary">Alumnos inscritos en: <?= $materia['nombre'] ?></h2>

    <form action="guardar_calificaciones.php" method="POST">
        <input type="hidden" name="materia_id" value="<?= $materia_id ?>">

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Número de Control</th>
                    <th>Nombre</th>
                    <th>Calificación</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($a = sqlsrv_fetch_array($alumnos, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= $a['numero_control'] ?></td>
                    <td><?= $a['nombre'] ?></td>
                    <td>
                        <input type="number" step="0.01" min="0" max="100"
                               name="calificaciones[<?= $a['id'] ?>]"
                               class="form-control"
                               value="<?= $a['calificacion'] ?>">
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button class="btn btn-success">Guardar Calificaciones</button>
    </form>

</div>

</body>
</html>

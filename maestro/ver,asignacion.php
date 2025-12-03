<?php
include "conexion.php";

$sql = "SELECT 
            ma.id,
            u.numero_control,
            u.nombre AS alumno,
            m.nombre AS materia,
            ma.calificacion
        FROM materias_asignadas ma
        INNER JOIN usuarios u ON ma.alumno_id = u.id
        INNER JOIN materias m ON ma.materia_id = m.id
        ORDER BY u.nombre, m.nombre";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Materias asignadas</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-success">Materias Asignadas</h2>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>No. Control</th>
                <th>Alumno</th>
                <th>Materia</th>
                <th>Calificación</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['numero_control'] ?></td>
                <td><?= $row['alumno'] ?></td>
                <td><?= $row['materia'] ?></td>
                <td><?= $row['calificacion'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

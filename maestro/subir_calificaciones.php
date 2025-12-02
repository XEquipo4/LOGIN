<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

// Obtener materias
$sql = "SELECT * FROM materias";
$materias = sqlsrv_query($conn, $sql);

$materia_id = isset($_GET['materia']) ? intval($_GET['materia']) : 0;
$alumnos = null;

if ($materia_id > 0) {
    $sql2 = "SELECT am.id, a.nombre, a.numero_control, am.calificacion
             FROM alumno_materia am
             INNER JOIN alumnos a ON am.alumno_id = a.id_alumno
             WHERE am.materia_id = ?";
    
    $alumnos = sqlsrv_query($conn, $sql2, array($materia_id));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subir Calificaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Subir Calificaciones</h2>

    <!-- Seleccionar materia -->
    <form method="get">
        <select name="materia" class="form-control w-50 mb-3" onchange="this.form.submit()">
            <option value="">Seleccione una materia</option>
            <?php while ($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)) : ?>
                <option value="<?= $m['id'] ?>" <?= $materia_id == $m['id'] ? "selected" : "" ?>>
                    <?= $m['nombre'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php if ($materia_id > 0 && $alumnos) : ?>

        <form action="guardar_calificacion.php" method="post">
            <input type="hidden" name="materia_id" value="<?= $materia_id ?>">

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Alumno</th>
                        <th>Número Control</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($a = sqlsrv_fetch_array($alumnos, SQLSRV_FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?= $a['nombre'] ?></td>
                            <td><?= $a['numero_control'] ?></td>
                            <td>
                                <input type="number" name="calificacion[<?= $a['id'] ?>]"
                                       min="0" max="100" value="<?= $a['calificacion'] ?>"
                                       class="form-control">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <button class="btn btn-success">Guardar Calificaciones</button>
        </form>

    <?php endif; ?>
</div>
</body>
</html>

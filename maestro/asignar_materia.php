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

// obtener todas las materias
$materias = sqlsrv_query($conn, "SELECT * FROM materias");

// obtener materias ya asignadas
$asignadas = sqlsrv_query($conn, "SELECT materia_id FROM alumno_materia WHERE alumno_id = ?", [$alumno_id]);
$asignadas_ids = [];
while ($a = sqlsrv_fetch_array($asignadas, SQLSRV_FETCH_ASSOC)) {
    $asignadas_ids[] = $a['materia_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Asignar Materias</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Asignar Materias a <?= $alumno['nombre'] ?></h2>

    <form action="guardar_asignacion.php" method="post">
        <input type="hidden" name="alumno_id" value="<?= $alumno_id ?>">

        <?php while ($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)) : ?>
            <div class="form-check">
                <input class="form-check-input" 
                       type="checkbox" 
                       name="materias[]" 
                       value="<?= $m['id'] ?>"
                       <?= in_array($m['id'], $asignadas_ids) ? 'checked' : '' ?>>
                <label class="form-check-label">
                    <?= $m['nombre'] ?>
                </label>
            </div>
        <?php endwhile; ?>

        <button class="btn btn-success mt-3">Guardar Asignación</button>
    </form>

</div>

</body>
</html>

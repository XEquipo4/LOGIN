<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

$alumno_id = $_GET['id'];

// Obtener datos del alumno
$sqlAlumno = "SELECT * FROM alumnos WHERE id_alumno = ?";
$stmtAlumno = sqlsrv_query($conn, $sqlAlumno, array($alumno_id));
$alumno = sqlsrv_fetch_array($stmtAlumno, SQLSRV_FETCH_ASSOC);

// Obtener materias disponibles
$sqlMaterias = "SELECT * FROM materias ORDER BY nombre ASC";
$stmtMaterias = sqlsrv_query($conn, $sqlMaterias);

$mensaje = "";

// Guardar asignación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $materia_id = $_POST['materia_id'];

    // Validar que no exista ya la asignación
    $validacion = sqlsrv_query($conn,
        "SELECT * FROM alumno_materia WHERE alumno_id = ? AND materia_id = ?",
        array($alumno_id, $materia_id)
    );

    if (sqlsrv_has_rows($validacion)) {
        $mensaje = '<div class="alert alert-warning">Esta materia ya está asignada.</div>';
    } else {
        $query = "INSERT INTO alumno_materia (alumno_id, materia_id) VALUES (?, ?)";
        if (sqlsrv_query($conn, $query, array($alumno_id, $materia_id))) {
            $mensaje = '<div class="alert alert-success">Materia asignada correctamente.</div>';
        } else {
            $mensaje = '<div class="alert alert-danger">Error al asignar materia.</div>';
        }
    }
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

    <h2>Asignar Materia a: <?= $alumno['nombre'] ?></h2>

    <?= $mensaje ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Seleccionar Materia</label>
            <select name="materia_id" class="form-select" required>
                <option value="">-- Seleccionar --</option>
                <?php while ($m = sqlsrv_fetch_array($stmtMaterias, SQLSRV_FETCH_ASSOC)) : ?>
                    <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?> (<?= $m['carrera'] ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>

        <button class="btn btn-primary">Asignar</button>
        <a href="alumnos.php" class="btn btn-secondary">Volver</a>
    </form>

</div>

</body>
</html>

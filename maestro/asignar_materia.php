<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

// Mensajes
$msg = "";

// Procesar formulario al enviar asignaciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alumno_id = isset($_POST['alumno_id']) ? intval($_POST['alumno_id']) : 0;
    $materias_selected = isset($_POST['materias']) ? $_POST['materias'] : array();

    if ($alumno_id <= 0) {
        $msg = "Selecciona un alumno válido.";
    } elseif (empty($materias_selected)) {
        $msg = "Selecciona al menos una materia.";
    } else {
        $inserted = 0;
        $skipped = 0;

        foreach ($materias_selected as $materia_id) {
            $materia_id = intval($materia_id);

            // Comprobar si ya existe la relación para evitar duplicados
            $sqlCheck = "SELECT COUNT(*) AS cnt FROM alumno_materia WHERE alumno_id = ? AND materia_id = ?";
            $stmtCheck = sqlsrv_query($conn, $sqlCheck, array($alumno_id, $materia_id));
            if ($stmtCheck === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmtCheck, SQLSRV_FETCH_ASSOC);
            $exists = intval($row['cnt'] ?? 0);

            if ($exists > 0) {
                $skipped++;
                continue;
            }

            // Insertar relación
            $sqlInsert = "INSERT INTO alumno_materia (alumno_id, materia_id, calificacion) VALUES (?, ?, NULL)";
            $stmtInsert = sqlsrv_query($conn, $sqlInsert, array($alumno_id, $materia_id));
            if ($stmtInsert === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $inserted++;
        }

        $msgParts = [];
        if ($inserted > 0) $msgParts[] = "Se asignaron $inserted materia(s).";
        if ($skipped > 0) $msgParts[] = "Se omitieron $skipped asignación(es) ya existentes.";
        $msg = implode(' ', $msgParts);
    }
}

// Obtener lista de alumnos
$sqlAl = "SELECT id_alumno, numero_control, nombre FROM alumnos ORDER BY nombre";
$alumnos = sqlsrv_query($conn, $sqlAl);
if ($alumnos === false) die(print_r(sqlsrv_errors(), true));

// Obtener lista de materias
$sqlMat = "SELECT id, nombre, clave FROM materias ORDER BY nombre";
$materias = sqlsrv_query($conn, $sqlMat);
if ($materias === false) die(print_r(sqlsrv_errors(), true));
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Asignar Materias a Alumno</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background:#f5f7fb; font-family: 'Poppins', sans-serif; }
    .card { border-radius: 10px; }
</style>
</head>
<body>
<nav class="navbar navbar-dark" style="background:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Asignar Materias</span>
        <div>
            <a href="alumnos.php" class="btn btn-light btn-sm">← Volver Alumnos</a>
            <a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Asignar materias a un alumno</h4>

        <?php if ($msg): ?>
            <div class="alert alert-info"><?= htmlentities($msg) ?></div>
        <?php endif; ?>

        <form method="post" class="row g-3">
            <div class="col-12 col-md-6">
                <label class="form-label">Seleccione Alumno</label>
                <select name="alumno_id" class="form-select" required>
                    <option value="">-- Seleccionar alumno --</option>
                    <?php
                    // Reset pointer and loop
                    sqlsrv_execute($alumnos); // safe no-op if already executed, but ensures pointer
                    // Actually we need to re-query to be safe since we used sqlsrv_query earlier; fetch from result:
                    // We'll iterate over $alumnos using sqlsrv_fetch_array directly.
                    ?>
                    <?php
                    // Because we already have $alumnos as a result set, iterate:
                    sqlsrv_free_stmt($alumnos); // free and refetch to ensure fresh pointer
                    $alumnos = sqlsrv_query($conn, $sqlAl);
                    while ($a = sqlsrv_fetch_array($alumnos, SQLSRV_FETCH_ASSOC)) : ?>
                        <option value="<?= $a['id_alumno'] ?>"><?= htmlentities($a['numero_control'] . " — " . $a['nombre']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Seleccione Materias (puede elegir varias)</label>
                <div class="border rounded p-3" style="background:white;">
                    <?php
                    // Re-query materias result set to iterate safely
                    sqlsrv_free_stmt($materias);
                    $materias = sqlsrv_query($conn, $sqlMat);
                    while ($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)) : ?>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="checkbox" name="materias[]" id="m<?= $m['id'] ?>" value="<?= $m['id'] ?>">
                            <label class="form-check-label" for="m<?= $m['id'] ?>"><?= htmlentities($m['nombre'] . " (" . $m['clave'] . ")") ?></label>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary">Asignar Materias</button>
                <a href="alumnos.php" class="btn btn-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

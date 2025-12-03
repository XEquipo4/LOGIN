<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

// CONSULTAR MATERIAS
$sqlM = "SELECT * FROM materias ORDER BY nombre";
$materias = sqlsrv_query($conn, $sqlM);

// CONSULTAR SOLO ALUMNOS CON ROL = 'alumno'
$sqlA = "
    SELECT a.id_alumno, a.nombre, a.numero_control
    FROM alumnos a
    INNER JOIN usuarios u ON u.numero_control = a.numero_control
    WHERE u.rol = 'alumno'
    ORDER BY a.nombre
";
$alumnos = sqlsrv_query($conn, $sqlA);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Asignar Materia</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
    body { background-color: #eef3fa; font-family: 'Poppins', sans-serif; }
    .card { border-radius: 14px; }
</style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-primary">Asignar Materia a Alumno</h2>

    <a href="dashboard.php" class="btn btn-secondary btn-sm mb-3">← Volver al Dashboard</a>

    <div class="card p-4 shadow">

        <form action="guardar_asignacion.php" method="POST">

            <!-- Seleccionar materia -->
            <div class="mb-3">
                <label class="form-label">Seleccione Materia</label>
                <select name="materia_id" class="form-select" required>
                    <option value="">-- Seleccionar materia --</option>
                    <?php while ($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)) : ?>
                        <option value="<?= $m['id'] ?>">
                            <?= $m['clave'] ?> — <?= $m['nombre'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Seleccionar alumno (solo usuarios con rol alumno) -->
            <div class="mb-3">
                <label class="form-label">Seleccione Alumno</label>
                <select name="alumno_id" class="form-select" required>
                    <option value="">-- Seleccionar alumno --</option>
                    <?php while ($a = sqlsrv_fetch_array($alumnos, SQLSRV_FETCH_ASSOC)) : ?>
                        <option value="<?= $a['id_alumno'] ?>">
                            <?= $a['numero_control'] . " — " . $a['nombre'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Asignar Materia</button>

        </form>

    </div>
</div>

</body>
</html>

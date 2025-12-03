<?php
session_start();
include "conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != "maestro") {
    header("Location: index.php");
    exit;
}

// CONSULTAR SOLO ALUMNOS
$sqlAlumnos = "SELECT id, numero_control, nombre FROM usuarios WHERE rol = 'alumno' ORDER BY nombre";
$resultAlumnos = $conn->query($sqlAlumnos);

// CONSULTAR MATERIAS
$sqlMaterias = "SELECT id, nombre FROM materias ORDER BY nombre";
$resultMaterias = $conn->query($sqlMaterias);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Asignar Materia</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-primary">Asignar Materia a Alumno</h2>

    <div class="card p-4 shadow">

        <form action="asignar_materia.php" method="POST">

            <label class="form-label">Seleccionar Alumno</label>
            <select name="alumno_id" class="form-select mb-3" required>
                <option value="">-- Seleccione un alumno --</option>
                <?php while ($a = $resultAlumnos->fetch_assoc()) : ?>
                    <option value="<?= $a['id'] ?>">
                        <?= $a['numero_control'] ?> — <?= $a['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label class="form-label">Seleccionar Materia</label>
            <select name="materia_id" class="form-select mb-3" required>
                <option value="">-- Seleccione una materia --</option>
                <?php while ($m = $resultMaterias->fetch_assoc()) : ?>
                    <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <label class="form-label">Calificación (opcional)</label>
            <input type="number" class="form-control mb-3" name="calificacion" min="0" max="100">

            <button class="btn btn-primary w-100">Asignar Materia</button>

        </form>

    </div>
</div>

</body>
</html>

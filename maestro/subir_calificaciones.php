<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

// OBTENER MATERIAS
$sqlM = "SELECT * FROM materias ORDER BY nombre";
$materias = sqlsrv_query($conn, $sqlM);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Subir Calificaciones</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-primary">Subir Calificaciones</h2>

    <form action="ver_alumnos_materia.php" method="GET">
        <label class="form-label">Seleccione una materia</label>
        <select name="materia_id" class="form-select" required>
            <option value="">-- Seleccionar --</option>
            <?php while ($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)) : ?>
                <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
            <?php endwhile; ?>
        </select>

        <button class="btn btn-primary mt-3">Ver alumnos</button>
    </form>
</div>

</body>
</html>

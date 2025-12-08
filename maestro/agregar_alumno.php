<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

// Obtener usuarios que tienen rol alumno
$sql = "SELECT id, numero_control, nombre FROM usuarios WHERE rol = 'alumno'";
$stmt = sqlsrv_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h2>Agregar Alumno</h2>

    <form action="guardar_alumno.php" method="post">

        <!-- SELECT DE USUARIOS (ALUMNOS) -->
        <div class="mb-3">
            <label>Seleccionar Usuario (Alumno):</label>
            <select name="usuario_id" id="usuario_id" class="form-select" required>
                <option value="">Seleccione un alumno...</option>

                <?php while ($u = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                    <option 
                        value="<?= $u['id'] ?>"
                        data-numero="<?= $u['numero_control'] ?>"
                        data-nombre="<?= $u['nombre'] ?>"
                    >
                        <?= $u['numero_control'] ?> - <?= $u['nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- CAMPOS AUTOMÁTICOS -->
        <div class="mb-3">
            <label>Número de Control:</label>
            <input type="text" id="numero_control" name="numero_control" class="form-control" readonly required>
        </div>

        <div class="mb-3">
            <label>Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" readonly required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Alumno</button>

    </form>

</div>

<!-- Script para rellenar automáticamente -->
<script>
document.getElementById("usuario_id").addEventListener("change", function() {
    let option = this.options[this.selectedIndex];

    document.getElementById("numero_control").value = option.getAttribute("data-numero");
    document.getElementById("nombre").value = option.getAttribute("data-nombre");
});
</script>

</body>
</html>

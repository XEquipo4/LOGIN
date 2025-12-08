<?php
session_start();
require "../conexion.php";

// Verificar rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

// Obtener materias
$materias = sqlsrv_query($conn, "SELECT * FROM materias ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Materias</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    body { background: #eef3fa; font-family: 'Poppins', sans-serif; }
    .navbar { background: #0d6efd; }
    .card { border-radius: 10px; }
</style>
</head>
<body>

<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Gestión de Materias</span>
        <a href="dashboard.php" class="btn btn-light btn-sm">⟵ Regresar</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary">Materias Registradas</h3>
        <a href="/maestro/asignar_materia.php" class="btn btn-success">+ Crear Materia</a>
    </div>

    <table class="table table-bordered table-hover shadow">
        <thead class="table-primary">
            <tr>
                <th>Nombre</th>
                <th>Clave</th>
                <th>Descripción</th>
                <th width="180">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($m = sqlsrv_fetch_array($materias, SQLSRV_FETCH_ASSOC)): ?>
            <tr>
                <td><?= $m['nombre'] ?></td>
                <td><?= $m['clave'] ?></td>
                <td><?= $m['descripcion'] ?></td>
                <td>
                    <a href="editar_materia.php?id=<?= $m['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="eliminar_materia.php?id=<?= $m['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Eliminar esta materia?');">
                       Eliminar
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

</body>
</html>

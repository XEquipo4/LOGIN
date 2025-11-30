<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'maestro') {
    header("Location: ../index.php");
    exit;
}

$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Calificaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body { background-color: #eef2f8; }
        .form-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Subir Calificaciones</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="form-box">

        <h3 class="mb-4 text-center">📤 Registrar Calificaciones</h3>

        <form>
            <div class="mb-3">
                <label class="form-label">Número de Control del Alumno</label>
                <input type="text" class="form-control" placeholder="Ej: A001" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Materia</label>
                <select class="form-select" required>
                    <option value="">Seleccione una materia</option>
                    <option>Matemáticas</option>
                    <option>Programación</option>
                    <option>Electricidad</option>
                    <option>Redes</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Calificación</label>
                <input type="number" min="0" max="100" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Guardar</button>
        </form>

        <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Regresar</a>

    </div>

</div>

</body>
</html>

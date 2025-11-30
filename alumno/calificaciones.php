<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'alumno') {
    header("Location: ../index.php");
    exit;
}

$nombre = $_SESSION['usuario'];
$numero = $_SESSION['numero_control'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #eef2f8;
        }

        .table-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .table thead {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <span class="navbar-brand">Calificaciones</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="table-container">

        <h3 class="mb-4 text-center">📊 Calificaciones de <?= $nombre ?></h3>

        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Calificación</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Matemáticas</td>
                    <td>95</td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                </tr>
                <tr>
                    <td>Programación</td>
                    <td>88</td>
                    <td><span class="badge bg-success">Aprobado</span></td>
                </tr>
                <tr>
                    <td>Física</td>
                    <td>72</td>
                    <td><span class="badge bg-warning text-dark">Regular</span></td>
                </tr>
            </tbody>
        </table>

        <a href="dashboard.php" class="btn btn-primary">⬅ Regresar</a>

    </div>

</div>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'alumno') {
    header("Location: ../index.php");
    exit;
}

$nombre = $_SESSION['nombre'];
$numero = $_SESSION['numero_control'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - Alumno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #eef3f9;
        }
        .profile-card {
            border-radius: 15px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark" style="background-color:#0d6efd;">
    <div class="container-fluid">
        <a href="dashboard.php" class="navbar-brand">← Regresar al Dashboard</a>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="card shadow profile-card p-4">
        <h3 class="text-center text-primary">📘 Mi Perfil</h3>
        <hr>

        <div class="mb-3">
            <label class="form-label">Nombre del alumno:</label>
            <input type="text" class="form-control" value="<?php echo $nombre; ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Número de Control:</label>
            <input type="text" class="form-control" value="<?php echo $numero; ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Rol:</label>
            <input type="text" class="form-control" value="<?php echo strtoupper($rol); ?>" disabled>
        </div>

    </div>

</div>

</body>
</html>

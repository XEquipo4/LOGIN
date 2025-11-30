<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

$nombre = $_SESSION['nombre'];
$numero = $_SESSION['numero_control'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Maestro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #eef3fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-custom {
            border-radius: 14px;
            transition: 0.3s;
            padding: 22px;
        }
        .card-custom:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .navbar {
            background-color: #0d6efd;
        }
        .title {
            font-weight: 700;
            color: #0d6efd;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Panel del Maestro</span>
        <a href="../logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
    </div>
</nav>

<!-- BIENVENIDA -->
<div class="container mt-4 text-center">
    <h2 class="fw-bold">Bienvenido, <?php echo $nombre; ?> 👨‍🏫</h2>
    <p class="text-secondary">Número de control: <b><?php echo $numero; ?></b></p>
</div>

<!-- TARJETAS DEL PANEL -->
<div class="container mt-4">
    <div class="row">

        <!-- Subir Calificaciones -->
        <div class="col-md-6 col-lg-3 mb-3">
            <a href="subir_calificaciones.php" style="text-decoration:none;">
                <div class="card shadow card-custom">
                    <h4 class="title">📊 Subir Calificaciones</h4>
                    <p>Registrar o editar calificaciones de los alumnos.</p>
                </div>
            </a>
        </div>

        <!-- Gestión de Materias -->
        <div class="col-md-6 col-lg-3 mb-3">
            <a href="materias.php" style="text-decoration:none;">
                <div class="card shadow card-custom">
                    <h4 class="title">📚 Gestión de Materias</h4>
                    <p>Crear, modificar o eliminar materias.</p>
                </div>
            </a>
        </div>

        <!-- Gestión de Alumnos -->
        <div class="col-md-6 col-lg-3 mb-3">
            <a href="alumnos.php" style="text-decoration:none;">
                <div class="card shadow card-custom">
                    <h4 class="title">👥 Gestión de Alumnos</h4>
                    <p>Registrar y administrar a los alumnos.</p>
                </div>
            </a>
        </div>

        <!-- Perfil -->
        <div class="col-md-6 col-lg-3 mb-3">
            <a href="perfil.php" style="text-decoration:none;">
                <div class="card shadow card-custom">
                    <h4 class="title">👤 Mi Perfil</h4>
                    <p>Ver tu información personal.</p>
                </div>
            </a>
        </div>

    </div>
</div>

</body>
</html>

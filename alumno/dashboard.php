<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "alumno") {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Bienvenido Alumno: <?= $_SESSION['numero_control'] ?></span>
        <a href="../logout.php" class="btn btn-light">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Perfil</h5>
                    <p>Información personal del alumno.</p>
                    <a href="perfil.php" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Calificaciones</h5>
                    <p>Consulta tus calificaciones.</p>
                    <a href="calificaciones.php" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>

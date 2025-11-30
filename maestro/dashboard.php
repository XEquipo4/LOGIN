<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== "maestro") {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Maestro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Bienvenido Maestro: <?= $_SESSION['numero_control'] ?></span>
        <a href="../logout.php" class="btn btn-outline-light">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Subir Calificaciones</h5>
                    <p>Envíe las notas de los alumnos.</p>
                    <a href="subir_calificaciones.php" class="btn btn-dark">Entrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Mi Perfil</h5>
                    <p>Información del maestro.</p>
                    <a href="perfil.php" class="btn btn-dark">Ver</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>

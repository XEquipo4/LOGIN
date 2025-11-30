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
    <title>Perfil Maestro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3>Perfil del Maestro</h3>
        <p><strong>Número de control: </strong><?= $_SESSION['numero_control'] ?></p>

        <a href="dashboard.php" class="btn btn-dark mt-2">Volver</a>
    </div>
</div>

</body>
</html>

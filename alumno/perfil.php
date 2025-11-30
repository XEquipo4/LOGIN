<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != "alumno") {
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
    <title>Perfil Alumno</title>
</head>
<body>
    <h2>Perfil del Alumno</h2>
    <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
    <p><strong>Número de control:</strong> <?php echo $numero; ?></p>

    <a href="dashboard.php">Regresar</a>
</body>
</html>

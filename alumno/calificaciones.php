<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != "alumno") {
    header("Location: ../index.php");
    exit;
}

$nombre = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones</title>
</head>
<body>

<h2>Calificaciones de <?php echo $nombre; ?></h2>
<p>(Aquí van las calificaciones más adelante)</p>

<a href="dashboard.php">Regresar</a>

</body>
</html>

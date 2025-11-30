<?php
session_start();
require "../conexion.php";

if ($_SESSION['rol'] != "maestro") {
    header("Location: ../index.php");
    exit;
}

$numero = $_POST['numero_control'];
$materia = $_POST['materia'];
$calificacion = $_POST['calificacion'];

$sql = "INSERT INTO calificaciones (numero_control, materia, calificacion)
        VALUES (?, ?, ?)";

$params = array($numero, $materia, $calificacion);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    $_SESSION['mensaje'] = "Calificación guardada correctamente";
    header("Location: subir_calificaciones.php");
} else {
    $_SESSION['mensaje'] = "Error al guardar";
    header("Location: subir_calificaciones.php");
}

exit;
?>

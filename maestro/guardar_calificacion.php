<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_POST['calificaciones'])) {
    header("Location: subir_calificaciones.php");
    exit;
}

foreach ($_POST['calificaciones'] as $id_asignacion => $calificacion) {

    $sql = "
        UPDATE materias_asignadas
        SET calificacion = ?
        WHERE id = ?
    ";

    $params = array($calificacion, $id_asignacion);
    sqlsrv_query($conn, $sql, $params);
}

$_SESSION['success'] = "Calificaciones actualizadas correctamente";
header("Location: subir_calificaciones.php");
exit;

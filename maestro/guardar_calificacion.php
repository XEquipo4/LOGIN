<?php
session_start();
require "../conexion.php";

$materia_id = intval($_POST['materia_id']);
$calificaciones = $_POST['calificacion'];

foreach ($calificaciones as $id_relacion => $cal) {

    $sql = "UPDATE alumno_materia SET calificacion = ? WHERE id = ?";
    sqlsrv_query($conn, $sql, array($cal, $id_relacion));
}

header("Location: subir_calificaciones.php?materia=$materia_id");
exit;
?>

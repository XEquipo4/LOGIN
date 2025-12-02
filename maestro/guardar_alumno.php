<?php
session_start();
require "../conexion.php";

$numero = trim($_POST['numero_control']);
$nombre = trim($_POST['nombre']);
$materia = intval($_POST['materia_id']);

if ($numero == "" || $nombre == "" || $materia <= 0) {
    die("Datos inválidos");
}

// Insertar alumno
$sql = "INSERT INTO alumnos (numero_control, nombre) OUTPUT INSERTED.id_alumno VALUES (?, ?)";
$params = array($numero, $nombre);
$stmt = sqlsrv_query($conn, $sql, $params);

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$id_alumno = $row['id_alumno'];

// Insertar relación alumno-materia
$sql2 = "INSERT INTO alumno_materia (alumno_id, materia_id) VALUES (?, ?)";
$params2 = array($id_alumno, $materia);
sqlsrv_query($conn, $sql2, $params2);

header("Location: alumnos.php");
exit;
?>

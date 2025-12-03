<?php
session_start();
require "../conexion.php";

if (!isset($_POST['materia_id'], $_POST['alumno_id'])) {
    header("Location: asignar_materia.php");
    exit;
}

$materia = $_POST['materia_id'];
$alumno  = $_POST['alumno_id'];

// Verificar si ya está asignado
$sqlCheck = "SELECT * FROM alumno_materia WHERE alumno_id = ? AND materia_id = ?";
$params = array($alumno, $materia);
$check = sqlsrv_query($conn, $sqlCheck, $params);

if (sqlsrv_fetch_array($check)) {
    $_SESSION['error'] = "El alumno ya está asignado a esta materia.";
    header("Location: asignar_materia.php");
    exit;
}

// Insertar asignación
$sql = "INSERT INTO alumno_materia (alumno_id, materia_id) VALUES (?, ?)";
$params = array($alumno, $materia);
sqlsrv_query($conn, $sql, $params);

$_SESSION['ok'] = "Materia asignada correctamente.";
header("Location: asignar_materia.php");
exit;
?>

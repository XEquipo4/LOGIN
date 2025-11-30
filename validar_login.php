<?php
session_start();
require "conexion.php";

$numero = $_POST['numero_control'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE numero_control = ?";
$stmt = sqlsrv_query($conn, $sql, array($numero));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$user) {
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: index.php");
    exit;
}

if ($password != $user['password']) {
    $_SESSION['error'] = "Contraseña incorrecta";
    header("Location: index.php");
    exit;
}

$_SESSION['usuario'] = $user['nombre'];
$_SESSION['rol'] = $user['rol'];

if ($user['rol'] == "alumno") {
    header("Location: alumno/dashboard.php");
} else {
    header("Location: maestro/dashboard.php");
}
?>

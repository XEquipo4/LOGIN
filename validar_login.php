<?php
session_start();
require "conexion.php";

if (!isset($_POST['numero_control'], $_POST['password'])) {
    header("Location: index.php");
    exit;
}

$numero = trim($_POST['numero_control']);
$password = trim($_POST['password']);

// Consulta segura
$sql = "SELECT * FROM usuarios WHERE numero_control = ?";
$params = array($numero);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// VALIDACIONES
if (!$user) {
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: index.php");
    exit;
}

if ($password !== $user['password']) {
    $_SESSION['error'] = "Contraseña incorrecta";
    header("Location: index.php");
    exit;
}

// GUARDAR DATOS EN SESIÓN
$_SESSION['usuario']         = $user['numero_control']; 
$_SESSION['rol']             = $user['rol'];
$_SESSION['numero_control'] = $user['numero_control'];
$_SESSION['nombre'] = $user['nombre'];


// REDIRECCIÓN SEGÚN ROL
if ($user['rol'] === "alumno") {
    header("Location: alumno/dashboard.php");
} else if ($user['rol'] === "maestro") {
    header("Location: maestro/dashboard.php");
} else {
    $_SESSION['error'] = "Rol no válido";
    header("Location: index.php");
}
exit;
?>

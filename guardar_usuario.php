<?php
session_start();
require "conexion.php";  // Conexión SQL Server

// Validar que vengan todos los datos
if (
    !isset($_POST['numero_control']) ||
    !isset($_POST['nombre']) ||
    !isset($_POST['password']) ||
    !isset($_POST['rol'])
) {
    $_SESSION['msg'] = "Faltan datos del formulario.";
    header("Location: registro.php");
    exit;
}

$numero  = trim($_POST['numero_control']);
$nombre  = trim($_POST['nombre']);
$pass    = trim($_POST['password']); // SIN hash (como pediste)
$rol     = trim($_POST['rol']);

// Preparar consulta
$sql = "INSERT INTO usuarios (numero_control, nombre, password, rol)
        VALUES (?, ?, ?, ?)";

$params = array($numero, $nombre, $pass, $rol);

$stmt = sqlsrv_query($conn, $sql, $params);

// Validar resultado
if ($stmt === false) {
    $_SESSION['msg'] = "Error al registrar usuario: " . print_r(sqlsrv_errors(), true);
    header("Location: registro.php");
    exit;
}

// Si todo salió bien
$_SESSION['msg'] = "Usuario registrado correctamente.";
header("Location: registro.php");
exit;

?>

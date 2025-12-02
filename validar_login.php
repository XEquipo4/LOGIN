<?php
session_start();
require "conexion.php";

if (!isset($_POST['numero_control'], $_POST['password'])) {
    header("Location: index.php");
    exit;
}

$numero = trim($_POST['numero_control']);
$password = trim($_POST['password']);

// Consulta en SQL Server
$sql = "SELECT * FROM usuarios WHERE numero_control = ?";
$params = array($numero);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// VALIDAR SI EXISTE EL USUARIO
if (!$user) {
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: index.php");
    exit;
}

// VALIDAR CONTRASEÑA SIN HASH (como lo pediste)
if ($password !== $user['password']) {
    $_SESSION['error'] = "Contraseña incorrecta";
    header("Location: index.php");
    exit;
}

// GUARDAR DATOS EN SESIÓN
$_SESSION['id']             = $user['id'];
$_SESSION['numero_control'] = $user['numero_control'];
$_SESSION['nombre']         = $user['nombre'];
$_SESSION['rol']            = $user['rol'];

// REDIRECCIÓN SEGÚN ROL
switch ($user['rol']) {
    case 'alumno':
        header("Location: alumno/dashboard.php");
        break;

    case 'profesor':
        header("Location: maestro/dashboard.php");
        break;

    case 'administrador':
        header("Location: admin/dashboard.php");
        break;

    default:
        $_SESSION['error'] = "Rol no válido";
        header("Location: index.php");
        break;
}

exit;
?>

<?php
session_start();
require "conexion.php";

$numero = $_POST['numero_control'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE numero_control = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$numero]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['error'] = "Número de control incorrecto.";
    header("Location: index.php");
    exit;
}

if (!password_verify($password, $user['password'])) {
    $_SESSION['error'] = "Contraseña incorrecta.";
    header("Location: index.php");
    exit;
}

// Guardamos datos de sesión
$_SESSION['user_id'] = $user['id'];
$_SESSION['rol'] = $user['rol'];
$_SESSION['nombre'] = $user['nombre'];

// Redirección según rol
if ($user['rol'] == "alumno") {
    header("Location: alumno/dashboard.php");
} else {
    header("Location: maestro/dashboard.php");
}

exit;
?>

<?php
session_start();
require "conexion.php";

$numero = $_POST['numero_control'];
$pass   = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE numero_control = ?";
$stmt = sqlsrv_query($conn, $sql, array($numero));

if ($stmt && $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

    if ($row['password'] === $pass) {

        $_SESSION['usuario'] = $row['numero_control'];
        $_SESSION['rol'] = $row['rol'];

        if ($row['rol'] == 'alumno') {
            header("Location: alumno/dashboard.php");
        } else {
            header("Location: maestro/dashboard.php");
        }
        exit;

    } else {
        $_SESSION['error'] = "Contraseña incorrecta";
        header("Location: index.php");
        exit;
    }

} else {
    $_SESSION['error'] = "El usuario no existe";
    header("Location: index.php");
    exit;
}
?>

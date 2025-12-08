<?php
session_start();
require "../conexion.php";

// Verificar rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$clave = $_POST['clave'];
$descripcion = $_POST['descripcion'];

// Validación simple
if (empty($nombre) || empty($clave)) {
    echo "<script>alert('El nombre y la clave son obligatorios.'); history.back();</script>";
    exit;
}

// Query para insertar en la tabla materias
$sql = "INSERT INTO materias (nombre, clave, descripcion) VALUES (?, ?, ?)";
$params = array($nombre, $clave, $descripcion);

// Ejecutar consulta
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    echo "<script>
            alert('Materia registrada correctamente');
            window.location = 'materias.php';
          </script>";
} else {
    echo "<pre>Error al guardar la materia.\n";
    print_r(sqlsrv_errors());
    echo "</pre>";
}
?>

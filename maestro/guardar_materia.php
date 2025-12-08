<?php
session_start();
require "../conexion.php";

// Verificar rol
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"]);
    $carrera = trim($_POST["carrera"]);

    if (empty($nombre) || empty($carrera)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: agregar_materia.php");
        exit;
    }

    // Generar clave automática: ej. MAT-A83FZ
    $clave = "MAT-" . strtoupper(substr(md5(uniqid()), 0, 5));

    // Query SQL Server
    $sql = "INSERT INTO materias (nombre, carrera, clave) VALUES (?, ?, ?)";
    $params = array($nombre, $carrera, $clave);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        $_SESSION['error'] = "Error al guardar la materia: " . print_r(sqlsrv_errors(), true);
        header("Location: agregar_materia.php");
        exit;
    }

    $_SESSION['success'] = "Materia creada correctamente. Clave generada: $clave";
    header("Location: agregar_materia.php");
    exit;
}
?>

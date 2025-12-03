<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_POST['materia_id'], $_POST['alumno_id'])) {
    $_SESSION['error'] = "Datos incompletos";
    header("Location: asignar_materia.php");
    exit;
}

$materia_id = $_POST['materia_id'];
$alumno_id  = $_POST['alumno_id'];

// Verificar si ya está asignada
$sqlCheck = "SELECT * FROM materias_asignadas WHERE alumno_id = ? AND materia_id = ?";
$paramsCheck = array($alumno_id, $materia_id);
$check = sqlsrv_query($conn, $sqlCheck, $paramsCheck);

if ($row = sqlsrv_fetch_array($check, SQLSRV_FETCH_ASSOC)) {
    $_SESSION['error'] = "Este alumno ya está asignado a esta materia";
    header("Location: asignar_materia.php");
    exit;
}

// Insertar asignación
$sqlInsert = "
    INSERT INTO materias_asignadas (alumno_id, materia_id, calificacion)
    VALUES (?, ?, NULL)
";
$paramsInsert = array($alumno_id, $materia_id);

$result = sqlsrv_query($conn, $sqlInsert, $paramsInsert);

if ($result) {
    $_SESSION['success'] = "Materia asignada correctamente";
    header("Location: asignar_materia.php");
} else {
    echo "Error al guardar: ";
    print_r(sqlsrv_errors());
}

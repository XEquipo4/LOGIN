<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php");
    exit;
}

require "../conexion.php";

$alumno_id = $_POST['alumno_id'];
$materias = $_POST['materias'] ?? [];

// eliminar asignaciones anteriores
sqlsrv_query($conn, "DELETE FROM alumno_materia WHERE alumno_id = ?", [$alumno_id]);

// insertar las nuevas
foreach ($materias as $materia_id) {
    sqlsrv_query($conn, 
        "INSERT INTO alumno_materia (alumno_id, materia_id) VALUES (?, ?)", 
        [$alumno_id, $materia_id]
    );
}

header("Location: materias_asignadas.php?id=$alumno_id");
exit;

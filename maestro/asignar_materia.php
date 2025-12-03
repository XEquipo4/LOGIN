<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $alumno_id = $_POST['alumno_id'];
    $materia_id = $_POST['materia_id'];
    $calificacion = $_POST['calificacion'];

    // EVITAR SQL INJECTION
    $alumno_id = $conn->real_escape_string($alumno_id);
    $materia_id = $conn->real_escape_string($materia_id);
    $calificacion = $conn->real_escape_string($calificacion);

    $sql = "INSERT INTO materias_asignadas (alumno_id, materia_id, calificacion)
            VALUES ('$alumno_id', '$materia_id', '$calificacion')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Materia asignada correctamente'); window.location='form_asignar_materia.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

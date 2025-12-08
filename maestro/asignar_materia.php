<?php
session_start();
include "conexion.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != "maestro") {
    header("Location: index.php");
    exit;
}

// RECIBIR DATOS DEL FORMULARIO
$alumno_id = $_POST['alumno_id'];
$materia_id = $_POST['materia_id'];
$calificacion = !empty($_POST['calificacion']) ? $_POST['calificacion'] : null;

// VALIDAR QUE NO EXISTA YA LA ASIGNACIÓN (EVITAR DUPLICADOS)
$check = $conn->prepare("SELECT id FROM alumno_materia WHERE alumno_id = ? AND materia_id = ?");
$check->bind_param("ii", $alumno_id, $materia_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "<script>
        alert('Este alumno ya tiene asignada esta materia.');
        window.location.href = 'asignar_materia_form.php';
    </script>";
    exit;
}

// INSERTAR LA ASIGNACIÓN
$sql = $conn->prepare("INSERT INTO alumno_materia (alumno_id, materia_id, calificacion) VALUES (?, ?, ?)");
$sql->bind_param("iii", $alumno_id, $materia_id, $calificacion);

if ($sql->execute()) {
    echo "<script>
        alert('Materia asignada correctamente.');
        window.location.href = 'asignar_materia_form.php';
    </script>";
} else {
    echo "Error: " . $conn->error;
}
?>

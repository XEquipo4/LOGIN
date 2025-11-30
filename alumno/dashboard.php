<?php
session_start();
if ($_SESSION['rol'] !== 'alumno') {
    header("Location: ../index.php"); exit;
}
?>
<h2>Bienvenido alumno: <?= $_SESSION['usuario'] ?></h2>
<a href="../logout.php">Cerrar sesión</a>

<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'maestro') {
    header("Location: ../index.php");
    exit;
}
?>
<h1>Bienvenido Maestro: <?= $_SESSION['usuario']; ?></h1>
<a href="../logout.php">Cerrar sesión</a>

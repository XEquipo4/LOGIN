<?php
session_start();
if ($_SESSION['rol'] !== 'maestro') {
    header("Location: ../index.php"); exit;
}
?>
<h2>Bienvenido maestro: <?= $_SESSION['usuario'] ?></h2>
<a href="../logout.php">Cerrar sesión</a>

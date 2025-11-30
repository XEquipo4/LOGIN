<?php
session_start();
if ($_SESSION["user"]["rol"] !== "alumno") { header("Location: ../index.php"); }
?>
<h2>Tus calificaciones</h2>

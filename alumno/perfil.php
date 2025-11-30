<?php
session_start();
if ($_SESSION["user"]["rol"] !== "alumno") { header("Location: ../index.php"); }
?>
<h2>Perfil del alumno</h2>

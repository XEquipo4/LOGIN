<?php
session_start();
if ($_SESSION["user"]["rol"] !== "maestro") { header("Location: ../index.php"); }
?>
<h2>Perfil del maestro</h2>

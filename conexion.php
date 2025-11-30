<?php
$serverName = "tcp:databasetecnm.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "basedatostecnm",
    "Uid" => "admin_tecnm",
    "PWD" => "Cloud_Solution123",
    "LoginTimeout" => 30,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Error en la conexión: " . print_r(sqlsrv_errors(), true));
}
?>

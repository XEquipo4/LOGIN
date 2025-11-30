<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $numero_control = $_POST['numero_control'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE numero_control = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $numero_control, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        $_SESSION['numero_control'] = $usuario['numero_control'];
        $_SESSION['rol'] = $usuario['rol'];

        if ($usuario['rol'] === "alumno") {
            header("Location: alumno.php");
            exit();
        } elseif ($usuario['rol'] === "maestro") {
            header("Location: maestro.php");
            exit();
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Iniciar sesión</h2>

<?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form action="" method="POST">
    <label>Número de control:</label>
    <input type="text" name="numero_control" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Ingresar</button>
</form>

</body>
</html>

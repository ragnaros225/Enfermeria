<?php
session_start();
include 'conexion.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM admin WHERE usuario = ? AND contrasena = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $_SESSION['admin'] = $usuario;
    header("Location: admin_panel.php");
    exit;
} else {
    echo "❌ Usuario o contraseña incorrectos.";
}
?>
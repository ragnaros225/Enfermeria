<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];

$sql = "INSERT INTO usuarios (nombre, correo) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nombre, $correo);

if ($stmt->execute()) {
    $id_usuario = $stmt->insert_id;
    header("Location: pretest.php?id_usuario=" . $id_usuario);
    exit; // 🔥 NECESARIO: sin esto, el script puede seguir corriendo
} else {
    echo "Error al registrar usuario: " . $stmt->error;
}

$conn->close();
?>
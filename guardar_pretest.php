<?php
include 'conexion.php';

$id_usuario = $_POST['id_usuario'];
$signo = $_POST['signo_anemia'];
$consecuencias = $_POST['consecuencias'];
$alimentos = $_POST['alimentos_hierro'];
$absorcion = $_POST['absorcion_hierro'];
$lactancia = $_POST['lactancia'];
$vacunacion = $_POST['vacunacion_materna'];

$sql = "INSERT INTO pretest (id_usuario, signo_anemia, consecuencias, alimentos_hierro, absorcion_hierro, lactancia, vacunacion_materna)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssss", $id_usuario, $signo, $consecuencias, $alimentos, $absorcion, $lactancia, $vacunacion);

if ($stmt->execute()) {
    // ✅ Redirige al formulario principal después de guardar
    header("Location: formulario.html");
    exit;
} else {
    echo "❌ Error: " . $stmt->error;
}
$conn->close();
?>

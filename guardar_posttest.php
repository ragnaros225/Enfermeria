<?php
include 'conexion.php';

$id_usuario = $_POST['id_usuario'];
$sintomas = $_POST['sintomas_anemia'];
$alimentos = $_POST['alimentos_ricos_hierro'];
$evitar = $_POST['alimentos_evitar'];
$vitamina = $_POST['importancia_vitamina_c'];
$lactancia = $_POST['conocimiento_lactancia'];

$sql = "INSERT INTO posttest (id_usuario, sintomas_anemia, alimentos_ricos_hierro, alimentos_evitar, importancia_vitamina_c, conocimiento_lactancia)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $id_usuario, $sintomas, $alimentos, $evitar, $vitamina, $lactancia);

if ($stmt->execute()) {
    // ✅ Redirigir al index después de guardar
    header("Location: valoracion.php?id_usuario=$id_usuario");
exit;
} else {
    echo "❌ Error al guardar: " . $stmt->error;
}

$conn->close();
?>

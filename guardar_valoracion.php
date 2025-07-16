<?php
include 'conexion.php';

$id = $_POST['id_usuario'];
$opinion = $_POST['opinion_pagina'];
$utilidad = $_POST['utilidad_info'];
$recomendacion = $_POST['recomendacion'];
$interes = $_POST['seccion_interes'];
$mejoras = $_POST['mejoras'];

$sql = "INSERT INTO valoracion (id_usuario, opinion_pagina, utilidad_info, recomendacion, seccion_interes, mejoras)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $id, $opinion, $utilidad, $recomendacion, $interes, $mejoras);

if ($stmt->execute()) {
    header("Location: index.html");
    exit;
} else {
    echo "Error al guardar valoración: " . $stmt->error;
}
?>

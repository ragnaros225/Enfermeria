<?php
session_start(); // Inicia sesión
include 'conexion.php';

// Obtén el ID de usuario de la SESIÓN (más seguro que GET/POST)
$id_usuario = $_SESSION['id_usuario'] ?? null;

if (!$id_usuario) {
    die("Error: No se identificó al usuario. Vuelve a iniciar sesión.");
}

$opinion = $_POST['opinion_pagina'] ?? '';
$utilidad = $_POST['utilidad_info'] ?? '';
$recomendacion = $_POST['recomendacion'] ?? '';
$interes = $_POST['seccion_interes'] ?? '';
$mejoras = $_POST['mejoras'] ?? '';

// Verifica primero si el usuario existe
$check = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
$check->bind_param("i", $id_usuario);
$check->execute();

if ($check->get_result()->num_rows === 0) {
    die("Error: Usuario no registrado");
}

// Inserta la valoración
$sql = "INSERT INTO valoracion (id_usuario, opinion_pagina, utilidad_info, recomendacion, seccion_interes, mejoras)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssss", $id_usuario, $opinion, $utilidad, $recomendacion, $interes, $mejoras);

if ($stmt->execute()) {
    header("Location: index.php?success=1");
} else {
    echo "Error al guardar: " . $stmt->error;
}
?>
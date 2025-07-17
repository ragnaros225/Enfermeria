<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];

    // Obtener las 10 respuestas
    $respuestas = [];
    for ($i = 1; $i <= 10; $i++) {
        $campo = 'respuesta' . $i;
        $respuestas[$i] = $_POST[$campo] ?? '';
    }

    // Consulta SQL para insertar el cuestionario
  $sql = "INSERT INTO cuestionarios (
            id_usuario, respuesta1, respuesta2, respuesta3, respuesta4, respuesta5,
            respuesta6, respuesta7, respuesta8, respuesta9, respuesta10
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            "issssssssss",
            $id_usuario,
            $respuestas[1],
            $respuestas[2],
            $respuestas[3],
            $respuestas[4],
            $respuestas[5],
            $respuestas[6],
            $respuestas[7],
            $respuestas[8],
            $respuestas[9],
            $respuestas[10]
        );

        if ($stmt->execute()) {
            echo "<script>alert('¡Gracias por responder el cuestionario!'); window.location.href='formulario.php';</script>";
        } else {
            echo "Error al guardar respuestas: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>

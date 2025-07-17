<?php
include("conexion.php");

// NUEVO: Iniciar sesión para mantener el id_usuario
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];

    // NUEVO: Verificar que el usuario exista antes de insertar
    $check_user = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
    $check_user->bind_param("i", $id_usuario);
    $check_user->execute();
    
    if ($check_user->get_result()->num_rows === 0) {
        die("Error: El usuario no existe en la base de datos");
    }

    // Obtener las 10 respuestas
    $respuestas = [];
    for ($i = 1; $i <= 10; $i++) {
        $campo = 'respuesta' . $i;
        $respuestas[$i] = $_POST[$campo] ?? '';
    }

    // Consulta SQL para insertar en cuestionarios2
    $sql = "INSERT INTO cuestionarios2 (
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
            // NUEVO: Guardar id_usuario en sesión para la próxima página
            $_SESSION['id_usuario'] = $id_usuario;
            
            echo "<script>alert('¡Gracias por responder el post-test!'); window.location.href='valoracion.php';</script>";
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
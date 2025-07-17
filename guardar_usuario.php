<?php
include 'conexion.php';

// Obtener y sanitizar todos los datos del formulario
$nombre = trim($_POST['nombre'] ?? '');
$edad = intval($_POST['edad'] ?? 0);
$nivel_instruccion = trim($_POST['nivel_instruccion'] ?? '');
$ocupacion = trim($_POST['ocupacion'] ?? '');
$procedencia = trim($_POST['procedencia'] ?? '');
$num_hijos = intval($_POST['num_hijos'] ?? 0);

// Validaciones exhaustivas
$errores = [];

if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio";
}

if ($edad < 1 || $edad > 120) {
    $errores[] = "La edad debe estar entre 1 y 120 años";
}

// Validar valores contra ENUMs de la base de datos
$valoresValidos = [
    'nivel_instruccion' => ['Sin instrucción', 'Primaria', 'Secundaria', 'Superior'],
    'ocupacion' => ['Ama de casa', 'Estudiante', 'Trabajo independiente', 'Trabajo dependiente'],
    'procedencia' => ['Urbana', 'Periurbana', 'Rural']
];

foreach ($valoresValidos as $campo => $opciones) {
    if (!in_array($$campo, $opciones)) {
        $errores[] = "Valor no válido para $campo: " . htmlspecialchars($$campo);
    }
}

if ($num_hijos < 0) {
    $errores[] = "El número de hijos no puede ser negativo";
}

// Si hay errores, mostrarlos y detener la ejecución
if (!empty($errores)) {
    echo "<h2>Errores encontrados:</h2><ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    exit;
}

// Preparar la consulta SQL con todos los campos
$sql = "INSERT INTO usuarios (
    nombre, 
    edad, 
    nivel_instruccion, 
    ocupacion, 
    procedencia, 
    num_hijos
) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Tipos: s=string, i=integer
    $stmt->bind_param(
        "sisssi",  
        $nombre,
        $edad,
        $nivel_instruccion,
        $ocupacion,
        $procedencia,
        $num_hijos
    );

    if ($stmt->execute()) {
        $id_usuario = $stmt->insert_id;
        header("Location: pretest.php?id_usuario=" . $id_usuario);
        exit;
    } else {
        // Error detallado de MySQL
        echo "<h2>Error al registrar usuario</h2>";
        echo "<p>Error MySQL: " . $stmt->error . "</p>";
        echo "<p>Consulta: " . $sql . "</p>";
    }
} else {
    echo "<h2>Error en la preparación de la consulta</h2>";
    echo "<p>" . $conn->error . "</p>";
}

$stmt->close();
$conn->close();
?>
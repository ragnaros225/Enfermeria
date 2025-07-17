<?php
session_start(); // Iniciar sesión
include 'conexion.php';

// Obtener ID de usuario (de sesión o GET)
$id_usuario = $_SESSION['id_usuario'] ?? $_GET['id_usuario'] ?? null;

// Verificar que el usuario exista
if ($id_usuario) {
    $check = $conn->prepare("SELECT id FROM usuarios WHERE id = ?");
    $check->bind_param("i", $id_usuario);
    $check->execute();
    if ($check->get_result()->num_rows === 0) {
        die("Usuario no registrado");
    }
} else {
    die("ID de usuario no proporcionado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Post-Test sobre Anemia</title>
  <link rel="stylesheet" href="Estilos/styles2.css">
  <link rel="stylesheet" href="Estilos/formulario-imagenes.css">
  <link rel="stylesheet" href="Estilos/registro.css">
  <link rel="stylesheet" href="Estilos/preposttest.css">
</head>
<body style="background: linear-gradient(180deg, #AEE9FF 0%, #7EC8E3 60%, #B3D8F7 100%);">
  <div class="formulario-layout">
    <div class="pretest-card-glass">
      <h1 class="pretest-title">Post-Test sobre Anemia Infantil</h1>
      <form action="guardar_cuestionario2.php" method="post">
    <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
        <?php
        $preguntas = [
          "¿Qué es la anemia?" => ["a) Es la disminución de la hemoglobina", "b) Es la disminución de la glucosa", "c) Es el aumento de la hemoglobina", "d) Es la disminución del colesterol"],
          "Un niño llega a tener anemia por:" => ["a) Consumir alimentos y agua contaminada", "b) Consumir alimentos con pocas vitaminas", "c) Consumir pocos alimentos ricos en hierro", "d) Consumir embutidos o frituras"],
          "¿Conoce usted qué alimentos contienen más hierro?" => ["a) Leche Gloria", "b) Sangrecita de pollo", "c) Brócoli", "d) Sémola"],
          "Un niño que sufre de anemia, presenta la piel de color:" => ["a) Rosada", "b) Pálida", "c) Azulada"],
          "¿Qué alimentos ayudan a la absorción del hierro?" => ["a) Jugo de naranja, limón, naranja", "b) Palta, rabanito, tomate, espinaca", "c) Leche, té, anís, manzanilla", "d) Manzanilla, hierba luisa, romero"],
          "¿Qué alimentos se deben comer para prevenir la anemia?" => ["a) Verduras y frutas", "b) Cereales y frutos secos", "c) Vísceras, carne, huevo", "d) Hamburguesas, pollo a la brasa, pizza"],
          "¿Cuál tiene mayor contenido de hierro?" => ["a) Pollo, huevo, chancho", "b) Sangrecita, bofe, hígado", "c) Leche, queso, mantequilla", "d) Carne de res, charqui"],
          "¿Cuáles son los principales signos de alarma de la anemia?" => ["a) Enrojecimiento de la piel, temblores", "b) Cansancio y palidez, pérdida del apetito", "c) Caída del cabello, gripe", "d) Piel azulada, fiebre"],
          "¿Qué prueba se usa para confirmar la anemia?" => ["a) Prueba de colesterol", "b) Prueba de glucosa", "c) Prueba de hemoglobina y hematocrito", "d) Prueba de Elisa"],
          "¿Conoce la importancia de la lactancia materna exclusiva?" => ["Sí", "No"]
        ];

        $numero = 1;
        foreach ($preguntas as $texto => $opciones) {
          echo "<div class='question'>";
          echo "<div class='question-text'><span class='question-number'>$numero</span> $texto</div>";
          echo "<div class='options'><select name='respuesta$numero' required>";
          foreach ($opciones as $op) {
            echo "<option value=\"$op\">$op</option>";
          }
          echo "</select></div></div>";
          $numero++;
        }
        ?>

        <button type="submit" class="submit-btn">Enviar Post-Test</button>
      </form>
    </div>
  </div>
</body>
</html>
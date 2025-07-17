<?php
$id_usuario = $_GET['id_usuario'] ?? null;
if (!$id_usuario) {
  echo "ID de usuario no proporcionado.";
  exit;
}

// Definir $preguntas ANTES de usarla en el HTML
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
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cuestionario sobre Anemia</title>
  <link rel="stylesheet" href="estilos/formulario-imagenes.css">
  <link rel="stylesheet" href="estilos/preposttest.css">
</head>

<body style="background: linear-gradient(180deg, #AEE9FF 0%, #7EC8E3 60%, #B3D8F7 100%); margin: 0; padding: 20px;">
  <div class="formulario-layout" style="display: flex; min-height: calc(100vh - 40px); overflow: hidden;">
    <div class="formulario-imagenes-col imagenes-izq" style="flex-shrink: 0;">
      <img src="img/estetoscopio.png" alt="Estetoscopio" class="img-efecto img-estetoscopio">
      <img src="img/frasco.png" alt="Frasco" class="img-efecto img-frasco">
    </div>
    <div class="container">
      <div class="header">
        <h1>Cuestionario sobre Anemia Infantil</h1>
        <p>Responde las siguientes preguntas para identificar posibles señales de anemia en tu hijo(a)</p>
      </div>
      <form action="guardar_cuestionario.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

        <?php
$numero = 1;
foreach ($preguntas as $texto => $opciones) {
  echo "<div class='question' style='margin-bottom: 32px;'>";
  echo "<div class='question-text' style='margin-bottom: 12px;'><span class='question-number'>$numero</span> $texto</div>";
  echo "<div class='options' style='margin-top: 10px;'>";
  echo "<select name='respuesta$numero' required style='width: 100%; padding: 12px; border-radius: 18px; border: 1px solid #ccc; background: white; font-size: 16px;'>";
  echo "<option value='' disabled selected>Selecciona una opción</option>";
  foreach ($opciones as $op) {
    echo "<option value=\"$op\">$op</option>";
  }
  echo "</select>";
  echo "</div></div>";
  $numero++;
}
?>

        <button type="submit" class="submit-btn">Enviar Cuestionario</button>
      </form>
    </div>
  </div>
</body>


</html>
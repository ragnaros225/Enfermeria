<?php
$id_usuario = $_GET['id_usuario'] ?? null;
if (!$id_usuario) {
  echo "ID de usuario no proporcionado.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Pre-Test Anemia Infantil</title>
  <link rel="stylesheet" href="Estilos/styles2.css">
  <link rel="stylesheet" href="Estilos/formulario-imagenes.css">
  <link rel="stylesheet" href="Estilos/registro.css">
  <link rel="stylesheet" href="Estilos/preposttest.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@700&display=swap" rel="stylesheet">
</head>

<body style="background: linear-gradient(180deg, #AEE9FF 0%, #7EC8E3 60%, #B3D8F7 100%);">
  <div class="formulario-layout">
    <div class="formulario-imagenes-col imagenes-izq">
      <img src="Img/estetoscopio.png" alt="Estetoscopio" class="img-efecto img-estetoscopio">
      <img src="Img/frasco.png" alt="Frasco" class="img-efecto img-frasco">
    </div>
    <div class="pretest-card-glass">
      <h1 class="pretest-title" style="font-family:'Segoe UI', Arial, sans-serif;">Pre-Test Anemia Infantil</h1>
      <p class="pretest-desc">Responde las siguientes preguntas antes de iniciar la evaluación principal.</p>
      <form action="guardar_pretest.php" method="post" id="pretest-form">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
        <div class="registro-fields">
          <div class="question">
            <div class="question-text">
              <span class="question-number">1</span>
              ¿Cuáles de los siguientes signos cree usted que son característicos de la anemia infantil?
            </div>
            <div class="options">
              <select name="signo_anemia" id="signo_anemia" required>
                <option value="Cansancio frecuente y Retraso en el crecimiento">Cansancio frecuente y Retraso en el crecimiento</option>
                <option value="Bastante hambre y fiebre alta">Bastante hambre y fiebre alta</option>
                <option value="Yogur, leche y sangrecita">Yogur, leche y sangrecita</option>
              </select>
            </div>
          </div>
          <div class="question">
            <div class="question-text">
              <span class="question-number">2</span>
              ¿Conoce usted las consecuencias de una mala alimentación o de una anemia no tratada en niños?
            </div>
            <div class="options">
              <select name="consecuencias" id="consecuencias" required>
                <option>Sí, algunas</option>
                <option>Sí, muchas</option>
                <option>No</option>
                <option>No estoy seguro(a)</option>
                <option>Me gustaría aprender más</option>
              </select>
            </div>
          </div>
          <div class="question">
            <div class="question-text">
              <span class="question-number">3</span>
              ¿Cuál de los siguientes alimentos considera que son ricos en hierro?
            </div>
            <div class="options">
              <select name="alimentos_hierro" id="alimentos_hierro" required>
                <option>Hígado de res, Lenteja y Sangrecita</option>
                <option>Papa, Fideos y Espinacas</option>
              </select>
            </div>
          </div>
          <div class="question">
            <div class="question-text">
              <span class="question-number">4</span>
              ¿Sabe cómo mejorar la absorción del hierro en la alimentación diaria?
            </div>
            <div class="options">
              <select name="absorcion_hierro" id="absorcion_hierro" required>
                <option>Sí</option>
                <option>No</option>
                <option>Más o menos</option>
                <option>Necesito más información al respecto</option>
              </select>
            </div>
          </div>
          <div class="question">
            <div class="question-text">
              <span class="question-number">5</span>
              ¿Conoce la importancia de la lactancia materna exclusiva durante los primeros 6 meses?
            </div>
            <div class="options">
              <select name="lactancia" id="lactancia" required>
                <option>Sí</option>
                <option>No</option>
                <option>He escuchado algo, pero no estoy segura/o</option>
                <option>Me gustaría saber más sobre ese tema</option>
              </select>
            </div>
          </div>
          <div class="question">
            <div class="question-text">
              <span class="question-number">6</span>
              ¿Considera que la vacunación materna protege también al recién nacido?
            </div>
            <div class="options">
              <select name="vacunacion_materna" id="vacunacion_materna" required>
                <option>Sí</option>
                <option>No</option>
                <option>No lo sabía</option>
                <option>Necesito más información</option>
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="submit-btn">Enviar Pre-Test</button>
      </form>
    </div>
  </div>
  <div class="formulario-imagenes-col imagenes-der">
    <img src="Img/vacuna.png" alt="Vacuna" class="img-efecto img-vacuna">
  </div>
  </div>
  <script src="Js/formulario-imagenes-scrollparallax.js"></script>
</body>

</html>
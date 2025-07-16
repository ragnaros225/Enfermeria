<?php
$id_usuario = $_GET['id_usuario'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Valoración del sitio</title>
  <style>
    body { font-family: Arial; padding: 20px; background: #f2f2f2; }
    form { background: white; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto; }
    select, button { width: 100%; padding: 10px; margin-top: 10px; }
  </style>
</head>
<body>

<h2>Valoración del sitio web</h2>

<form action="guardar_valoracion.php" method="post">
  <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

  <label>12. ¿Qué te pareció esta página web?</label>
  <select name="opinion_pagina" required>
    <option>Excelente</option>
    <option>Buena</option>
    <option>Regular</option>
    <option>Mala</option>
  </select>

  <label>13. ¿Te fue útil la información brindada?</label>
  <select name="utilidad_info" required>
    <option>Muy útil</option>
    <option>Útil</option>
    <option>Poco útil</option>
    <option>Nada útil</option>
    <option>No comprendí bien</option>
  </select>

  <label>14. ¿Recomendarías esta web a otras personas?</label>
  <select name="recomendacion" required>
    <option>Sí</option>
    <option>Tal vez</option>
    <option>No</option>
  </select>

  <label>15. ¿Qué sección te pareció más útil o interesante?</label>
  <select name="seccion_interes" required>
    <option>Información sobre anemia</option>
    <option>Recomendaciones de alimentación</option>
    <option>Sección de signos y síntomas</option>
    <option>Recetario saludable</option>
  </select>

  <label>16. ¿Qué mejorarías en nuestra página web?</label>
  <select name="mejoras" required>
    <option>Diseño visual</option>
    <option>Interacción y navegación</option>
    <option>Claridad del lenguaje</option>
  </select>

  <button type="submit">Enviar Valoración</button>
</form>

</body>
</html>

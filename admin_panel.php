<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

include 'conexion.php';

// Consultas
$usuarios = $conn->query("SELECT * FROM usuarios");
$pretest = $conn->query("SELECT * FROM pretest");
$posttest = $conn->query("SELECT * FROM posttest");
$valoracion = $conn->query("SELECT * FROM valoracion");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    h2 { margin-top: 40px; }
    table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #f4f4f4; }
  </style>
</head>
<body>

<h1>Bienvenido, <?php echo $_SESSION['admin']; ?></h1>
<a href="admin_logout.php">Cerrar sesión</a>

<h2>Usuarios Registrados</h2>
<table>
  <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Fecha</th></tr>
  <?php while($row = $usuarios->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['nombre'] ?></td>
      <td><?= $row['correo'] ?></td>
      <td><?= $row['fecha_registro'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>

<h2>Respuestas Pre-Test</h2>
<table>
  <tr><th>ID Usuario</th><th>Signo</th><th>Consecuencias</th><th>Hierro</th><th>Absorción</th><th>Lactancia</th><th>Vacunación</th></tr>
  <?php while($row = $pretest->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id_usuario'] ?></td>
      <td><?= $row['signo_anemia'] ?></td>
      <td><?= $row['consecuencias'] ?></td>
      <td><?= $row['alimentos_hierro'] ?></td>
      <td><?= $row['absorcion_hierro'] ?></td>
      <td><?= $row['lactancia'] ?></td>
      <td><?= $row['vacunacion_materna'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>

<h2>Respuestas Post-Test</h2>
<table>
  <tr><th>ID Usuario</th><th>Síntomas</th><th>Hierro</th><th>Evitar</th><th>Vitamina C</th><th>Lactancia</th></tr>
  <?php while($row = $posttest->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id_usuario'] ?></td>
      <td><?= $row['sintomas_anemia'] ?></td>
      <td><?= $row['alimentos_ricos_hierro'] ?></td>
      <td><?= $row['alimentos_evitar'] ?></td>
      <td><?= $row['importancia_vitamina_c'] ?></td>
      <td><?= $row['conocimiento_lactancia'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>

<h2>Valoraciones</h2>
<table>
  <tr><th>ID Usuario</th><th>Opinión</th><th>Utilidad</th><th>Recomendación</th><th>Sección Interés</th><th>Mejoras</th></tr>
  <?php while($row = $valoracion->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id_usuario'] ?></td>
      <td><?= $row['opinion_pagina'] ?></td>
      <td><?= $row['utilidad_info'] ?></td>
      <td><?= $row['recomendacion'] ?></td>
      <td><?= $row['seccion_interes'] ?></td>
      <td><?= $row['mejoras'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>

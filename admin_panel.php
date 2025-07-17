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
$cuestionario = $conn->query("SELECT * FROM cuestionarios");
$cuestionario = $conn->query("SELECT cuestionarios.*, usuarios.nombre FROM cuestionarios 
  INNER JOIN usuarios ON cuestionarios.id_usuario = usuarios.id");
$cuestionario2_data = $conn->query("SELECT cuestionarios2.*, usuarios.nombre FROM cuestionarios2 INNER JOIN usuarios ON cuestionarios2.id_usuario = usuarios.id");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <link rel="stylesheet" href="Estilos/admin_panel.css">
</head>

<body>
  <div class="sidebar">
    <div class="sidebar-title">Panel Admin</div>
    <button class="tab-btn active" onclick="showTab('dashboard')">Dashboard</button>
    <button class="tab-btn" onclick="showTab('usuarios')">Usuarios</button>
    <button class="tab-btn" onclick="showTab('pretest')">Pre-Test</button>
    <button class="tab-btn" onclick="showTab('posttest')">Post-Test</button>
    <button class="tab-btn" onclick="showTab('valoraciones')">Valoraciones</button>
    <button class="tab-btn" onclick="showTab('cuestionario')">Cuestionario</button>
    <button class="tab-btn" onclick="showTab('cuestionario2')">Cuestionario 2</button>
    <button class="tab-btn logout-tab" onclick="window.location.href='admin_logout.php'">Cerrar sesión</button>
  </div>
  <div class="main-content">
    <div class="admin-panel-container">
      <div class="admin-panel-header">
        <h1>Bienvenido, <?php echo $_SESSION['admin']; ?></h1>
      </div>
      <div id="tab-dashboard" class="tab-content" style="display:block;">
        <h2>Dashboard de Reportes</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 32px; justify-content: center;">
          <div style="background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #a78bfa22; padding: 24px; min-width: 320px;">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Usuarios por mes</h3>
            <canvas id="graficoUsuarios" width="320" height="220"></canvas>
          </div>
          <div style="background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #a78bfa22; padding: 24px; min-width: 320px;">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Signos Pre-Test</h3>
            <canvas id="graficoPretest" width="320" height="220"></canvas>
          </div>
          <div style="background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #a78bfa22; padding: 24px; min-width: 320px;">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Síntomas Post-Test</h3>
            <canvas id="graficoPosttest" width="320" height="220"></canvas>
          </div>
          <div style="background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #a78bfa22; padding: 24px; min-width: 320px;">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Valoraciones</h3>
            <canvas id="graficoValoraciones" width="320" height="220"></canvas>
          </div>
        </div>
      </div>
      <div id="tab-usuarios" class="tab-content" style="display:none;">
        <h2>Usuarios Registrados</h2>
        <table class="admin-table">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Fecha</th>
          </tr>
          <?php $usuarios->data_seek(0);
          while ($row = $usuarios->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['nombre'] ?></td>
              <td><?= $row['correo'] ?></td>
              <td><?= $row['fecha_registro'] ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
      <div id="tab-pretest" class="tab-content" style="display:none;">
        <h2>Respuestas Pre-Test</h2>
        <table class="admin-table">
          <tr>
            <th>ID Usuario</th>
            <th>Signo</th>
            <th>Consecuencias</th>
            <th>Hierro</th>
            <th>Absorción</th>
            <th>Lactancia</th>
            <th>Vacunación</th>
          </tr>
          <?php $pretest->data_seek(0);
          while ($row = $pretest->fetch_assoc()): ?>
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
      </div>
      <div id="tab-posttest" class="tab-content" style="display:none;">
        <h2>Respuestas Post-Test</h2>
        <table class="admin-table">
          <tr>
            <th>ID Usuario</th>
            <th>Síntomas</th>
            <th>Hierro</th>
            <th>Evitar</th>
            <th>Vitamina C</th>
            <th>Lactancia</th>
          </tr>
          <?php $posttest->data_seek(0);
          while ($row = $posttest->fetch_assoc()): ?>
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
      </div>
      <div id="tab-valoraciones" class="tab-content" style="display:none;">
        <h2>Valoraciones</h2>
        <table class="admin-table">
          <tr>
            <th>ID Usuario</th>
            <th>Opinión</th>
            <th>Utilidad</th>
            <th>Recomendación</th>
            <th>Sección Interés</th>
            <th>Mejoras</th>
          </tr>
          <?php $valoracion->data_seek(0);
          while ($row = $valoracion->fetch_assoc()): ?>
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
      </div>
<div id="tab-cuestionario" class="tab-content" style="display:none;">
    <h2>Resultados del Cuestionario</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Respuesta 1</th>
                <th>Respuesta 2</th>
                <th>Respuesta 3</th>
                <th>Respuesta 4</th>
                <th>Respuesta 5</th>
                <th>Respuesta 6</th>
                <th>Respuesta 7</th>
                <th>Respuesta 8</th>
                <th>Respuesta 9</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $respuestas_correctas = [
                1 => 'a',
                2 => 'c',
                3 => 'b',
                4 => 'b',
                5 => 'a',
                6 => 'c',
                7 => 'b',
                8 => 'b',
                9 => 'c'
            ];

            // Consulta única con JOIN
            $cuestionario = $conn->query("SELECT cuestionarios.*, usuarios.nombre FROM cuestionarios 
              INNER JOIN usuarios ON cuestionarios.id_usuario = usuarios.id");

            if ($cuestionario && $cuestionario->num_rows > 0):
                while ($row = $cuestionario->fetch_assoc()):
                    $correctas = 0;
                    for ($i = 1; $i <= 9; $i++) {
                        $resp = isset($row["respuesta$i"]) ? strtolower(trim($row["respuesta$i"])) : '';
                        if ($resp === $respuestas_correctas[$i]) {
                            $correctas++;
                        }
                    }
                    $nivel = $correctas <= 3 ? 'Bajo' : ($correctas <= 6 ? 'Medio' : 'Alto');
            ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre'] ?? '') ?></td>
                <?php for ($i = 1; $i <= 9; $i++): ?>
                    <td><?= htmlspecialchars($row["respuesta$i"] ?? '') ?></td>
                <?php endfor; ?>
                <td><?= $nivel ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="11">No hay datos disponibles.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Nueva tabla solo para respuesta 10 -->
    <h2 style="margin-top: 40px;">Respuestas a la Pregunta 10</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Respuesta 10</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $respuesta10 = $conn->query("SELECT c.respuesta10, c.created_at, u.nombre 
                                       FROM cuestionarios c
                                       INNER JOIN usuarios u ON c.id_usuario = u.id
                                       WHERE c.respuesta10 IS NOT NULL");

            if ($respuesta10 && $respuesta10->num_rows > 0):
                while ($r10 = $respuesta10->fetch_assoc()):
            ?>
            <tr>
                <td><?= htmlspecialchars($r10['nombre'] ?? '') ?></td>
                <td><?= htmlspecialchars($r10['respuesta10'] ?? '') ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="3">No hay respuestas para la pregunta 10.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div id="tab-cuestionario2" class="tab-content" style="display:none;">
    <h2>Resultados del Cuestionario 2</h2>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Respuesta 1</th>
                <th>Respuesta 2</th>
                <th>Respuesta 3</th>
                <th>Respuesta 4</th>
                <th>Respuesta 5</th>
                <th>Respuesta 6</th>
                <th>Respuesta 7</th>
                <th>Respuesta 8</th>
                <th>Respuesta 9</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $respuestas_correctas = [
                1 => 'a',
                2 => 'c',
                3 => 'b',
                4 => 'b',
                5 => 'a',
                6 => 'c',
                7 => 'b',
                8 => 'b',
                9 => 'c'
            ];

            if ($cuestionario2_data && $cuestionario2_data->num_rows > 0):
                while ($row = $cuestionario2_data->fetch_assoc()):
                    $correctas = 0;
                    for ($i = 1; $i <= 9; $i++) {
                        $resp = isset($row["respuesta$i"]) ? strtolower(trim($row["respuesta$i"])) : '';
                        if ($resp === $respuestas_correctas[$i]) {
                            $correctas++;
                        }
                    }
                    $nivel = $correctas <= 3 ? 'Bajo' : ($correctas <= 6 ? 'Medio' : 'Alto');
            ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre'] ?? '') ?></td>
                <?php for ($i = 1; $i <= 9; $i++): ?>
                    <td><?= htmlspecialchars($row["respuesta$i"] ?? '') ?></td>
                <?php endfor; ?>
                <td><?= $nivel ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="11">No hay datos disponibles.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
    </div>
  </div>
</body>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="Js/admin_panel.js"></script>
<script>
  // --- DATOS DESDE PHP ---
  // 1. Usuarios por mes (ejemplo: cuenta usuarios por mes de registro)
  <?php
  $usuariosPorMes = [];
  $res = $conn->query("SELECT MONTHNAME(fecha_registro) as mes, COUNT(*) as total FROM usuarios GROUP BY mes ORDER BY MONTH(fecha_registro)");
  while ($row = $res->fetch_assoc()) {
    $usuariosPorMes[$row['mes']] = (int)$row['total'];
  }
  ?>
  const usuariosLabels = <?php echo json_encode(array_keys($usuariosPorMes)); ?>;
  const usuariosData = <?php echo json_encode(array_values($usuariosPorMes)); ?>;

  // 2. Pretest: cuenta de cada signo de anemia
  <?php
  $signos = [];
  $res = $conn->query("SELECT signo_anemia, COUNT(*) as total FROM pretest GROUP BY signo_anemia");
  while ($row = $res->fetch_assoc()) {
    $signos[$row['signo_anemia']] = (int)$row['total'];
  }
  ?>
  const pretestLabels = <?php echo json_encode(array_keys($signos)); ?>;
  const pretestData = <?php echo json_encode(array_values($signos)); ?>;

  // 3. Posttest: cuenta de cada síntoma
  <?php
  $sintomas = [];
  $res = $conn->query("SELECT sintomas_anemia, COUNT(*) as total FROM posttest GROUP BY sintomas_anemia");
  while ($row = $res->fetch_assoc()) {
    $sintomas[$row['sintomas_anemia']] = (int)$row['total'];
  }
  ?>
  const posttestLabels = <?php echo json_encode(array_keys($sintomas)); ?>;
  const posttestData = <?php echo json_encode(array_values($sintomas)); ?>;

  // 4. Valoraciones: cuenta de cada opinión
  <?php
  $opiniones = [];
  $res = $conn->query("SELECT opinion_pagina, COUNT(*) as total FROM valoracion GROUP BY opinion_pagina");
  while ($row = $res->fetch_assoc()) {
    $opiniones[$row['opinion_pagina']] = (int)$row['total'];
  }
  ?>
  const valoracionesLabels = <?php echo json_encode(array_keys($opiniones)); ?>;
  const valoracionesData = <?php echo json_encode(array_values($opiniones)); ?>;

  // --- GRAFICOS ---
  document.addEventListener('DOMContentLoaded', function() {
    // Usuarios por mes (barras)
    if (document.getElementById('graficoUsuarios')) {
      const ctx = document.getElementById('graficoUsuarios').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: usuariosLabels,
          datasets: [{
            label: 'Usuarios registrados',
            data: usuariosData,
            backgroundColor: ['#7c3aed', '#a78bfa', '#6366f1', '#818cf8', '#f472b6', '#fbbf24', '#34d399', '#60a5fa', '#f87171', '#a3e635', '#facc15', '#f472b6'],
            borderRadius: 8
          }]
        },
        options: {
          responsive: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
    // Pretest (circular)
    if (document.getElementById('graficoPretest')) {
      const ctx = document.getElementById('graficoPretest').getContext('2d');
      new Chart(ctx, {
        type: 'pie',
        data: {
          labels: pretestLabels,
          datasets: [{
            label: 'Signos de anemia',
            data: pretestData,
            backgroundColor: ['#7c3aed', '#a78bfa', '#6366f1', '#818cf8', '#f472b6', '#fbbf24']
          }]
        },
        options: {
          responsive: false
        }
      });
    }
    // Posttest (barras)
    if (document.getElementById('graficoPosttest')) {
      const ctx = document.getElementById('graficoPosttest').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: posttestLabels,
          datasets: [{
            label: 'Síntomas de anemia',
            data: posttestData,
            backgroundColor: ['#6366f1', '#818cf8', '#7c3aed', '#a78bfa', '#f472b6', '#fbbf24'],
            borderRadius: 8
          }]
        },
        options: {
          responsive: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }
    // Valoraciones (doughnut)
    if (document.getElementById('graficoValoraciones')) {
      const ctx = document.getElementById('graficoValoraciones').getContext('2d');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: valoracionesLabels,
          datasets: [{
            label: 'Valoraciones',
            data: valoracionesData,
            backgroundColor: ['#fbbf24', '#7c3aed', '#a78bfa', '#6366f1', '#818cf8', '#f472b6']
          }]
        },
        options: {
          responsive: false
        }
      });
    }
  });
</script>
</body>

</html>
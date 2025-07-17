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
  <link rel="stylesheet" href="estilos/admin_panel.css">
</head>

<body>
  <div class="sidebar">
    <div class="sidebar-title">Panel Admin</div>
    <button class="tab-btn active" onclick="showTab('dashboard')">Dashboard</button>
    <button class="tab-btn" onclick="showTab('usuarios')">Usuarios</button>
    <button class="tab-btn" onclick="showTab('valoraciones')">Valoraciones</button>
    <button class="tab-btn" onclick="showTab('cuestionario')">Cuestionario</button>
    <button class="tab-btn" onclick="showTab('cuestionario2')">Cuestionario 2</button>
    <button class="tab-btn logout-tab" onclick="window.location.href='admin_logout.php'">Cerrar sesión</button>
  </div>

  <!-- Modal para ver respuestas (moved outside .main-content for stacking context) -->
  <div id="modalRespuestas" class="modal-respuestas" style="display:none;">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Respuestas del usuario</h3>
        <button class="close-modal" aria-label="Cerrar">&times;</button>
      </div>
      <div id="modalPreguntasRespuestas"></div>
    </div>
  </div>

  <!-- Modal para ver respuestas Cuestionario 2 (moved outside .main-content for stacking context) -->
  <div id="modalRespuestas2" class="modal-respuestas" style="display:none;">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, #7c3aed 60%, #a78bfa 100%); color: #fff; padding: 18px 28px 10px 28px; border-top-left-radius: 16px; border-top-right-radius: 16px; display: flex; align-items: center; z-index: 200002;">
        <h3 style="color:#fff; margin:0; font-size:1.25rem; font-weight:800; letter-spacing:0.5px;">Respuestas del usuario</h3>
        <button class="close-modal2" aria-label="Cerrar" style="font-size:2.1rem; color:#fff; cursor:pointer; font-weight:bold; margin-left:18px; background:none; border:none; line-height:1; transition:color 0.15s;">&times;</button>
      </div>
      <div id="modalPreguntasRespuestas2" class="modal-preguntas-respuestas"></div>
    </div>
  </div>

  <div class="main-content">
    <div class="admin-panel-container">
      <div class="admin-panel-header">
        <h1>Bienvenido, <?php echo $_SESSION['admin']; ?></h1>
      </div>
      <div id="tab-dashboard" class="tab-content" style="display:block;">
        <h2>Dashboard de Reportes</h2>
        <!-- Los estilos de los tooltips y tarjetas del dashboard se movieron a Estilos/admin_panel.css -->
        <div class="dashboard-cards-row">
          <div class="dashboard-card">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Usuarios por mes
              <span class="info-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <circle cx="10" cy="10" r="10" fill="#6366f1" /><text x="7" y="15" font-size="12" fill="#fff">?</text>
                </svg>
                <span class="info-tooltip">Este gráfico muestra la cantidad de usuarios registrados en cada mes. Permite visualizar el crecimiento y la actividad de la plataforma a lo largo del tiempo.</span>
              </span>
            </h3>
            <canvas id="graficoUsuarios" width="320" height="220"></canvas>
          </div>
          <div class="dashboard-card">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Primer Cuestionario
              <span class="info-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <circle cx="10" cy="10" r="10" fill="#6366f1" /><text x="7" y="15" font-size="12" fill="#fff">?</text>
                </svg>
                <span class="info-tooltip">Comparativa del Primer Cuestionario: muestra cuántos usuarios respondieron "Sí" y "No" a la pregunta "¿Conoces la importancia de la lactancia materna exclusiva?" antes de recibir la información educativa. Permite visualizar el nivel de conocimiento inicial de los participantes.</span>
              </span>
            </h3>
            <canvas id="graficoComparativaPre" width="320" height="220"></canvas>
          </div>
          <div class="dashboard-card">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Segundo Cuestionario
              <span class="info-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <circle cx="10" cy="10" r="10" fill="#6366f1" /><text x="7" y="15" font-size="12" fill="#fff">?</text>
                </svg>
                <span class="info-tooltip">Comparativa del Segundo Cuestionario: muestra las respuestas "Sí" y "No" a la misma pregunta después de que los usuarios han recibido la información. Permite comparar el impacto de la información brindada en el conocimiento de los participantes.</span>
              </span>
            </h3>
            <canvas id="graficoComparativaPost" width="320" height="220"></canvas>
          </div>
          <div class="dashboard-card">
            <h3 style="margin-bottom:10px; color:#7c3aed;">Valoraciones
              <span class="info-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <circle cx="10" cy="10" r="10" fill="#6366f1" /><text x="7" y="15" font-size="12" fill="#fff">?</text>
                </svg>
                <span class="info-tooltip">Este gráfico muestra la cantidad de valoraciones recibidas por los usuarios sobre la utilidad y calidad de la información brindada en la plataforma.</span>
              </span>
            </h3>
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
            <th>Edad</th>
            <th>Nivel de Instrucción</th>
            <th>Ocupación</th>
            <th>Procedencia</th>
            <th>Número de Hijos</th>
            <th>Fecha de Registro</th>
          </tr>
          <?php $usuarios->data_seek(0);
          while ($row = $usuarios->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['id'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['nombre'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['edad'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['nivel_instruccion'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['ocupacion'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['procedencia'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['num_hijos'] ?? '') ?></td>
              <td><?= htmlspecialchars($row['fecha_registro'] ?? '') ?></td>
            </tr>
          <?php endwhile; ?>
        </table>
      </div>
      <!-- ...existing code... -->
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
              <th>Respuesta de la importancia de la lactancia materna exclusiva</th>
              <th>Nivel</th>
              <th>Ver Respuestas</th>
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
            $cuestionario = $conn->query("SELECT cuestionarios.*, usuarios.nombre FROM cuestionarios 
              INNER JOIN usuarios ON cuestionarios.id_usuario = usuarios.id");
            if ($cuestionario && $cuestionario->num_rows > 0):
              $preguntas = [
                1 => '¿Cuál es la principal causa de anemia en niños?',
                2 => '¿Qué alimento es más rico en hierro?',
                3 => '¿Cuál es un síntoma de anemia?',
                4 => '¿Qué vitamina ayuda a absorber el hierro?',
                5 => '¿Qué grupo de alimentos debe evitarse para mejorar la absorción de hierro?',
                6 => '¿Cuál es la mejor forma de prevenir la anemia?',
                7 => '¿Qué grupo de personas tiene mayor riesgo de anemia?',
                8 => '¿Cuál es el mejor momento para iniciar la lactancia materna?',
                9 => '¿Cuánto tiempo se recomienda la lactancia materna exclusiva?',
                10 => '¿Conoces la importancia de la lactancia materna exclusiva?'
              ];
              while ($row = $cuestionario->fetch_assoc()):
                $correctas = 0;
                for ($i = 1; $i <= 9; $i++) {
                  $resp = isset($row["respuesta$i"]) ? strtolower(trim($row["respuesta$i"])) : '';
                  if ($resp === $respuestas_correctas[$i]) {
                    $correctas++;
                  }
                }
                $nivel = $correctas <= 3 ? 'Bajo' : ($correctas <= 6 ? 'Medio' : 'Alto');
                $respuestas_usuario = [];
                for ($i = 1; $i <= 10; $i++) {
                  $respuestas_usuario[] = [
                    'pregunta' => $preguntas[$i] ?? ('Pregunta ' . $i),
                    'respuesta' => htmlspecialchars($row["respuesta$i"] ?? '')
                  ];
                }
                $json_respuestas = htmlspecialchars(json_encode($respuestas_usuario), ENT_QUOTES, 'UTF-8');
            ?>
                <tr>
                  <td><?= htmlspecialchars($row['nombre'] ?? '') ?></td>
                  <td><?= htmlspecialchars($row['respuesta10'] ?? '') ?></td>
                  <td><?= $nivel ?></td>
                  <td style="text-align:center;">
                    <button class="ver-respuestas-btn ojo-btn" data-respuestas='<?= $json_respuestas ?>' title="Ver respuestas">
                      <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" stroke="#6366f1" stroke-width="2" />
                        <circle cx="12" cy="12" r="3.5" stroke="#6366f1" stroke-width="2" />
                      </svg>
                    </button>
                  </td>
                </tr>
              <?php endwhile;
            else: ?>
              <tr>
                <td colspan="4">No hay datos disponibles.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <!-- Modal para ver respuestas -->
        <div id="modalRespuestas" class="modal-respuestas" style="display:none;">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Respuestas del usuario</h3>
              <button class="close-modal" aria-label="Cerrar">&times;</button>
            </div>
            <div id="modalPreguntasRespuestas"></div>
          </div>
        </div>
      </div>
      <div id="tab-cuestionario2" class="tab-content" style="display:none;">
        <h2>Resultados del Cuestionario 2</h2>
        <table class="admin-table">
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Respuesta de la importancia de la lactancia materna exclusiva</th>
              <th>Nivel</th>
              <th>Ver Respuestas</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $preguntas2 = [
              1 => '¿Cuál es la principal causa de anemia en niños?',
              2 => '¿Qué alimento es más rico en hierro?',
              3 => '¿Cuál es un síntoma de anemia?',
              4 => '¿Qué vitamina ayuda a absorber el hierro?',
              5 => '¿Qué grupo de alimentos debe evitarse para mejorar la absorción de hierro?',
              6 => '¿Cuál es la mejor forma de prevenir la anemia?',
              7 => '¿Qué grupo de personas tiene mayor riesgo de anemia?',
              8 => '¿Cuál es el mejor momento para iniciar la lactancia materna?',
              9 => '¿Cuánto tiempo se recomienda la lactancia materna exclusiva?',
              10 => '¿Conoces la importancia de la lactancia materna exclusiva?'
            ];
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
                $respuestas_usuario = [];
                for ($i = 1; $i <= 10; $i++) {
                  $respuestas_usuario[] = [
                    'pregunta' => $preguntas2[$i] ?? ('Pregunta ' . $i),
                    'respuesta' => htmlspecialchars($row["respuesta$i"] ?? '')
                  ];
                }
                $json_respuestas = htmlspecialchars(json_encode($respuestas_usuario), ENT_QUOTES, 'UTF-8');
            ?>
                <tr>
                  <td><?= htmlspecialchars($row['nombre'] ?? '') ?></td>
                  <td><?= isset($row['respuesta10']) ? htmlspecialchars($row['respuesta10']) : '' ?></td>
                  <td><?= $nivel ?></td>
                  <td style="text-align:center;">
                    <button class="ver-respuestas2-btn ojo-btn" data-respuestas='<?= $json_respuestas ?>' title="Ver respuestas">
                      <svg width="22" height="22" fill="none" viewBox="0 0 24 24">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z" stroke="#6366f1" stroke-width="2" />
                        <circle cx="12" cy="12" r="3.5" stroke="#6366f1" stroke-width="2" />
                      </svg>
                    </button>
                  </td>
                </tr>
              <?php endwhile;
            else: ?>
              <tr>
                <td colspan="4">No hay datos disponibles.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <!-- Modal para ver respuestas Cuestionario 2 -->
        <!-- Modal para ver respuestas Cuestionario 2 moved outside .main-content -->
      </div>
</body>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/admin_panel.js"></script>
<script>
  // --- DATOS DESDE PHP ---
  <?php
  $meses_es = [
    'January' => 'Enero',
    'February' => 'Febrero',
    'March' => 'Marzo',
    'April' => 'Abril',
    'May' => 'Mayo',
    'June' => 'Junio',
    'July' => 'Julio',
    'August' => 'Agosto',
    'September' => 'Septiembre',
    'October' => 'Octubre',
    'November' => 'Noviembre',
    'December' => 'Diciembre'
  ];
  $usuariosPorMes = [];
  $res = $conn->query("SELECT MONTHNAME(fecha_registro) as mes, COUNT(*) as total FROM usuarios GROUP BY mes ORDER BY MONTH(fecha_registro)");
  while ($row = $res->fetch_assoc()) {
    $mes = $row['mes'];
    $usuariosPorMes[$meses_es[$mes] ?? $mes] = (int)$row['total'];
  }
  ?>
  const usuariosLabels = <?php echo json_encode(array_keys($usuariosPorMes)); ?>;
  const usuariosData = <?php echo json_encode(array_values($usuariosPorMes)); ?>;

  // 2. Comparativa Pre-Test (respuesta 10: sí/no)
  <?php
  $comparativaPre = ['Sí' => 0, 'No' => 0];
  $res = $conn->query("SELECT LOWER(TRIM(respuesta10)) as r10 FROM cuestionarios WHERE respuesta10 IS NOT NULL");
  while ($row = $res->fetch_assoc()) {
    if ($row['r10'] === 'si' || $row['r10'] === 'sí') {
      $comparativaPre['Sí']++;
    } else {
      $comparativaPre['No']++;
    }
  }
  ?>
  const comparativaPreLabels = <?php echo json_encode(array_keys($comparativaPre)); ?>;
  const comparativaPreData = <?php echo json_encode(array_values($comparativaPre)); ?>;

  // 3. Comparativa Post-Test (respuesta 10: sí/no)
  <?php
  $comparativaPost = ['Sí' => 0, 'No' => 0];
  $res = $conn->query("SELECT LOWER(TRIM(respuesta10)) as r10 FROM cuestionarios2 WHERE respuesta10 IS NOT NULL");
  while ($row = $res->fetch_assoc()) {
    if ($row['r10'] === 'si' || $row['r10'] === 'sí') {
      $comparativaPost['Sí']++;
    } else {
      $comparativaPost['No']++;
    }
  }
  ?>
  const comparativaPostLabels = <?php echo json_encode(array_keys($comparativaPost)); ?>;
  const comparativaPostData = <?php echo json_encode(array_values($comparativaPost)); ?>;

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
</script>
</body>

</html>
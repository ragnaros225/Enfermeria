<?php
// Inicia sesión (si no está iniciada)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtiene el ID de usuario de: URL > Sesión > LocalStorage (vía JS)
$id_usuario = $_GET['id_usuario'] ?? $_SESSION['id_usuario'] ?? null;

// Si no hay ID, intenta recuperarlo vía JavaScript (solo si es necesario)
if (!$id_usuario) {
    echo '<script>
        const urlParams = new URLSearchParams(window.location.search);
        const idFromURL = urlParams.get("id_usuario");
        const idFromLocalStorage = localStorage.getItem("id_usuario");
        
        if (idFromURL || idFromLocalStorage) {
            // Si se encuentra, recarga la página con el ID
            window.location.href = window.location.pathname + "?id_usuario=" + (idFromURL || idFromLocalStorage);
        }
    </script>';
} else {
    // Guarda en sesión para futuras páginas
    $_SESSION['id_usuario'] = $id_usuario;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consecuencias de la Anemia</title>
  <link rel="stylesheet" href="estilos/global.css">
  <link rel="stylesheet" href="estilos/consecuencias.css">
</head>

<body>
  <?php include 'componentes/navbar.php'; ?>

  <main>
    <div class="container">
      <header style="text-align:center; margin-bottom:2rem;">
        <h1 style="margin-bottom:0.5em;">Recetas para prevenir la anemia</h1>
        <p>Aquí encontrarás recursos y fuentes confiables para mejorar tu alimentación y prevenir la anemia en su hijo.</p>
      </header>
      <section class="card" aria-labelledby="pdf-title">
        <h2 id="pdf-title">Guía visual interactiva</h2>
        <div class="visor-pdf">
          <canvas id="pdfCanvas"></canvas>
          <div class="controles">
            <button id="prevPage">Anterior</button>
            <span id="pageCount">Página 1 de 0</span>
            <button id="nextPage">Siguiente</button>
          </div>
        </div>
      </section>
      <section class="card" aria-labelledby="fuentes-title">
        <h2 id="fuentes-title">Fuentes referentes</h2>
        <ul>
          <li><a href="https://revistasinvestigacion.unmsm.edu.pe/index.php/veterinaria/article/view/13076?utm_source=chatgpt.com" target="_blank">Artículo en UNMSM</a></li>
          <li><a href="https://www.tuasaude.com/es/frutas-ricas-en-hierro/" target="_blank">Frutas ricas en hierro</a></li>
          <li><a href="https://www.herbazest.com/es/hierbas/fresa" target="_blank">Fresa - Herbazest</a></li>
          <li><a href="https://www.clinicabiblica.com/es/pacientes/guia-de-soluciones-desalud/2441-propiedades-de-la-papaya" target="_blank">Propiedades de la papaya</a></li>
          <li><a href="https://www.herbazest.com/es/hierbas/coco" target="_blank">Coco - Herbazest</a></li>
          <li><a href="https://www.herbazest.com/es/hierbas/platano" target="_blank">Plátano - Herbazest</a></li>
          <li><a href="https://www.herbazest.com/es/hierbas/higo" target="_blank">Higo - Herbazest</a></li>
          <li><a href="https://www.herbazest.com/es/hierbas/durazno" target="_blank">Durazno - Herbazest</a></li>
          <li><a href="https://www.herbazest.com/es/hierbas/pina" target="_blank">Piña - Herbazest</a></li>
          <li><a href="https://share.google/QrHKdaSxRAHOA9YH5" target="_blank">Google Share</a></li>
          <li><a href="https://repositorio.ins.gob.pe/server/api/core/bitstreams/e0e90fb5-52ee-4f90-8b29-4a29efed8e6b/content?utm_source=chatgpt.com" target="_blank">Repositorio INS</a></li>
        </ul>
      </section>
    </div>
  </main>

  <!-- Librería PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
  <script src="js/libro.js"></script>
  <script src="js/posttest-button.js"></script>
</body>

</html>
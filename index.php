<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Anemia</title>
  <link rel="stylesheet" href="estilos/styles2.css">
  <link rel="stylesheet" href="estilos/Index.css">
  <link rel="stylesheet" href="estilos/intro.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="clouds-bg-back" id="clouds-bg-back"></div>
  <div id="intro-screen" class="intro-screen">
    <video id="intro-video" src="videos/intro bebe.mp4" autoplay muted playsinline class="intro-video" onended="showMainContent()"></video>
    <div id="bienvenido-msg" class="bienvenido-msg">¡BIENVENIDO!</div>
  </div>
  <div id="main-content-wrapper" style="display:none;">
    <div class="bebe-apoyado-wrapper">
      <img src="img/bebe_apoyado.png" alt="Bebé apoyado" class="bebe-apoyado-img" />
    </div>
    <div class="container">
      <img src="img/logo_principl.jpg" alt="logo" />
      <h1>Formulario de la anemia</h1>
      <a href="registro.php">
        <button>Iniciar Evaluación</button>
      </a>
    </div>
    <div style="text-align: right; padding: 10px;">
      <a href="admin_login.php" style="text-decoration: none;">
        <button style="
          padding: 8px 16px;
          background-color: #343a40;
          color: white;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        ">Administrador</button>
      </a>
    </div>
  </div>
  <div class="clouds-bg-front" id="clouds-bg-front"></div>
  <script src="js/intro.js"></script>
  <script src="js/showMainContent.js"></script>
  <script src="js/clouds.js"></script>

</body>

</html>
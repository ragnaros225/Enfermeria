<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrador</title>
  <link rel="stylesheet" href="estilos/styles2.css">
  <link rel="stylesheet" href="estilos/Index.css">
  <link rel="stylesheet" href="estilos/registro.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="clouds-bg-back" id="clouds-bg-back"></div>
  <div class="registro-wrapper">
    <form class="registro-card" action="admin_verificar.php" method="POST">
      <h1>Administrador</h1>
      <div class="registro-fields">
        <input type="text" name="usuario" placeholder="Usuario" required />
        <input type="password" name="contrasena" placeholder="Contraseña" required />
      </div>
      <button type="submit">Ingresar</button>
    </form>
  </div>
  <div class="clouds-bg-front" id="clouds-bg-front"></div>
  <script src="Js/clouds.js"></script>
</body>

</html>
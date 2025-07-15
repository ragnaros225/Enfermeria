<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <style>
    body { font-family: Arial; padding: 50px; background: #f2f2f2; }
    form { background: white; padding: 20px; border-radius: 10px; max-width: 400px; margin: auto; }
    input, button { width: 100%; padding: 10px; margin-top: 10px; }
  </style>
</head>
<body>
  <h2>Acceso Administrador</h2>
  <form action="admin_verificar.php" method="post">
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit">Ingresar</button>
  </form>
</body>
</html>

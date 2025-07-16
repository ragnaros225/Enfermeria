<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos/styles2.css">
    <link rel="stylesheet" href="estilos/Index.css">
    <link rel="stylesheet" href="estilos/registro.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="clouds-bg-back" id="clouds-bg-back"></div>
    <div class="registro-wrapper">
        <form class="registro-card" action="guardar_usuario.php" method="POST">
            <h1>Registro</h1>
            <div class="registro-fields">
                <input type="text" name="nombre" placeholder="Nombre completo" required />
                <input type="email" name="correo" placeholder="Correo electrónico" required />
            </div>
            <button type="submit">Comenzar Evaluación</button>
        </form>
    </div>
    <div class="clouds-bg-front" id="clouds-bg-front"></div>
    <script src="Js/clouds.js"></script>
</body>

</html>
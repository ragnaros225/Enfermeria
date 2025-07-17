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
                <!-- Campo nombre (se mantiene) -->
                <input type="text" name="nombre" placeholder="Nombre completo" required />
                
                <!-- Nuevos campos -->
                <input type="number" name="edad" placeholder="Edad" min="1" max="120" required />
                
                <select name="nivel_instruccion" required>
                    <option value="" disabled selected>Nivel de instrucción</option>
                    <option value="Sin instrucción">Sin instrucción</option>
                    <option value="Primaria">Primaria</option>
                    <option value="Secundaria">Secundaria</option>
                    <option value="Superior">Superior</option>
                </select>
                
                <select name="ocupacion" required>
                    <option value="" disabled selected>Ocupación</option>
                    <option value="Ama de casa">Ama de casa</option>
                    <option value="Estudiante">Estudiante</option>
                    <option value="Trabajo independiente">Trabajo independiente</option>
                    <option value="Trabajo dependiente">Trabajo dependiente</option>
                </select>
                
                <select name="procedencia" required>
                    <option value="" disabled selected>Procedencia</option>
                    <option value="Urbana">Urbana</option>
                    <option value="Periurbana">Periurbana</option> <!-- ¡Asegúrate que coincida exactamente! -->
                    <option value="Rural">Rural</option>
                </select>
                
                <input type="number" name="num_hijos" placeholder="Número de hijos" min="0" required />
            </div>
            <button type="submit">Comenzar Evaluación</button>
        </form>
    </div>
    <div class="clouds-bg-front" id="clouds-bg-front"></div>
    <script src="Js/clouds.js"></script>
</body>
</html>
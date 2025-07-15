<?php
// Intentar recuperar id_usuario desde la URL
$id_usuario = $_GET['id_usuario'] ?? null;

// Si no viene por URL, lo recuperaremos por JavaScript desde localStorage
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Post-Test Anemia Infantil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f7f7f7;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
            max-width: 600px;
            margin: auto;
        }

        label {
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <form action="guardar_posttest.php" method="post">
        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario; ?>">

        <h3>POST-TEST</h3>

        <label>7. Marque al menos dos signos o síntomas de anemia infantil:</label><br>
        <select name="sintomas_anemia" required>
            <option>Palidez y Cansancio</option>
            <option>Alegría excesiva y Retraso en el crecimiento</option>
            <option>Pérdida de apetito y Agilidad extrema</option>
        </select><br><br>

        <label>8. Marque los alimentos que son fuente importante de hierro:</label><br>
        <select name="alimentos_ricos_hierro" required>
            <option>Hígado de res, Quinua, Sangre de pollo y cushuro</option>
            <option>Frijol negro, Fideos, espinacas</option>
            <option>Cushuro, arroz, papa y Camote</option>
        </select><br><br>

        <label>9. ¿Qué alimentos o bebidas deben evitarse junto con comidas principales para no dificultar la absorción del hierro?</label><br>
        <select name="alimentos_evitar" required>
            <option>Leche, Frutas cítricas y gaseosa</option>
            <option>Café o té, leche y chocolate caliente</option>
            <option>Jugo de naranja, té y leche</option>
        </select><br><br>

        <label>10. ¿Por qué es importante acompañar los alimentos ricos en hierro con vitamina C?</label><br>
        <select name="importancia_vitamina_c" required>
            <option>Porque mejora la absorción del hierro</option>
            <option>Porque ayuda al crecimiento del niño</option>
            <option>Porque mejora el sabor de la comida</option>
        </select><br><br>

        <label>11. Después de revisar la página web, ¿conoce usted la importancia de la lactancia materna exclusiva?</label><br>
        <select name="conocimiento_lactancia" required>
            <option>Sí, completamente</option>
            <option>Sí, en parte</option>
            <option>No</option>
            <option>Me gustaría más información</option>
        </select><br><br>

        <button type="submit">Enviar Post-Test</button>
    </form>

    <script>
    // Si el campo hidden está vacío, intentamos completarlo desde localStorage
    const idInput = document.getElementById('id_usuario');
    if (!idInput.value) {
        const idGuardado = localStorage.getItem("id_usuario");
        if (idGuardado) {
            idInput.value = idGuardado;
        } else {
            alert("No se encontró el ID del usuario. El formulario no podrá enviarse correctamente.");
        }
    }
    </script>

</body>
</html>

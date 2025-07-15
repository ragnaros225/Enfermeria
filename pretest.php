<?php
$id_usuario = $_GET['id_usuario'] ?? null;
if (!$id_usuario) {
    echo "ID de usuario no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pre-Test Anemia Infantil</title>
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
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <form action="guardar_pretest.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

        <h3>PRE-TEST</h3>

        <label>1. ¿Cuáles de los siguientes signos cree usted que son característicos de la anemia infantil?</label><br>
        <select name="signo_anemia" required>
            <option value="Cansancio frecuente y Retraso en el crecimiento">Cansancio frecuente y Retraso en el crecimiento</option>
            <option value="Bastante hambre y fiebre alta">Bastante hambre y fiebre alta</option>
        </select><br><br>

        <label>2. ¿Conoce usted las consecuencias de una mala alimentación o de una anemia no tratada en niños?</label><br>
        <select name="consecuencias" required>
            <option>Sí, algunas</option>
            <option>Sí, muchas</option>
            <option>No</option>
            <option>No estoy seguro(a)</option>
            <option>Me gustaría aprender más</option>
        </select><br><br>

        <label>3. ¿Cuál de los siguientes alimentos considera que son ricos en hierro?</label><br>
        <select name="alimentos_hierro" required>
            <option>Hígado de res, Lenteja y Sangrecita</option>
            <option>Papa, Fideos y Espinacas</option>
            <option>Yogur, leche y sangrecita</option>
        </select><br><br>

        <label>4. ¿Sabe cómo mejorar la absorción del hierro en la alimentación diaria?</label><br>
        <select name="absorcion_hierro" required>
            <option>Sí</option>
            <option>No</option>
            <option>Más o menos</option>
            <option>Necesito más información al respecto</option>
        </select><br><br>

        <label>5. ¿Conoce la importancia de la lactancia materna exclusiva durante los primeros 6 meses?</label><br>
        <select name="lactancia" required>
            <option>Sí</option>
            <option>No</option>
            <option>He escuchado algo, pero no estoy segura/o</option>
            <option>Me gustaría saber más sobre ese tema</option>
        </select><br><br>

        <label>6. ¿Considera que la vacunación materna protege también al recién nacido?</label><br>
        <select name="vacunacion_materna" required>
            <option>Sí</option>
            <option>No</option>
            <option>No lo sabía</option>
            <option>Necesito más información</option>
        </select><br><br>

        <button type="submit">Enviar Pre-Test</button>
    </form>

</body>
<script>
const id_usuario = <?php echo json_encode($_GET['id_usuario']); ?>;
localStorage.setItem("id_usuario", id_usuario);
</script>
</html>

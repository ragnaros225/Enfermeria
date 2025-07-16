<?php
$current = basename($_SERVER['PHP_SELF']);
function navActive($file)
{
    global $current;
    return $current === $file ? 'active' : '';
}
?>
<nav class="main-navbar">
    <a href="sintomas.php" class="<?= navActive('sintomas.php') ?>">Síntomas</a>
    <a href="materna.php" class="<?= navActive('materna.php') ?>">Materna</a>
    <a href="recetas.php" class="<?= navActive('recetas.php') ?>">Recetas</a>
    <a href="consecuencias.php" class="<?= navActive('consecuencias.php') ?>">Consecuencias</a>
</nav>

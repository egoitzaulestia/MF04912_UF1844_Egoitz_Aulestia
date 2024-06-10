<?php 
include 'inc/config.php';
include 'inc/functions_B.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head.php'; ?>
    <title><?php echo $sitioTitle . ' - ' . $paginaTitle ?></title>
</head>
<body>
    <div class="container-lg">
    <?php include 'inc/cabecera.php'; ?>
    <div class="row">
    <?php include 'inc/aside.php'; ?>

    <div class="col-sm-8 col-10 card-2" id="Contenido">
        <h1>Has cerrado la sesión</h1>
        <p>Si quieres volver a rellenar el formulario, haz clic en el botón "Reiniciar formulario":</p>
        <!-- <a class="back-index" href="index.php">Volver al index</a> -->
        <div class="col-12" style="text-align: center;"><button class="btn btn-primary" onclick="window.location.href='index.php'">Reiniciar formulario</button></div>
    </div>
    <?php include 'inc/aside.php'; ?>
    </div>
</body>
</html>

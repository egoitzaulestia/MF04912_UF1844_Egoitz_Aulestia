<?php
include 'inc/config.php';
include 'inc/functions_B.php';
?>

<!-- Comienzo del HTML(5)  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'inc/head.php'; ?>
    <title><?php echo $sitioTitle . ' - ' . $paginaTitle ?></title>
</head>

<body>
    <div class="container-lg">
        <?php include 'inc/cabecera_2.php'; ?>
        <div class="row">
            <?php include 'inc/aside.php'; ?>

            <div class="col-sm-8 col-10 card" id="Contenido">
                <br>
                <h1>Has cerrado la sesión</h1>
                <p>Si quieres volver a rellenar el formulario, haz clic en el botón "Reiniciar formulario":</p>
                <br>
                <div class="col-12" style="text-align: center;">
                    <button class="btn btn-primary btn-largo" onclick="window.location.href='index.php'">Reiniciar formulario</button>
                </div>
                <br>
                <br>
            </div>
            <?php include 'inc/aside.php'; ?>
        </div>
        <?php include 'inc/footer.php'; ?>
    </div>
    <?php include 'inc/scripts_finales.php'; ?>
</body>

</html>
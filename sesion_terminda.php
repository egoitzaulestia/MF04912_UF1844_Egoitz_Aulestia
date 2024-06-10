<!-- 
    ///////////////////////////
    PÁGINA SESION_TERMINADA.PHP 
    ///////////////////////////

    Es importante mencionar que la página de sesión terminada se visualiza de la redirección de desde el botón de cerrar sesión que tiene las páginas principales.
    Caundo en alguna de las páginas del proceso del formulario se pulsa el boton cerrar sesíon se redirege a la página logout.php. En esta página se destruye la "cookie o el token" de la sesión.
    Y finalmente la página logout.php te redirige a esta página sesion_terminada.php
-->

<?php
// Includes de los archivos de configuració y funciones
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

            <!-- Indicamos al que cerrado la sesión y ofrecemos la oportunidad de reiniciar el proceso de un nuevo formulario -->
            <div class="col-sm-8 col-10 card" id="Contenido">
                <br>
                <h1>Has cerrado la sesión</h1>
                <p>Si quieres volver a rellenar el formulario, haz clic en el botón "Reiniciar formulario":</p>
                <br>
                <div class="col-12" style="text-align: center;">
                    <!-- Boton con el que dirigimos al usuario a la página index.php -->
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
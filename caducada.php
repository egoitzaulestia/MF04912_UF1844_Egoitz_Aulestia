<!-- 
    ///////////////////
    PÁGINA CADUDACA.PHP 
    ///////////////////

    Sirve para comunicar al usuario que esta accediendo 
    a un contenido donde la sesión ya ha cadudado
-->

<!-- Includes de los archivos de configuració y funciones  -->

<?php include 'inc/config.php'; ?>
<?php include 'inc/functions.php'; ?>

<!-- Comienzo del HTML(5)  -->

<!DOCTYPE html>
<html lang="es">

<!-- Comienzo del head  -->

<head>
    <!-- Include head.php /// Contiene la mayoría de la metada -->
    <?php include 'inc/head.php'; ?>
    <title><?php echo $sitioTitle . ' - ' . $paginaTitle ?></title>
</head>

<!-- Final del head  -->

<!-- Comienzo del Body  -->

<body>

    <!-- Comienzo del div contenedor principal  -->

    <div class="container-lg">

        <!-- include cabecera_2.php  -->
        <?php include 'inc/cabecera_2.php'; ?>

        <!-- Comienzo del div row  -->

        <div class="row">

            <!-- include aside.php  -->
            <?php include 'inc/aside.php'; ?>

            <!-- Información de la página caducada  -->
            <div class="col-sm-8 col-10 card" id="Contenido">
                <br>
                <h1>Caducada</h1>
                <h4>Ups, lo siento, la página está caducada!!!</h4>
                <p>Si quieres acceder al formulario, haz clic en el botón "Iniciar formulario":</p>
                <br>
                <!-- Contendoer del boton iniciar formulario -->
                <div class="col-12" style="text-align: center;">
                    <!-- Botón que redirige la página al index.php para dar la opción al usuario de iniciar el formulario -->
                    <button class="btn btn-primary btn-largo" onclick="window.location.href='index.php'">Iniciar formulario</button>
                </div>
                <br>
                <br>
            </div>

            <!-- include aside.php  -->
            <?php include 'inc/aside.php'; ?>
        </div>

        <!-- Final del div row  -->

        <?php include 'inc/footer.php'; ?>
    </div>

    <!-- Final del div containedor principal  -->

    <?php include 'inc/scripts_finales.php'; ?>
</body>

<!-- Final del Body  -->

</html>

<!-- Final del HTML  -->
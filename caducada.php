<?php include 'inc/config.php'; ?>
<?php include 'inc/functions.php'; ?>
<!DOCTYPE html>
<html lang="es">
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
                <h1>Caducada</h1>
                <h4>Ups, lo siento, la página está caducada!!!</h4>
                <p>Si quieres acceder al formulario, haz clic en el botón "Iniciar formulario":</p>
                <br>
                <div class="col-12" style="text-align: center;">
                    <button class="btn btn-primary btn-largo" onclick="window.location.href='index.php'">Iniciar formulario</button>
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
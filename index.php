<!-- 
    ////////////////
    PÁGINA INDEX.PHP 
    ////////////////

    Página de inicio del formulario.
-->

<!-- Includes de los archivos de configuració y funciones  -->
<?php include 'inc/config.php'; ?>
<?php include 'inc/functions.php'; ?>

<!-- Iniciamos la sesión. Creamos la variable de sesión clienteip mediante $_SESSION['clienteip'] = $_SERVER['REMOTE_ADDR'] -->

<?php
session_start();
$_SESSION['clienteip'] = $_SERVER['REMOTE_ADDR'];
?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Comienzo del HTML(5)  -->

<!doctype html>
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

        <!-- include cabecera.php // metadata y links CSS -->
        <?php include 'inc/cabecera.php'; ?>
        <!-- include navegacion.php // menú de navegación -->
        <?php include 'inc/navegacion.php'; ?>

        <div class="row">
            <?php include 'inc/aside.php'; ?>
            <div class="col-sm-8 col-10 card" id="Contenido">

                <!-- Comienzo del Formulario 1 // Método POST // action = page_2.php -->

                <form action="page_2.php" method="POST">

                    <br>
                    <h1>Formulario 1</h1><br>

                    <!-- Recogemos nombre del usuario -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label"><strong>Nombre: *</strong></label>
                        <input type="text" class="form-control <?php echo !empty($_SESSION['nombreError']) ? 'input-error' : ''; ?>" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>" required>
                        <!-- Mostramos mensaje de error de validación -->
                        <div class="error-validacion"><?php echo isset($_SESSION['nombreError']) ? $_SESSION['nombreError'] : ''; ?></div>
                    </div>

                    <!-- Recogemos el email del usuario -->
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email: *</strong></label>
                        <input type="email" class="form-control <?php echo !empty($_SESSION['mailError']) ? 'input-error' : ''; ?>" name="email" id="email" placeholder="e-mail" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
                        <!-- Mostramos mensaje de error de validación -->
                        <div class="error-validacion"><?php echo isset($_SESSION['mailError']) ? $_SESSION['mailError'] : ''; ?></div>
                    </div>

                    <!-- Recogemos password del usuario -->
                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>Password: *</strong></label>
                        <input type="password" class="form-control <?php echo !empty($_SESSION['passwordError']) ? 'input-error' : ''; ?>" name="password" id="password" placeholder="Password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" required>
                        <!-- Mostramos mensaje de error de validación -->
                        <div class="error-validacion"><?php echo isset($_SESSION['passwordError']) ? $_SESSION['passwordError'] : ''; ?></div>
                    </div>

                    <br>

                    <!-- Avanzamos en el formulario mediante el botón siguiente -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" value="enviar" id="siguiente" class="btn btn-primary">Siguiente <strong>></strong></button>
                    </div>
                </form>

                <!-- Final del Formulario 1 -->

                <br>
            </div>
            <?php include 'inc/aside.php'; ?>
        </div>
        <?php include 'inc/footer.php'; ?>
    </div>
    <?php include 'inc/scripts_finales.php'; ?>
</body>

</html>
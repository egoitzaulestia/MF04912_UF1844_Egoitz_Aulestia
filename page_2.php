<!-- 
    /////////////////
    PÁGINA PAGE_2.PHP 
    /////////////////

    2ª página del formulario.
-->

<!-- Includes de los archivos de configuració y funciones  -->
<?php include 'inc/config.php'; ?>
<?php include 'inc/functions.php'; ?>


<?php
session_start();
// Comprobamos si el/la usuari@ ha inciado sesión. 
// Para ello comprobamos si la variable de sesión $_SESSION['clienteip'] existe.
if (!isset($_SESSION['clienteip'])) {
        // Si no existe redirigimos al usuario a la página caducada
    header("location:caducada.php");
    exit;
}

// Inicializamos vacías las variables de error del primer paso del formulario
$nombreError = $mailError = $passwordError = '';

// Limpiar errores anteriores.
// Esto permite que erros corregidos, no muestren los mensajes de error de la página anterior
unset($_SESSION['nombreError'], $_SESSION['mailError'], $_SESSION['passwordError']);

/* 
    Cominezo de VALIDACIÓN PHP ////////////////////////
*/

// Ejecutamos lo siguiente si el método utilizado para el envia ha sido un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = recogerVar($_POST['nombre']); // Limpiamos la variable
    $email = recogerVar($_POST['email']); // Limpiamos la variable
    $password = recogerVar($_POST['password']); // Limpiamos la variable

    // Validación del nombre
    if (empty($nombre)) { // Comprobamos si el nombre esta vacío 
        $nombreError = "Nombre es obligatorio";
    } elseif (strlen($nombre) < 2) { // Comprobamos si el nombre es menor de 2 caracteres
        $nombreError = "El nombre no puede contener solo un carácter";
    }

    // Valicación del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mailError = "Email incorrecto";
    }

    // Regex para la validación del password
    $regexPassword = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';

    // Validación del password
    if (!preg_match($regexPassword, $password)) {
        $passwordError = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra minúscula, una letra mayúscula y un número.";
    }

    // Comprobamos que no tenemos ningú error en la validación de los inputs de la página anterior, 
    // si es así, incializamos variables de sesión con los inputs recibidos y nos manteine en la página (page_2.php) mediante el header
    if (empty($nombreError) && empty($mailError) && empty($passwordError)) {
        $_SESSION['nombre'] = $nombre;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("location:page_2.php");
        exit;
    } else {
        // De lo contrario significa que tenemos algún error.
        // Inicializamos varaiables de sesión y les asignamos los valores de los inputs y de los mensajes de error
        // y nos vuelve a mandar a la página anterior (index.php) mediante el header(), para solucionar los errores
        $_SESSION['nombre'] = $nombre;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        $_SESSION['nombreError'] = $nombreError;
        $_SESSION['mailError'] = $mailError;
        $_SESSION['passwordError'] = $passwordError;

        header("location:index.php");
        exit;
    }
}

// Final de VALIDACIÓN PHP ////////////////////////
?>

<!-- Comienzo del HTML(5)  -->

<!doctype html>
<html lang="es">

<head>
    <?php include 'inc/head.php'; ?>
    <title><?php echo $sitioTitle . ' - ' . $paginaTitle ?></title>
</head>

<body>
    <div class="container-lg">
        <?php include 'inc/cabecera.php'; ?>
        <?php include 'inc/navegacion.php'; ?>
        <div class="row">
            <?php include 'inc/aside.php'; ?>
            <div class="col-sm-8 col-10 card" id="Contenido">
                
                <!-- Comienzo del Formulario 2 // Método POST // action = page_3.php -->

                <form action="page_3.php" method="POST">

                    <br>
                    <h1>Formulario 2</h1><br>

                    <!-- Recogemos teléfono del usuario -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label"><strong>Teléfono: *</strong></label>
                        <input type="tel" class="form-control <?php echo !empty($_SESSION['telefonoError']) ? 'input-error' : ''; ?>" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?>" required>
                        <div class="error-validacion"><?php echo isset($_SESSION['telefonoError']) ? $_SESSION['telefonoError'] : ''; ?></div>
                    </div>

                    <!-- Recogemos ciudad del usuario -->
                    <div class="mb-3">
                        <label for="ciudad" class="form-label"><strong>Ciudad: *</strong></label>
                        <input type="text" class="form-control <?php echo !empty($_SESSION['ciudadError']) ? 'input-error' : ''; ?>" name="ciudad" id="ciudad" placeholder="Ciudad" value="<?php echo isset($_SESSION['ciudad']) ? $_SESSION['ciudad'] : ''; ?>" required>
                        <!-- Mostramos mensaje de error de validación -->
                        <div class="error-validacion"><?php echo isset($_SESSION['ciudadError']) ? $_SESSION['ciudadError'] : ''; ?></div>
                        <!-- Mostramos sugerencias de las ciudades según el usuario escribe -->
                        <div class="suggestions sugerencia"></div>
                    </div>

                    <!-- Recogemos fecha de namiento del usuario mediante selects-->
                    <div class="mb-3">

                        <!-- Recogemos día -->
                        <label for="fecha_nacimiento" class="form-label"><strong>Fecha de Nacimiento: *</strong></label>
                        <div class="fecha-nacimiento">
                            <select name="dia" id="dia" class="form-control <?php echo !empty($_SESSION['fechaNacimientoError']) ? 'input-error' : ''; ?>">
                                <?php for ($i = 1; $i <= 31; $i++) : ?>
                                    <option value="<?php echo $i; ?>" <?php echo (isset($_SESSION['dia']) && $_SESSION['dia'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>

                             <!-- Recogemos día -->
                            <select name="mes" id="mes" class="form-control <?php echo !empty($_SESSION['fechaNacimientoError']) ? 'input-error' : ''; ?>">
                                <?php
                                // Definimos un array asociativo de los meses del año en español.
                                $meses = array(
                                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                );
                                foreach ($meses as $num => $nombre) : ?>
                                    <option value="<?php echo $num; ?>" <?php echo (isset($_SESSION['mes']) && $_SESSION['mes'] == $num) ? 'selected' : ''; ?>><?php echo $nombre; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <select name="anio" id="anio" class="form-control <?php echo !empty($_SESSION['fechaNacimientoError']) ? 'input-error' : ''; ?>">
                                <?php
                                $currentYear = date('Y');
                                for ($i = $currentYear; $i >= 1900; $i--) : ?>
                                    <option value="<?php echo $i; ?>" <?php echo (isset($_SESSION['anio']) && $_SESSION['anio'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>

                        </div>
                        <!-- Mostramos mensaje de error de validación -->
                        <div class="error-validacion"><?php echo isset($_SESSION['fechaNacimientoError']) ? $_SESSION['fechaNacimientoError'] : ''; ?></div>
                    
                    </div>
                    <br>

                    <div class="d-flex justify-content-between">
                        <!-- Botón para retroceder a la página anterior (index.php) -->
                        <button type="button" onclick="window.location.href='index.php'" class="btn btn-primary"><strong> < </strong> Anterior</button>
                        <!-- Botón para avanzar a la siguiente página mediante el submit, que al enviar el formulario se dirige a la dirección establecidad en el action del form -->
                        <button type="submit" value="enviar" id="siguiente" class="btn btn-primary">Siguiente <strong> > </strong></button>
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
    <script src="js/script.js"></script>
</body>

</html>
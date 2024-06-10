<!-- 
    /////////////////
    PÁGINA PAGE_3.PHP 
    /////////////////

    Página para que el usuario pueda editr o confirmar la información introducida en los formularios 1 y 2.
-->

<?php

// Includes de los archivos de configuració y funciones
include 'inc/config.php';
include 'inc/functions_B.php';

session_start();
// Comprobamos si el/la usuari@ ha inciado sesión. 
// Para ello comprobamos si la variable de sesión $_SESSION['clienteip'] existe.
if (!isset($_SESSION['clienteip'])) {
    // Si no existe redirigimos al usuario a la página caducada
    header("location:caducada.php");
    exit;
}


// Inicializamos vacías las variables de error del segundo paso del formulario
$telefonoError = $ciudadError = $fechaNacimientoError = '';

// Limpiar errores anteriores.
// Esto permite que erros corregidos, no muestren los mensajes de error de la página anterior
unset($_SESSION['telefonoError'], $_SESSION['ciudadError'], $_SESSION['fechaNacimientoError']);



/* 
    Cominezo de VALIDACIÓN PHP ////////////////////////
*/

// Ejecutamos lo siguiente si el método utilizado para el envia ha sido un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $telefono = recogerVar($_POST['telefono']);
    $ciudad = recogerVar($_POST['ciudad']);
    $dia = recogerVar($_POST['dia']);
    $mes = recogerVar($_POST['mes']);
    $anio = recogerVar($_POST['anio']);
    $fecha_nacimiento = "$anio-$mes-$dia";

    // Inicializamos array con los prefijos de teléfonos en España
    $prefijosTel = array('6', '7', '8', '9');
    
    // Eliminamos TODO lo que no sea un dígito
    $telefono = preg_replace('/\D/', '', $telefono); 
    
    // Validación del teléfono móvil o fijo español
    if (empty($telefono)) { // combrobamos si el campo del teléfono esta vacío
        $telefonoError = "Es obligatorio que introduzca su número de teléfono";
    } elseif (!(strlen($telefono) == 9)) { // Comprobamos si el número introducido se compone por 9 dígitos
        $telefonoError = "El número de teléfono debe contener 9 dígitos";
    } else { // Comprobamos que sea un "prefijo" (en este caso el primer número) español
        $prefijoValido = false;
        foreach ($prefijosTel as $prefijo) {
            if ($telefono[0] == $prefijo) { // Si el primer número del telefono coincide con alguno de los números del array de prefijos el telefono es valido
                $prefijoValido = true; 
                break;
            }
        }
        if (!$prefijoValido) { // Si no coinciden los prefijos, error
            $telefonoError = "El número de teléfono debe comenzar por 6, 7, 8 o 9";
        }
    }

    // Función para normalizar las entradas del input de la ciudad. 
    // Nos sirve pos si el usuario no introduce acentos en una ciudad que lleva acento.
    function normalizeString($str) {
        $str = strtolower($str);
        $str = preg_replace('/[áàäâ]/u', 'a', $str);
        $str = preg_replace('/[éèëê]/u', 'e', $str);
        $str = preg_replace('/[íìïî]/u', 'i', $str);
        $str = preg_replace('/[óòöô]/u', 'o', $str);
        $str = preg_replace('/[úùüû]/u', 'u', $str);
        $str = preg_replace('/[ç]/u', 'c', $str);
        return $str;
    }

    // Validación de ciudad
    $ciudadValida = false;
    $municipios = json_decode(file_get_contents('data/municipios.json'), true);
    $ciudadNormalized = normalizeString($ciudad);
    foreach ($municipios as $municipio) {
        if (normalizeString($municipio['nm']) == $ciudadNormalized) {
            $ciudadValida = true;
            $ciudad = $municipio['nm']; // Guardar el nombre correcto con acentos
            break;
        }
    }
    if (!$ciudadValida) {
        $ciudadError = "La ciudad introducida no es válida.";
    }

    // Validación de la fecha de nacimiento
    if (empty($dia) || empty($mes) || empty($anio)) {
        $fechaNacimientoError = "Fecha de Nacimiento es obligatorio";
    } else {
        // Aseguramos que el día y mes tengan dos dígitos y el año tenga cuatro dígitos
        $dia = str_pad($dia, 2, '0', STR_PAD_LEFT);
        $mes = str_pad($mes, 2, '0', STR_PAD_LEFT);
        $anio = str_pad($anio, 4, '0', STR_PAD_LEFT);
        $fecha_nacimiento = "$anio-$mes-$dia";

        // Creamos objeto datetime con la fecha actual
        $fecha_actual = new DateTime();
        
        // Creamos objeto datetime con la fecha de nacimiento 
        $fecha_nacimiento_dt = DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
        $errors = DateTime::getLastErrors();

        if ($errors['warning_count'] > 0 || $errors['error_count'] > 0) {
            $fechaNacimientoError = "Fecha de Nacimiento no válida";
        } else {
            $diferencia = $fecha_actual->diff($fecha_nacimiento_dt);
            $edad = $diferencia->y;

            if ($edad < 18) { // Comprobamos que el usuario no sea menor de edad
                $fechaNacimientoError = "Debes ser mayor de 18 años para enviar el formulario";
            } elseif ($fecha_nacimiento_dt > $fecha_actual) { // Comprobamos que el usuario no sea del futuro XD
                $fechaNacimientoError = "La fecha de nacimiento no puede ser en el futuro";
            }
        }
    }

    // Comprobamos que no tenemos ningú error en la validación de los inputs de la página anterior, 
    // si es así, incializamos variables de sesión con los inputs recibidos y nos manteine en la página (page_3.php) mediante el header
    if (empty($telefonoError) && empty($ciudadError) && empty($fechaNacimientoError)) {
        $_SESSION['telefono'] = $telefono;
        $_SESSION['ciudad'] = $ciudad;
        $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
        $_SESSION['dia'] = $dia;
        $_SESSION['mes'] = $mes;
        $_SESSION['anio'] = $anio;
        header("location:page_3.php");
        exit;
    } else {
        // De lo contrario significa que tenemos algún error.
        // Inicializamos varaiables de sesión y les asignamos los valores de los inputs y de los mensajes de error
        // y nos vuelve a mandar a la página anterior (page_2.php) mediante el header(), para solucionar los errores
        $_SESSION['telefono'] = $telefono;
        $_SESSION['ciudad'] = $ciudad;
        $_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
        $_SESSION['dia'] = $dia;
        $_SESSION['mes'] = $mes;
        $_SESSION['anio'] = $anio;

        $_SESSION['telefonoError'] = $telefonoError;
        $_SESSION['ciudadError'] = $ciudadError;
        $_SESSION['fechaNacimientoError'] = $fechaNacimientoError;
        header("location:page_2.php");
        exit;
    }
}

// Función para formatear el número de teléfono
function formatearTelefono($telefono) {
    // Utilizamos substr() para dividir el string ($telefono) entre las posiciones 0, 1, 2 - 3, 4, 5 - 6, 7, 8
    return substr($telefono, 0, 3) . ' ' . substr($telefono, 3, 3) . ' ' . substr($telefono, 6);
}

// Formateamos el teléfono antes de mostrarlo
$telefonoFormateado = isset($_SESSION['telefono']) ? formatearTelefono($_SESSION['telefono']) : '';

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

                <!-- Imprimimos los datos introducidos y damos la opción al usuario de editar o finalmente enviar los datos introducidos -->

                <br>
                <h1>Revisar Datos</h1><br>

                <!-- Cada dato tiene un link que le redirige a la página correspondiente del formulario para poder editar la información -->
                <p><strong>Nombre:</strong> <?php echo ucfirst($_SESSION['nombre']); ?> <a href="index.php">Editar</a></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?> <a href="index.php">Editar</a></p>
                <p><strong>Teléfono:</strong> <?php echo $telefonoFormateado; ?> <a href="page_2.php">Editar</a></p>
                <p><strong>Ciudad:</strong> <?php echo ucfirst($_SESSION['ciudad']); ?> <a href="page_2.php">Editar</a></p>
                <p><strong>Fecha de Nacimiento:</strong> <?php echo $_SESSION['fecha_nacimiento']; ?> <a href="page_2.php">Editar</a></p>
                <br>
                <form action="page_4.php" method="POST">
                    <div class="col-12 d-flex justify-content-center">
                        <!-- Boton de confirmación de los datos que envía finalmente (todos) los datos del usuario -->
                        <button type="submit" class="btn btn-primary btn-largo">Confirmar Envío</button>
                    </div>
                    <br>
                </form>
                <br>
            </div>
            <?php include 'inc/aside.php'; ?>
        </div>
        <?php include 'inc/footer.php'; ?>
    </div>
    <?php include 'inc/scripts_finales.php'; ?>
</body>

</html>
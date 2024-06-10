<!-- 
    /////////////////
    PÁGINA PAGE_4.PHP 
    /////////////////

    Página que imprime toda la información introducida por el usuario en el formulario multipasos.
    Esta información es la que sería mandada posteriormente a una base de datos o a donde se que quisieramos gaurdarla.
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

// Función para formatear el número de teléfono
function formatearTelefono($telefono) {
    // Utilizamos substr() para dividir el string ($telefono) entre las posiciones 0, 1, 2 - 3, 4, 5 - 6, 7, 8
    return substr($telefono, 0, 3) . ' ' . substr($telefono, 3, 3) . ' ' . substr($telefono, 6);
}

// Formatear el teléfono antes de mostrarlo
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
        <div class="row">
            <?php include 'inc/aside.php'; ?>
            <div class="col-sm-8 col-10 card" id="Contenido">
                <br>

                <!-- Indicamos que los datos han sido enviados correctamente -->

                <h1>Datos Enviados Correctamente</h1><br>
                <p><strong>Nombre:</strong> <?php echo ucfirst($_SESSION['nombre']); ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $telefonoFormateado; ?></p>
                <p><strong>Ciudad:</strong> <?php echo ucfirst($_SESSION['ciudad']); ?></p>
                <p><strong>Fecha de Nacimiento:</strong> <?php echo $_SESSION['fecha_nacimiento']; ?></p>
                <br>
            </div>
            <?php include 'inc/aside.php'; ?>
        </div>
        <br>
        <?php include 'inc/footer.php'; ?>
    </div>
    <?php include 'inc/scripts_finales.php'; ?>
</body>

</html>

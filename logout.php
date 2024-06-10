<!-- 
    /////////////////
    CÓDIGO LOGOUT.PHP 
    /////////////////

    Este código nos sirve para eliminar y borrar la "cookie" que hemos generado en la página index.php
    Es decir, borramos cualquier indicio y actividad creada por la sesión.
-->

<?php

session_start();

// Destruimos la "cookie" de la sesión
session_destroy();

// Redirigimos al usuario a la página (sesion_terminda.php) mediante el header()
header("Location: sesion_terminda.php");
exit();

?>
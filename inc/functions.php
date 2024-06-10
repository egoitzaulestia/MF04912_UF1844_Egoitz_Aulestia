<!-- 
    //////////////////
    INCLUDE FOOTER.PHP 
    //////////////////

    Contiene la información del footer, el copywrite y la variable de configuración con mi nombre. 
-->
    
<?php

// Función para limpiar las variables recogidas
function recogerVar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Función para formatear el número de teléfono
function formatearTelefono($telefono) {
    return substr($telefono, 0, 3) . ' ' . substr($telefono, 3, 3) . ' ' . substr($telefono, 6);
}

// Función para activar la clase del menu de navegación
function active($page) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page == $page ? 'active' : '';
}

?>


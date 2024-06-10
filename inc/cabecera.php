<!-- 
    ////////////////////
    INCLUDE CABECERA.PHP 
    ////////////////////

    Contiene el titular del proyecto recogido en la variable de configuración ($sitioNombre).
    También contiene el botón de cerrar sesión. 
-->

<div class="row" id="header">

    <div class="col-4 col-sm-4"></div>

    <!-- Nombre del sitio llamada mediante una variable de conficuración ($sitioNombre). 
         El acceso a esta variable es posible al include (config.php), que lo inclusye cada página al inicio -->
    <div class="col-4 col-sm-4">
        <h1 class="high-text"><?php echo $sitioNombre; ?></h1>
    </div>

    <!-- La tarecera columna del header contiene el botón de cerrar sesión.
         Redirige al usuario a la página de cierre de sesión (logout.php) al hacer clic.  -->
    <div class="col-4 col-sm-4 cerrar-serion " style="text-align: center;">
        <button class="btn btn-primary" onclick="window.location.href='logout.php'">Cerrar sesión</button>
    </div>

</div>
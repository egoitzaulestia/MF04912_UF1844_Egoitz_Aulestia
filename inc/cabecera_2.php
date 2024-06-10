<!-- 
    ////////////////////
    INCLUDE CABECERA_2.PHP 
    ////////////////////

    Contiene la metadata que deben de incluir todas las páginas. 
-->

<div class="row" id="header">
    <div class="col-4 col-sm-4"></div>

    <!-- Nombre del sitio llamada mediante una variable de conficuración ($sitioNombre). 
         El acceso a esta variable es posible al include (config.php), que lo inclusye cada página al inicio -->
    <div class="col-4 col-sm-4">
        <h1 class="high-text"><?php echo $sitioNombre; ?></h1>
    </div>
    <div class="col-4 col-sm-4 cerrar-serion " style="text-align: center;"></div>
</div>
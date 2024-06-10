<!-- 
    //////////////////////
    INCLUDE NAVEGACIÓN.PHP 
    //////////////////////

    Contiene el menú de navegación. Por defecto la clase 'ego_deactive' está activada.
    Pero activamos la clase 'ego_active' en el momento que estemos en esa misma página.   
-->
    
<div class="row" id="navegador">
    <div class="col-lg-4 col-sm-4 col-4  <?php if ($paginaTitle  == "index") {echo 'ego_active';} else {echo 'ego_deactive';};?>">PASO 1</div>
    <div class="col-lg-4 col-sm-4 col-4 <?php  if ($paginaTitle  == "page_2") {echo 'ego_active';} else {echo 'ego_deactive';};?>">PASO 2</div>
    <div class="col-lg-4 col-sm-4 col-4 <?php if ($paginaTitle  == "page_3") {echo 'ego_active';} else {echo 'ego_deactive';};?>">PASO 3</div>
</div>

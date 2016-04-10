<?php

define("DIRECTORIO", __DIR__);

/**
 * Funcion para autocargado de clases
 * @param $clase 
 * @return void
*/

spl_autoload_register(function ($clase) {
    $directorio = DIRECTORIO."/"; // /opt/lampp/htdocs/cete/
    $clase = str_replace("\\", "/", $clase);
    include $directorio.$clase. '.php'; // /opt/lampp/htdocs/cete/Nucleo\Inicio.php
});

?>
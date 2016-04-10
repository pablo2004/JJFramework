<?php

/*
 * Pagina Principal
 *
 */
function microtimeFloat(){
     list($useg, $seg) = explode(" ", microtime());
     return ((float)$useg + (float)$seg);
}

$cargaInicio = microtime(true);
include 'cargador.php';
new Nucleo\Inicio();
$cargaFin = microtime(true);

$cargaOperacion = ($cargaFin - $cargaInicio);
$cargaOperacion = number_format($cargaOperacion, 4);
$memoriaRam = number_format((memory_get_usage() / 1024), 2);
echo "<div class=\"log\">Log: Memoria: ".$memoriaRam." kb Tiempo: ".$cargaOperacion."</div> ";

?>
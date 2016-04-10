<?php

namespace Nucleo;
use Controlador;

/**
 * Ejecuta la aplicacion
 *
 * @package       Nucleo.Inicio
 *
 */

class Inicio extends Objeto {

/**
 * Cargamos el controlador de la pagina
 *
 * @return void 
 */
     public function __construct()
     { 
          $controlador = ucfirst(strtolower(self::get("controlador")));       

          if(empty($controlador))
          {
               new Controlador\Pagina();
          }
          else
          {
               $nombreControlador = "Controlador\\".$controlador;
               new $nombreControlador();
          }
     }

}

?>
<?php

namespace Nucleo;

/**
 * Conexion y herramientas para la base de datos
 *
 * @package       Nucleo.Error
 */

class Error extends Objeto {

/**
 * Precarga de los errores, con mensaje y valor
 *
 * @return void
 */
     public function __construct()
     {

          $filtros = array();

          $filtros['noVacio'] = array(
               'mensaje' => 'El campo no debe estar vacio.', 
               'funcion' => function($valor){
                    return !empty($valor);	
               }
          );

          $filtros['numerico'] = array(
               'mensaje' => 'El campo no debe ser numerico.', 
               'funcion' => function($valor){
                    return is_numeric($valor);	
               }
          );

          $this->asignarAtributo("filtros", $filtros); 
     }

}

?>
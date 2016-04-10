<?php

namespace Modelo;

/**
 * Modelo de la tabla de usuarios
 *
 * @package       Modelo.Log
 */

class Log extends Modelo {

/**
 * Configuracion de los atributos del modelo
 *
 * @return void 
 */
     public function __construct()
     {
          parent::__construct();

          $this->asignarAtributo("nombre", "Log");
          $this->asignarAtributo("tablaNombre", "cms_logs");
          $this->asignarAtributo("campos", ['id', 'app', 'tipo', 'version', 'url', 'datos', 'mensaje', 'ip', 'navegador', 'fecha']);
	     $this->asignarAtributo("validaciones", [
	          'nombre' => ['noVacio']
	     ]);
     }

}

?>
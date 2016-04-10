<?php 

namespace Controlador; 

/**
 * Controlador por defecto para manejar la pagina de inicio
 *
 * @package  Controlador.Pagina
 */

class Pagina extends Controlador {

/**
 * Inicializamos los atributos del controlador
 *
 * @return void
 */
	public function __construct()
	{
	     $this->asignarAtributo("modelo", "");
	     $this->asignarAtributo("vista", "Pagina");
	     parent::__construct();
	}

/**
 * Mensaje de bienvenida
 *
 * @return void
 */
	public function index()
	{
		$this->redirige("Log", "index");
	}

}

?>
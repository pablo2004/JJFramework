<?php 

namespace Controlador; 
use Nucleo\Objeto;
use Nucleo\Formulario;

/**
 * Controlador Base
 *
 * @package       Controlador.Controlador
 */

class Controlador extends Objeto {

/**
 * Inicializamos los atributos del controlador y cargamos la capa principal y la vista del controlador
 *
 * @return void
 */

    private $variablesVista = array();

	public function __construct()
	{
		 if(!empty($this->leerAtributo("modelo")))
		 {
		      $nombreModelo = "Modelo\\".$this->leerAtributo("modelo");
		      $modelo = new $nombreModelo();
	          $this->asignarAtributo("objeto", $modelo);
	     }

	     $this->pasarVariable("Formulario", new Formulario());

	     $accion = self::get("accion");
	     $accion = (empty($accion)) ? "index" : $accion;

         
         call_user_func(array($this, $accion));
         extract($this->variablesVista);

         ob_start();
	     require DIRECTORIO."/Vista/".$this->leerAtributo("vista")."/".$accion.".php";
	     $contenidoPrincipal = ob_get_contents();
	     ob_end_clean();
         require DIRECTORIO."/Vista/index.php";
	}

/**
 * Pasa las variables del controlador a la vista
 * @param string $indice
 * @param mixed $valor
 * @return void
 */
	public function pasarVariable($indice, $valor)
	{
        $this->variablesVista[$indice] = $valor;
	}

/**
 * Funcion index default
 *
 * @return void
 */
	public function index()
	{
        
	}

/**
 * Funcion redirigir
 *
 * @return void
 */
	public function redirige($controlador, $accion)
	{
        header("Location: index.php?controlador=$controlador&accion=$accion");
	}


}

?>
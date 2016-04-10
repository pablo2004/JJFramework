<?php

namespace Controlador;

/**
 * Controlador para manejar los logs
 *
 * @package       Controlador.Log
 */

class Log extends Controlador {

/**
 * Inicializamos los atributos del controlador
 *
 * @return void
 */
	public function __construct()
	{

	     $this->asignarAtributo("modelo", "Log");
	     $this->asignarAtributo("vista", "Log");
	     parent::__construct();
	}

/**
 * Desplegamos la lista de logs actuales
 *
 * @return void
 */
  public function index()
  {
       $clave = self::get('clave');
       if(!self::iguales($clave, 'jjlog$')){
            die("Error.");
       }
       $logs = $this->leerAtributo("objeto")->filtrar([], ['Log.id DESC'], [], 50);
		   $this->pasarVariable("logs", $logs);
  }

/**
 * Daremos de alta un nuevo log
 *
 * @return void
 */
  public function alta()
	{

         if(sizeof($_POST) > 0)
         {
              $this->leerAtributo("objeto")->inserta($_POST);
              echo json_encode($this->leerAtributo("objeto")->leerAtributo('errores'));
              exit;
         }

	}

/**
 * Funcion para editar un log
 *
 * @return void
 */
	public function editar()
	{
         $id = intval(self::get("id"));

         $usuario = $this->leerAtributo("objeto")->filtrar(array("Usuario.id = '$id'"));
         $usuario = self::leerArregloEstatico($usuario, 0);
         $this->pasarVariable("usuario", $usuario);

         $this->pasarVariable("id", $id);

         if(sizeof($_POST) > 0)
         {
              $this->leerAtributo("objeto")->edita($id, $_POST);
              echo json_encode($this->leerAtributo("objeto")->leerAtributo('errores'));
              exit;
         }

	}

/**
 * Funcion para borrar logs
 *
 * @return void
 */
	public function borrar()
	{
		   $id = intval(self::get("id"));
       $this->leerAtributo("objeto")->borrar($id);
       exit;
	}


}

?>

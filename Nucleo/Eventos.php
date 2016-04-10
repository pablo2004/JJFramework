<?php

namespace Nucleo;

/**
 * Gestion de eventos de los modelos
 *
 * @package       Nucleo.Eventos
 */

interface Eventos {


/**
 * Se ejecuta antes ejecutar el proceso de inserta
 *
 * @return void 
 */

 public function antesDeGuardar($datos);


/**
 * Se ejecuta antes ejecutar el proceso despues de inserta
 *
 * @return void 
 */
 public function despuesDeGuardar($ultimoId);

}

?>
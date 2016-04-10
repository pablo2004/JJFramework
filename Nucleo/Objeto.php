<?php

namespace Nucleo; 

/**
 * Clase utilizada para manejar los atributos de una clase
 *
 * @package       Nucleo.Objeto
 */

class Objeto extends Utileria {

     protected $atributos = array();


/**
 * Regresa un array con todos los atributos almacenados
 *
 * @return array 
 */
     public function leerAtributos()
     { 
          return $this->atributos;
     }


/**
 * Asigna todos los atributos mediante un array
 * @param array $atributos
 * @return void 
 */
     public function asignarAtributos($atributos)
     { 
          if(is_array($atributos))
          {
               $this->atributos = $atributos;
          }
     }

/**
 * Regresa el valor de un atributo
 * @param string $indice
 * @return mixed
 */
     public function leerAtributo($indice)
     { 
          return $this->leerArreglo($this->leerAtributos(), $indice);
     }

/**
 * Asigna el valor a un atributo
 * @param string $indice
 * @param mixed $valor
 * @return void
 */
     public function asignarAtributo($indice, $valor)
     {  
          $atributos = $this->asignarArreglo($this->leerAtributos(), $indice, $valor);
          $this->asignarAtributos($atributos);
     }

/**
 * Revisa si existe el atributo
 * @param string $indice
 * @return boolean
 */
     public function contieneAtributo($indice)
     {
          return array_key_exists($indice, $this->leerAtributos());
     }

}

?>
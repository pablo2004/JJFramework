<?php

namespace Nucleo; 

/**
 * Funciones utiles para las clases
 *
 * @package       Nucleo.Utileria
 */

class Utileria {


/**
 * Regresa el valor de un array a partir de su indice
 * @param array $arreglo
 * @param string $indice
 * @return mixed
 */
     public function leerArreglo($arreglo, $indice)
     {

          $valor = null;

          if(is_array($arreglo))
          {
               if(array_key_exists($indice, $arreglo))
               {
                    $valor = $arreglo[$indice];
               }
          }
         
          return $valor;
          
     }


/**
 * Asigna un valor a un array a partir de su indice
 * @param array $arreglo
 * @param string $indice
 * @param mixed $valor
 * @return array
 */
     public function asignarArreglo($arreglo, $indice, $valor)
     {

          if(is_array($arreglo))
          {
               $arreglo[$indice] = $valor; 
          }

          return $arreglo;

     }


/**
 * Version estatica de leer arreglo
 * @param array $arreglo
 * @param string $indice
 * @return mixed
 */
     public static function leerArregloEstatico($arreglo, $indice)
     {

          $valor = null;

          if(is_array($arreglo))
          {
               if(array_key_exists($indice, $arreglo))
               {
                    $valor = $arreglo[$indice];
               }
          }
         
          return $valor;

     }

/**
 * Lee variables pasadas por post
 * @param string $indice
 * @return mixed
 */
     public static function post($indice)
     {
          return self::leerArregloEstatico($_POST, $indice);
     }

/**
 * Lee variables pasadas por get
 * @param string $indice
 * @return mixed
 */
     public static function get($indice)
     {
          return self::leerArregloEstatico($_GET, $indice);
     }


/**
 * Genera un array en lista a partir de un arreglo de varios valores
 * @param string $indice
 * @param string $valor
 * @return array
 */
     public static function arregloALista($array, $indice, $valor)
     {
          $lista = array();

          foreach($array AS $elemento)
          {
               $lista[self::leerArregloEstatico($elemento, $indice)] = self::leerArregloEstatico($elemento, $valor);
          }

          return $lista;
     }

/**
 * Ver si dos cadenas son iguales
 * @param string $cadena1
 * @param string $cadena2
 * @param boolean $sensible 
 * @return boolean
 */
     public static function iguales($cadena1, $cadena2, $sensible = true)
     {
          $retorno = false;

          if($sensible){
               $retorno = (strcmp($cadena1, $cadena2) === 0);
          }
          else{
               $retorno = (strcasecmp($cadena1, $cadena2) === 0);
          }

          return $retorno;
     } 

}

?>
<?php

namespace Nucleo;

/**
 * Conexion y herramientas para la base de datos
 *
 * @package       Nucleo.Formulario
 */

class Formulario extends Objeto {

/**
 * Precarga de los errores, con mensaje y valor
 *
 * @return void 
 */
     public function __construct()
     { 
          $this->asignarAtributo('nombre', "");    
          $this->asignarAtributo('datos', array());         
     }

/**
 * Inicializa un formulario html
 * @param array $nombre
 * @param array $atributos
 * @return string
 */
     public function inicializa($nombre, $configuracion = array())
     {
          $this->asignarAtributo('nombre', $nombre);

          if(!array_key_exists('name', $configuracion))
          {
               $configuracion['name'] = $nombre;
          }

          if(!array_key_exists('id', $configuracion))
          {
               $configuracion['id'] = "Formulario".$nombre;
          }

          $formulario = '<form '.$this->formatearAtributosHtml($configuracion).'>';
          return $formulario;
     }

/**
 * Termina un formulario html
 * @return string
 */
     public function termina()
     {
          $formulario = '</form>';
          return $formulario;
     }

/**
 * Asignas un array con atributos y lo formatea a un elemento de formulario html
 * @param array $atributos
 * @return string
 */
     private function formatearAtributosHtml($atributos)
     {
          $formato = "";

          foreach($atributos AS $nombre => $valor)
          {
               $formato .= " ".$nombre.'="'.$valor.'" ';
          }

          return $formato;
     }


/**
 * Genera un elemento de formulario
 * @param string $nombre
 * @param string $etiqueta
 * @param string $tipo (text, select)
 * @param array $atributos
 * @return string
 */
     public function elemento($nombre, $etiqueta, $tipo, $atributos = array())
     {
          $elemento = "";

          $valor = $this->leerArreglo($atributos, 'valor');

          if(empty($valor))
          {
               $valor = $this->leerArreglo($this->leerAtributo("datos"), $this->leerAtributo("nombre")."__".$nombre);
          }

          if(!array_key_exists('id', $atributos))
          {
               $atributos['id'] = str_replace(" ", "", ucwords(str_replace("_", " ", $nombre)));
          }

          if(in_array($tipo, array('text', 'password', 'date')))
          {
               $elemento = '<div class="forma-contenedor">
                              <div class="forma-etiqueta">'.$etiqueta.'</div>
                                   <input class="forma-elemento" value="'.$valor.'" name="'.$nombre.'" type="'.$tipo.'" '.$this->formatearAtributosHtml($atributos).' />
                              <div id="'.$nombre.'Mensaje" class="forma-mensaje"></div>
                         </div>';
          }

          if(strcasecmp($tipo, 'select') === 0)
          {
               $opciones = $this->leerArreglo($atributos, 'opciones');
               unset($atributos['opciones']);
               $opcionesHtml = "";

               foreach ($opciones AS $opcionClave => $opcionValor) {
                    $opcionesHtml .= ($valor == $opcionClave) ? '<option selected value="'.$opcionClave.'">'.$opcionValor.'</option>' : '<option  value="'.$opcionClave.'">'.$opcionValor.'</option>';
               }

               $elemento = '<div class="forma-contenedor">
                              <div class="forma-etiqueta">'.$etiqueta.'</div>
                                   <select class="forma-elemento" name="'.$nombre.'" '.$this->formatearAtributosHtml($atributos).'>
                                   '.$opcionesHtml.'
                                   </select>
                              <div id="'.$nombre.'Mensaje" class="forma-mensaje"></div>
                         </div>';
          }

          return $elemento;
     }


/**
 * Generador de botones para formulario
 * @param string $nombre
 * @param string $tipo (text, select)
 * @param array $atributos
 * @return string
 */

     public function boton($nombre, $tipo, $atributos)
     {
          $elemento = "";

          $elemento = '<button type="'.$tipo.'" '.$this->formatearAtributosHtml($atributos).'>'.$nombre.'</button>';

          return $elemento;
     }

}

?>
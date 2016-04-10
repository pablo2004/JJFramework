<?php

namespace Modelo;
use \PDO;
use Nucleo\BaseDatos;
use Nucleo\Error;
use Nucleo\Eventos;

/**
 * Conexion y herramientas para la base de datos
 *
 * @package       Modelo.Modelo
 */

class Modelo extends Error implements Eventos {

/**
 * Se crean los atributos base
 *
 * @return void
 */

     public function __construct()
     {
          parent::__construct();
       	  $this->asignarAtributo("id", 0);
       	  $this->asignarAtributo("ultimoId", 0);
          $this->asignarAtributo("validaciones", array());
          $this->asignarAtributo("errores", array());
          $this->asignarAtributo("nombre", "");
          $this->asignarAtributo("tablaNombre", "");
          $this->asignarAtributo("campos", array());
          $this->asignarAtributo("db", "BaseDatos");
     }


/**
 * Filtra los registros de una tabla
 * @param array $condiciones formato array(Modelo.)
 * @param array $uniones
 * @param array $orden
 * @param int $limite
 * @return array
 */
     public function filtrar($condiciones = array(), $orden = array(), $uniones = array(), $limite = 0)
     {
          $resultados = array();
          $campos = array();
          $unionesConsulta = "";

          foreach($this->leerAtributo('campos') AS $campo)
          {
               array_push($campos, $this->leerAtributo('nombre').".".$campo);
          }

          if(sizeof($uniones) > 0)
          {
               foreach($uniones AS $union)
               {
                    $modeloNombre = "Modelo\\".$union['nombre'];
                    $modelo = new $modeloNombre();
                    $camposUnion = $modelo->leerAtributo('campos');
                    foreach($camposUnion AS $campoUnion)
                    {
                       array_push($campos, $modelo->leerAtributo('nombre').".".$campoUnion);
                    }

                    $unionesConsulta .= "LEFT JOIN ".$modelo->leerAtributo('tablaNombre')." AS ".$modelo->leerAtributo('nombre')." ON ".$union['condicion'];
               }
          }

          $consulta = "SELECT ".implode(", ", $campos);
          $consulta .= ' FROM '.$this->leerAtributo('tablaNombre').' AS '.$this->leerAtributo('nombre')." ".$unionesConsulta;

          if(sizeof($condiciones) > 0)
          {
               $consulta .= " WHERE ".implode(" AND ", $condiciones);
          }

          if(sizeof($orden) > 0)
          {
               $consulta .= " ORDER BY ".implode(" ,", $orden);
          }

          if($limite > 0)
          {
               $consulta .= " LIMIT ".$limite;
          }

          $ejecuta = BaseDatos::conexion()->query($consulta, PDO::FETCH_NUM);

          foreach($ejecuta AS $fila)
          {
               $registro = array();
               $i = 0;
               foreach($campos AS $campo)
               {
                    $registro[str_replace(".", "__", $campo)] = $fila[$i];
                    $i++;
               }

               array_push($resultados, $registro);
          }

          return $resultados;
     }

    public function insertaMuchos($datos)
    {
        $valores = array_map(function($valor){
            return "(".implode(",", array_map(function($local){ return "'".$local."'"; }, $valor)).")";
        }, $datos);
        $consulta = 'INSERT INTO '.$this->leerAtributo('tablaNombre').' ('.implode(", ", array_keys($datos[0]) ).') VALUES '.implode(", ", $valores);

        BaseDatos::conexion()->query($consulta);
    }

/**
 * Inserta un registro a partir de los campos dados
 * @param array $campos
 * @param boolean $validar
 * @return void
 */
     public function inserta($campos, $validar = true)
     {
     	$this->asignarAtributo("errores", array());
          $campos = $this->antesDeGuardar($campos);

          if($validar)
          {
               $this->asignarAtributo("errores", $this->validar($campos));
          }

          if(!$this->existeError())
          {
          	   $indices = array_keys($campos);
          	   $indicesFormato = array_map(function($indice){ return ":".$indice; }, $indices);

          	   BaseDatos::conexion()->prepare('INSERT INTO '.$this->leerAtributo('tablaNombre').' ('.implode(",", $indices).') VALUES ('.implode(",", $indicesFormato).')')->execute($campos);

          	   $ultimoId = BaseDatos::conexion()->lastInsertId();

               $this->despuesDeGuardar($ultimoId);
               $this->asignarAtributo("ultimoId", $ultimoId);
          }
     }

/**
 * Actualiza un registro a partir de los campos dados
 * @param int $id
 * @param array $campos
 * @param boolean $validar
 * @return void
 */
     public function edita($id, $campos, $validar = true)
     {
          $this->asignarAtributo("errores", array());
          $campos = $this->antesDeGuardar($campos);

          if($validar)
          {
               $this->asignarAtributo("errores", $this->validar($campos));
          }

          if(!$this->existeError())
          {
               $indices = array_keys($campos);
               $camposFormateados = array_map(function($indice){ return "$indice = :$indice"; }, $indices);

               BaseDatos::conexion()->prepare("UPDATE ".$this->leerAtributo('tablaNombre')." SET ".implode(", ", $camposFormateados)." WHERE id = '$id'")->execute($campos);

               $ultimoId = BaseDatos::conexion()->lastInsertId();

               $this->despuesDeGuardar($ultimoId);
               $this->asignarAtributo("ultimoId", $ultimoId);
          }
     }

/**
 * Borra un registro a partir de su id
 * @param int $id
 * @return void
 */
     public function borrar($id)
     {

          BaseDatos::conexion()->prepare("DELETE FROM ".$this->leerAtributo('tablaNombre')." WHERE id = '$id'")->execute(array());

     }

/**
 * Valida un array de datos respecto a las validaciones dadas y regresa un array con los errores
 * @param array $campos
 * @return array
 */
     public function validar($campos)
     {
          $errores = array();
          $filtros = $this->leerAtributo("filtros");
          $validaciones = $this->leerAtributo("validaciones");

          foreach($campos AS $indice => $valor)
          {
               if(array_key_exists($indice, $validaciones))
               {
                     $validar = $validaciones[$indice];

                     foreach($validar AS $valida)
                     {
                          if(!call_user_func_array($filtros[$valida]['funcion'], array($valor)))
                          {
                               array_push($errores, array('nombre' => $indice, 'mensaje' => $filtros[$valida]['mensaje']));
                          }
                     }
               }
          }

          return $errores;
     }

/**
 * Devuelve verdadero o false si la validacion regreso error
 * @return boolean
 */
     public function existeError()
     {
          $existe = (sizeof($this->leerAtributo("errores")) == 0) ? false : true;
          return $existe;
     }

/**
 * Ejecuta una accion antes de hacer una consulta de INSERT o UPDATE
 * @param array $datos
 * @return array
 */
     public function antesDeGuardar($datos)
     {
          return $datos;
     }

/**
 * Se ejecuta esta funcion despues de hacer una consulta de INSERT o UPDATE
 * @param array $ultimoId
 * @return void
 */
     public function despuesDeGuardar($ultimoId)
     {

     }
}

?>

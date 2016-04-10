<?php

namespace Nucleo; 
use \PDO;

/**
 * Conexion y erramientas para la base de datos
 *
 * @package       Nucleo.BaseDatos
 */

class BaseDatos {

     public static $host = "localhost";
     public static $baseDatos = "logs";
     public static $usuario = "root";
     public static $password = "";
     public static $conexion = null;
     public static $conectado = false;

/**
 * Asignamos la configuracion de la base de datos
 *
 * @return void 
 */
     public static function start()
     {
          try 
          {
               self::$conexion = new PDO('mysql:dbname='.self::$baseDatos.";host=".self::$host, self::$usuario, self::$password);
               self::$conectado = true;
          } catch (PDOException $e) {
               die("Error: ".$e->getMessage());
          }
     }

/**
 * Inicializa la conexion con la base de datos
 *
 * @return PDO
 */
     public static function conexion()
     {
          if(!self::$conectado)
          {
               self::start();
          }
          return self::$conexion;
     }
}

?>
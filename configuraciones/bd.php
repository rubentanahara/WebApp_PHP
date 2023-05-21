<?php

use \PDO;

class BD
{
   public static $instancia = null;
   public static function CrearInstancia()
   {
      if (!isset(self::$instancia)) {
         $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         self::$instancia = new PDO('mysql:host=localhost;dbname=web_app', 'root', '', $opciones);
      }
      return self::$instancia;
   }
}

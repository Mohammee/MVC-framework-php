<?php
namespace PHPMVC\LIB;


class Autoloader{

    public static function autoload($className)
    {
     
      // require APP_PATH . strtolower(strstr($className,DS)) . '.php';

     $className =  str_replace('PHPMVC','',str_replace('\\' , DS ,$className)) . '.php';
     $className = strtolower($className);

     if(file_exists(APP_PATH . $className)){
         require APP_PATH . $className;
     }
   

    }


}

     spl_autoload_register(__NAMESPACE__ . '\Autoloader::autoload');




<?php
namespace PHPMVC\LIB\DATABASE;
class  PDODatabaseHandle extends DatabaseHandle{

    private static $_instance;
    private static $_handle;

    private function __construct()
    {
        self::init();
    }

     public function __call($name,$arguments){
         return call_user_func_array(array(self::$_handle,$name),$arguments);
     }

    public static function init(){
    
         try{
        static::$_handle = new \PDO('mysql:hostname='.DATABASE_HOST_NAME 
        . ';port='.DATABASE_PORT_NAME.
        ';dbname='.DATABASE_DB_NAME 
        , DATABASE_USER_NAME,DATABASE_PASSWORD_NAME,
        array(
       \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
        );
        }catch(\Exception $e){

         }
    }

    public static function  getInstace(){
       if(!isset(self::$_instance)){
           self::$_instance = new self();
       }
       return self::$_instance;
    }

}
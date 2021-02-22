<?php
namespace PHPMVC\LIB;
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
    }
   
   
   define('APP_PATH',realpath(dirname(__FILE__,2))); 
   define('TEMPLATE_PATH',realpath(dirname(__FILE__,2)). DS . 'template'); 
   define('VIEW_PATH',realpath(dirname(__FILE__) . DS. '..' . DS . 'view'));
   // Session configuration
defined('SESSION_NAME')     ? null : define ('SESSION_NAME', '_ESTORE_SESSION');
defined('SESSION_LIFE_TIME')     ? null : define ('SESSION_LIFE_TIME', 0);
defined('SESSION_SAVE_PATH')     ? null : define ('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'sessions');

(defined('DATABASE_HOST_NAME')) ? null : define('DATABASE_HOST_NAME','localhost');
(defined('DATABASE_USER_NAME')) ? null : define('DATABASE_USER_NAME','root');
(defined('DATABASE_DB_NAME')) ? null : define('DATABASE_DB_NAME','php_pdo');
(defined('DATABASE_PASSWORD_NAME')) ? null : define('DATABASE_PASSWORD_NAME','');
(defined('DATABASE_PORT_NAME')) ? null : define('DATABASE_PORT_NAME',3306);
(defined('DATABASE_CONN_DRIVER')) ? null : define('DATABASE_CONN_DRIVER',1);

session_start();

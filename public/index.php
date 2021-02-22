<?php

namespace PHPMVC;

define('DS',DIRECTORY_SEPARATOR);

require_once '..' . DS . 'app' . DS . 'config' .DS . 'config.php';
require_once '..' . DS . 'app' . DS . 'lib' .DS . 'autoloader.php';



$frontcontroller = new LIB\FrontController();




























// define('APP_PATH',dirname(realpath(__FILE__),2));
// define('DS',DIRECTORY_SEPARATOR);
// define('PS',PATH_SEPARATOR);
// define('VIEW_PATH',APP_PATH . DS . 'app' . DS . 'view');

// $paths = get_include_path() . PS . VIEW_PATH;
// echo $paths;

// set_include_path($paths);

//        function MyAutoloader($className){
//    require strtolower($className) . '.class.php';
//        }

//        spl_autoload_register('MyAutoloader');



// $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
// echo '<pre/>';
// list($controller,$actions,$params) = explode('/',trim($url,'/'),3);

// $params = explode('/',$params);
// echo '<pre>';
// var_dump($controller , $actions,$params);



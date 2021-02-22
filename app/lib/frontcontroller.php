<?php

namespace PHPMVC\LIB;

class FrontController
{

    const NOT_FOUND_CONTROLLER = "PHPMVC\CONTROLLERS\NotfoundController";
    const NOT_FOUND_ACTION = 'notFoundActions';

    private $_controller = 'index';
    private $_actions = 'default';
    private $_params = array();

    public function __construct()
    {
        $this->_parseUrl();
    }


    private function _parseUrl()
    {
        $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);

        if (isset($url[0]) && $url[0] != '') {
            $this->_controller = $url[0];
        }

        if (isset($url[1]) && $url[1] != '') {
            $this->_actions = $url[1];
        }

        if (isset($url[2]) && $url[2] != '') {
            $this->_params = explode('/', $url[2]);
        }

        // @list($this->_controller,$this->_actions,$this->_params) = explode( '/' , trim($url,'/') , 3 );


        $this->dispatch();
    }

    public function dispatch()
    {

        $controllerClassName = 'PHPMVC\CONTROLLERS\\' . ucfirst($this->_controller . 'Controller');
        $actoinName = $this->_actions . 'Action';

        if (!class_exists($controllerClassName)) {
            $controllerClassName = self::NOT_FOUND_CONTROLLER ;
        }

        $controller = new $controllerClassName;

        if (!method_exists($controller, $actoinName)) {
           $this->_actions =  $actoinName = self::NOT_FOUND_ACTION;
        }
         
        $controller->setController($this->_controller);
        $controller->setAction($this->_actions);
        $controller->setParams($this->_params);
        
        $controller->$actoinName();
    }
}

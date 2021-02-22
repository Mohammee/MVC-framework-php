<?php

namespace PHPMVC\CONTROLLERS;

use PHPMVC\LIB\FrontController;

class AbstractController{

    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_data = [];

    public function notFoundActions(){
       $this->_view();
    }
 
     
     public function setController($controller)
     {
     $this->_controller = $controller;
     }

     public function setAction($action)
     {
     $this->_action = $action;
     }

     public function setParams($params)
     {
     $this->_params = $params;
     }
     

     protected function _view(){
         
         if($this->_action == FrontController::NOT_FOUND_ACTION)
         {
        require VIEW_PATH . DS . 'notfound' . DS . 'notfound.view.php';
         }else{
            $view  = VIEW_PATH . DS . $this->_controller . DS . $this->_action . '.view.php';
             if(file_exists($view)){
                 extract($this->_data);
               //  require TEMPLATE_PATH . DS . 'templateheaderstart.php';
                // require TEMPLATE_PATH . DS . 'templateheaderend.php';
                // require TEMPLATE_PATH . DS . 'nav.php';
                // require TEMPLATE_PATH . DS . 'header.php';
               //  require TEMPLATE_PATH . DS . 'wrapperstart.php';
                 require $view;
                // require TEMPLATE_PATH . DS . 'wrapperend.php';
                // require TEMPLATE_PATH . DS . 'teplatefooter.php';
             }else{
         require VIEW_PATH . DS . 'notfound' . DS . 'noview.view.php';
             }

        }

     }

}
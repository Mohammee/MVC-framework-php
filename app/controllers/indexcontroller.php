<?php

namespace PHPMVC\CONTROLLERS;


class IndexController extends AbstractController{

 public function defaultAction(){
    parent::_view();
 }

 public function testAction(){
    parent::_view();
 }

}
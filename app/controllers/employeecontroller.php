<?php

namespace PHPMVC\CONTROLLERS;

use PHPMVC\LIB\FilterInput;
use PHPMVC\LIB\Helper;
use PHPMVC\MODELS\EmployeeModle;

class EmployeeController extends AbstractController
{

    use FilterInput;
    use Helper;

    public function defaultAction()
    {
        $this->_data['employee'] = EmployeeModle::getAll();
        parent::_view();
    }


    public function addAction()
    {
        if (isset($_POST['submit'])) {
            $user = new EmployeeModle();
            $user->name = $this->filterString($_POST['name']);
            $user->address = $this->filterString($_POST['address']);
            $user->salary = $this->filterFloat($_POST['salary']);
            $user->age = $this->filterInt($_POST['age']);
            $user->tax = $this->filterFloat($_POST['tax']);
            if ($user->save()) {
                $_SESSION['message']  =  'Employee ' . $user->name . ' Saving successfully';
                $this->redirect('/employee');
            }
        }
        parent::_view();
    }


    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $user =  EmployeeModle::getByPK($id);
        if ($user === false) {
            $this->redirect('/employee');
        }
        if (isset($_POST['submit'])) {
            $user->name = $this->filterString($_POST['name']);
            $user->address = $this->filterString($_POST['address']);
            $user->salary = $this->filterFloat($_POST['salary']);
            $user->age = $this->filterInt($_POST['age']);
            $user->tax = $this->filterFloat($_POST['tax']);
            if ($user->save()) {
                $_SESSION['message']  =  'Employee ' . $user->name . ' Saving successfully';
                $this->redirect('/employee');
            }
        }

        $this->_data['user'] = $user;
        $this->_action = 'add';
        $this->_view();
    }


    public function deleteAction(){

        $id = $this->filterInt($this->_params[0]);
        $emp = EmployeeModle::getByPK($id);
        if($emp === false){
            $this->redirect('/employee');
        }

        if($emp->delete()){
            $_SESSION['message']  =  'Employee '. $emp->name . ' deleting successfully';
            $this->redirect('/employee');

        }

    }
}

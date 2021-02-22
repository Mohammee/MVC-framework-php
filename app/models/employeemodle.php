<?php
namespace PHPMVC\MODELS;

class EmployeeModle extends AbstractModel{


    private $id;
    private $name;
    private $address;
    private $age;
    private $tax;
    private $salary;


    protected static $tableName = 'employees';
   // protected static $db;
    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'name' => self::DATA_TYPE_STRING,
        'age' => self::DATA_TYPE_INT,
        'address' => self::DATA_TYPE_STRING,
        'salary' => self::DATA_TYPE_DESIMAL,
        'tax' => self::DATA_TYPE_DESIMAL
    );

    // public function __construct($name , $age , $address , $salary,$tax){
          
    //  // global $connection; this is another way to use connection databases 
    // // self::$db = $connection;

    //     $this->name = $name;
    //     $this->age = $age;
    //     $this->address = $address;
    //     $this->salary = $salary;
    //     $this->tax = $tax;

        

    //     // self::$db = $GLOBALS['connection']; another method for use global scope inside local scope
    // }

     public function __get($prop){
       return  $this->$prop;
     }

     public function __set($prop,$value){
      $this->$prop = $value;
    }

    public function realSalary(){
        return $this->salary - ($this->salary * $this->tax/100);
    }

}
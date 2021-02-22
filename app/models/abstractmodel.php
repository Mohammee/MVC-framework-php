<?php

namespace PHPMVC\MODELS;

use PHPMVC\LIB\DATABASE\DatabaseHandle;

class AbstractModel
{

    const DATA_TYPE_INT = \PDO::PARAM_INT;
    const DATA_TYPE_STRING = \PDO::PARAM_STR;
    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
    const DATA_TYPE_DESIMAL = 4;
    const DATA_TYPE_DATE = 5;

    const VALIDATE_DATE_STRING = '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/';

    // TODO:: Check the valid dates in MYSQL to create a proper pattern
    const VALIDATE_DATE_NUMERIC = '^\d{6,8}$';
    const DEFAULT_MYSQL_DATE = '1970-01-01';


    private function prepareVlaue(\PDOStatement &$stat,$schema){

        foreach ($schema as $colName => $dataType) {
            if ($dataType === 4) {
                $Sanitize = filter_var($this->$colName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stat->bindvalue(":{$colName}", $Sanitize, $dataType);
            } else {
                $stat->bindValue(":{$colName}", $this->$colName, $dataType);
            }
        }

    }

    private static function buildNameParamsSQL(){

        $nameParams = '';
        foreach (self::getTableSchema() as $colName => $datatype) {
            $nameParams .= $colName . ' = :' . $colName . ' ,';
        }
        return trim($nameParams, ',');
    }


    private function create(){

        $sql = "INSERT INTO " . self::getTableName() . " set " . static::buildNameParamsSQL();

        $stat = DatabaseHandle::factory()->prepare($sql);
        $this->prepareVlaue($stat,self::getTableSchema());
        if($stat->execute()){
         $this->{self::getPrimaryKey()} = DatabaseHandle::factory()->lastInsertId();
         return true;
        }
        return false;
    }

    private function update(){

        $sql = "UPDATE " . self::getTableName() . " set " . static::buildNameParamsSQL() . "WHERE " . self::getPrimaryKey() . " = " . $this->{self::getPrimaryKey()};

        $stat = DatabaseHandle::factory()->prepare($sql);
        $this->prepareVlaue($stat,self::getTableSchema());
        return $stat->execute();

    }

       
    public function save(){
        return ($this->{self::getPrimaryKey()} === null)? $this->create() : $this->update();
    }


    public function delete(){

        $sql = "DELETE FROM " . self::getTableName() . " WHERE " . self::getPrimaryKey() . " = '" . $this->{self::getPrimaryKey()} . "'";

        $stat = DatabaseHandle::factory()->prepare($sql);
        $this->prepareVlaue($stat,self::getTableSchema());
        return $stat->execute();

    }
    
    public static function getAll(){
        
      $sql = "SELECT * FROM " . self::getTableName();
      $stat = DatabaseHandle::factory()->prepare($sql);
      $stat->execute();
      if(method_exists(get_called_class(),'__construct')){
      $result = $stat->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,get_called_class(),array_keys(self::getTableSchema()));
      }else{
        $result = $stat->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,get_called_class());
      }

      if(is_array($result) && !empty($result)){
          return $result;
      }
      return false;

    }

    public static  function getByPK($pk){
  
        $sql = "SELECT * FROM " . self::getTableName() . " WHERE " . self::getPrimaryKey() . " = '" . $pk . "'";
        $stat = DatabaseHandle::factory()->prepare($sql);

        if($stat->execute() === true ){
            if(method_exists(get_called_class(),'__construct')){
                $obj = $stat->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,get_called_class(),array_keys(self::getTableSchema()));
                }else{
                  $obj = $stat->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE,get_called_class());
                }
          
                return (!empty($obj)) ?array_shift($obj):false;
      } 

      return false;
    }



    public static function get($sql , $options = array()){

       $stat =  DatabaseHandle::factory()->prepare($sql);

        foreach ($options as $colName => $type) {
            if ($type[0] === 4) {
                $Sanitize = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stat->bindvalue(":{$colName}", $Sanitize,$type[0] );
            } else if ($type[0] == 5) {
                if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                    $stat->bindValue(":{$colName}", self::DEFAULT_MYSQL_DATE);
                    continue;
                }
                $stat->bindValue(":{$colName}", $type[1]);
            } else {
                $stat->bindValue(":{$colName}", $type[1] , $type[0] );
            }
        }

        if($stat->execute()){
            if(method_exists(get_called_class(),'__construct')){
        $result = $stat->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE , get_called_class() , array_keys(self::getTableSchema()));
            }else{
                $result = $stat->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE , get_called_class() );
            }
            return (is_array($result)&& !empty($result))? new \ArrayIterator(array($result)) : false;
        }
        return false;
    }





    //this proparty passed from employee class to parrent 
    private static function getTableName(){
        return static::$tableName;
    }

    private static function getTableSchema(){
        return static::$tableSchema;
    }


    private static function getPrimaryKey(){
        return static::$primaryKey;
    }


}

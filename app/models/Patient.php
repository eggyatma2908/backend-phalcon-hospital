<?php

class Patient extends \Phalcon\Mvc\Model
{

    public $id;
    public $name;
    public $sex;
    public $religion;
    public $phone;
    public $address;
    public $nik;
    public $createdAt;
    public $updateAt;
    public function initialize()
    {
        $this->setSchema("hospital");
        $this->setSource("patient");
    }

    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }
    
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}

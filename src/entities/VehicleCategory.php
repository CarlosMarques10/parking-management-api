<?php
namespace src\entities;

class VehicleCategory {

    private int $id;
    private string $name;
    private float $rate;

    function __construct($name = "", $rate = 0){
        $this->name = $name;
        $this->rate = $rate;
    }

    
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getRate(){
        return $this->rate;
    }

    public function setRate($rate){
        $this->rate = $rate;
        return $this;
    }



}


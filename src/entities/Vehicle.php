<?php
namespace src\entities;

class Vehicle {

    private int $id;
    private int $idVehicleCategory;
    private string $plate;
    private float $totalRate;


    function __construct($idVehicleCategory = 0,$plate = ""){
        $this->idVehicleCategory = $idVehicleCategory;
        $this->plate = $plate;

    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    
    public function getIdVehicleCategory(){
        return $this->idVehicleCategory;
    }


    public function setIdVehicleCategory($idVehicleCategory){
        $this->idVehicleCategory = $idVehicleCategory;
        return $this;
    }

    public function getPlate(){
        return $this->plate;
    }

    public function setPlate($plate){
        $this->plate = $plate;

        return $this;
    }

    public function getTotalRate(){
        return $this->totalRate;
    }


    public function setTotalRate($totalRate){
        $this->totalRate = $totalRate;
        return $this;
    }
}
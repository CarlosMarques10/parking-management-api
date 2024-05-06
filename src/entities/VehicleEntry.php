<?php
namespace src\entities;

class VehicleEntry {


    private int $id;
    private $date_entry;
    private $active;
    private int $id_vehicle;

    function __construct($date_entry = "", $id_vehicle = 0){
        $this->date_entry = $date_entry;
        $this->id_vehicle = $id_vehicle;
    }

    
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getDate_entry(){
        return $this->date_entry;
    }

    public function setDate_entry($date_entry){
        $this->date_entry = $date_entry;
        return $this;
    }

    public function getActive(){
        return $this->active;
    }
 
    public function setActive($active){
        $this->active = $active;
        return $this;
    }

    public function getId_vehicle(){
        return $this->id_vehicle;
    }

    public function setId_vehicle($id_vehicle){
        $this->id_vehicle = $id_vehicle;
        return $this;
    }
    
}
<?php
namespace src\entities;

class VehicleExit {

    private int $id;
    private $date_exit;
    private int $id_vehicle;


    function __construct($date_exit = "", $id_vehicle = 0){
        $this->date_exit = $date_exit;
        $this->id_vehicle = $id_vehicle;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function getId_vehicle(){
        return $this->id_vehicle;
    }

    public function setId_vehicle($id_vehicle){
        $this->id_vehicle = $id_vehicle;
        return $this;
    }

    public function getDate_exit(){
        return $this->date_exit;
    }

    public function setDdate_exit($date_exit){
        $this->date_exit = $date_exit;
        return $this;
    }


}
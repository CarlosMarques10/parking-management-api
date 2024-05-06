<?php
namespace src\services;

use Exception;
use PDOException;
use src\entities\VehicleCategory;
use src\repositories\VehicleCategoryRepository;

class VehicleCategoryService {

    static function insert() {
        $response = ["result" => [], "error" => []];

        try {
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if(isset($data["name"], $data["rate"])){
                $repository = new VehicleCategoryRepository();

                $nameExists = $repository->exists($data["name"]);
                
                if($nameExists){
                    return $response['error'] = 'name already exists';
                }
                $vehicleCategory = new VehicleCategory($data["name"], $data["rate"]);
                $response = $repository->save($vehicleCategory);

            }else{
                throw new Exception("Name and rate fields are mandatory");
            }

        } catch (PDOException $e) {
            $response["error"] = $e->getMessage();
        }
        return $response;
    }



    static function findAll(){
        $response = ["result" => [], "error" => []];

        try{
            $repository = new VehicleCategoryRepository();
            $response = $repository->getAll();

        } catch (PDOException $e){
            $response["error"] = $e->getMessage();
        }
        return $response;
    }

}


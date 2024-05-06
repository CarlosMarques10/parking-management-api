<?php
namespace src\services;

use DateTime;
use PDOException;
use Exception;
use src\entities\Vehicle;
use src\entities\VehicleCategory;
use src\entities\VehicleEntry;
use src\entities\VehicleExit;
use src\repositories\VehicleRepository;

class VehicleService {

    static function insert(){
        $response = ["result" => [], "error" => []];

        try{
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if(isset($data["idVehicleCategory"], $data["plate"])){

                if(strlen($data["plate"]) > 7){
                    throw new Exception("The license plate must contain seven digits");
                }

                $vehicle = new Vehicle($data["idVehicleCategory"], $data["plate"]);
                $repository = new VehicleRepository();
                $response = $repository->save($vehicle);
            } else{
                throw new Exception("idVehicleCategory and plate fields are mandatory");
            }

        } catch (PDOException $e){
            $response["error"] = $e->getMessage();
        }
        return $response;
    }


    static function insertVehicleEntry(){
        $response = ["result" => [], "error" => []];

        try{
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if(isset($data["date_entry"], $data["id_vehicle"])){
                $repository = new VehicleRepository();

                $dataHoraFormatada = FormatDate::format($data["date_entry"]);

                if($repository->verifyVehicle($data["id_vehicle"])){
                    throw new Exception("This vehicle already has an entry");
                }else {
                    $vehicleEntry = new VehicleEntry($dataHoraFormatada,  $data["id_vehicle"]);

                    if($repository->vehicleExists($data["id_vehicle"])){
                        $response = $repository->saveVehicleEntry($vehicleEntry);
                        $repository->updateVehicleEntry($data["id_vehicle"]);
                    } else{
                        throw new Exception("This vehicle does not exist");
                    }
                }
            } else{
                throw new Exception("date_entry and id_vehicle fields are mandatory");
            }

        } catch (PDOException $e){
            $response["error"] = $e->getMessage();
        }

        return $response;
    }


    static function insertVehicleExit(){
        $response = ["result" => [], "error" => []];

        try{
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);

            if(isset($data["date_exit"], $data["id_vehicle"])){

            $repository = new VehicleRepository();

            $dataHoraFormatada = FormatDate::format($data["date_exit"]);

            if($repository->vehicleExists($data["id_vehicle"])){
                if($repository->verifyVehicle($data["id_vehicle"])){
                    $vehicleExit = new VehicleExit($dataHoraFormatada,  $data["id_vehicle"]);
                    $response = $repository->saveVehicleExit($vehicleExit);
                    $repository->updateVehicleExit($data["id_vehicle"]);
                }else{
                    throw new Exception("This vehicle does not have an entry");
                }
            }else{
                throw new Exception("This vehicle does not exist");
            }

        }else {
            throw new Exception("date_exit and id_vehicle fields are mandatory");
        }

        } catch(PDOException $e){
            $response["error"] = $e->getMessage();
        } catch(Exception $e) {
            $response["error"] = $e->getMessage();
        }
        return $response;
    }


    static function findAllVehicles(){
        $response = ["result" => [], "error" => []];

        try{
            $repository = new VehicleRepository();
            $result = $repository->getAllVehicles();

            if(!empty($result["result"])){
                foreach($result["result"] as $item){

                    $vehicleCategory = new VehicleCategory();
                    $vehicleCategory->setName($item["name"]);
                    $vehicleCategory->setRate($item["rate"]);

                    $vehicle = new Vehicle();
                    $vehicle->setPlate($item["plate"]);
                    $vehicle->setId($item["id_vehicle"]);

                    $vehicleEntry = new VehicleEntry();
                    $vehicleEntry->setDate_entry($item["date_entry"]);

                    $vehicleExit = new VehicleExit();
                    $vehicleExit->setDdate_exit($item["date_exit"]);

                    $entry_datetime = new DateTime($item["date_entry"]);
                    $exit_datetime = new DateTime($item["date_exit"]);
                    $interval = $entry_datetime->diff($exit_datetime);
                    $hours = $interval->format('%h');
                    $minutes = $interval->format('%i');

                    $totalRate = $item["rate"] * ($hours + ($minutes / 60));
                    $totalRate = ceil($totalRate);
                    $vehicle->setTotalRate($totalRate);

                    $response["result"][] = [
                        "name" => $vehicleCategory->getName(),
                        "rate" => $vehicleCategory->getRate(),
                        "id_vehicle" => $vehicle->getId(),
                        "plate" => $vehicle->getPlate(),
                        "data_entry" => $vehicleEntry->getDate_entry(),
                        "data_exit" => $vehicleExit->getDate_exit(),
                        "length_of_stay" => "$hours hours and $minutes minutes",
                        "total_rate" => "R$ ".$vehicle->getTotalRate()
                    ];
                }
            } else {
                $response["error"] = "No data found";
            }

        } catch (PDOException $e){
            $response["error"] = $e->getMessage();
        }
        return $response;
    }


    

}
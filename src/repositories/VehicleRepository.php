<?php
namespace src\repositories;

use Exception;
use PDOException;
use PDO;
use src\config\Database;
use src\entities\Vehicle;
use src\entities\VehicleEntry;
use src\entities\VehicleExit;

class VehicleRepository {

    function save(Vehicle $vehicle){

        try{
            $pdo = Database::getConection();

            $sql = $pdo->prepare("INSERT INTO vehicles (id_vehicle_category, plate) VALUES (:idVehicleCategory, :plate)");
            $sql->bindValue(":idVehicleCategory", $vehicle->getIdVehicleCategory());
            $sql->bindValue(":plate", $vehicle->getPlate());

            if($sql->execute()){
                $vehicle->setId($pdo->lastInsertId());

                $response["result"] = [
                    "id" => $vehicle->getId(),
                    "idVehicleCategory" => $vehicle->getIdVehicleCategory(),
                    "plate" => $vehicle->getPlate()
                ];
                return $response;

            } else{
                throw new PDOException("Failed to insert data into the database.");
            }

        } catch (PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }


    function saveVehicleEntry(VehicleEntry $vehicleEntry){

        try{
            $pdo = Database::getConection();

            $sql = $pdo->prepare("INSERT INTO entries (date_entry, id_vehicle) VALUES (:date_entry, :id_vehicle)");
            $sql->bindValue(":id_vehicle", $vehicleEntry->getId_vehicle());
            $sql->bindValue(":date_entry", $vehicleEntry->getDate_entry());
            
            if($sql->execute()){
                $vehicleEntry->setId($pdo->lastInsertId());

                $response["result"] = [
                    "id" => $vehicleEntry->getId(),
                    "date_entry" => $vehicleEntry->getDate_entry(),
                    "id_vehicle" => $vehicleEntry->getId_vehicle()
                ];
                return $response;
            }else{
                throw new PDOException("Failed to insert data into the database.");
            }

        } catch(PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }


    function vehicleExists($id_vehicle){

        try{
            $pdo = Database::getConection();

            $sql = $pdo->prepare("SELECT * FROM vehicles WHERE id = :id_vehicle");
            $sql->bindValue(":id_vehicle", $id_vehicle);
            $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }
            return false;

        } catch (PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }


    function verifyVehicle($id_vehicle){

        try{
            $pdo = Database::getConection();

            $sql = $pdo->prepare("SELECT active FROM entries WHERE id_vehicle = :id_vehicle AND active = true");
            $sql->bindValue(":id_vehicle", $id_vehicle);
            $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }

        } catch (PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }


    function updateVehicleEntry($id_vehicle){

        try{
            $pdo = Database::getConection();
            
            $sql = $pdo->prepare("UPDATE entries SET active = :active WHERE id_vehicle = :id_vehicle AND active = false");
            $sql->bindValue(":active", true);
            $sql->bindValue(":id_vehicle", $id_vehicle);
            $sql->execute();

        } catch(PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }



    function saveVehicleExit(VehicleExit $vehicleExit){

        try{
            $pdo = Database::getConection();

            $sql = $pdo->prepare("INSERT INTO exits (date_exit, id_vehicle) VALUES (:date_exit, :id_vehicle)");
            $sql->bindValue(":id_vehicle", $vehicleExit->getId_vehicle());
            $sql->bindValue(":date_exit", $vehicleExit->getDate_exit());

            if($sql->execute()){
                $vehicleExit->setId($pdo->lastInsertId());

                $response["result"] = [
                    "id" => $vehicleExit->getId(),
                    "date_exit" => $vehicleExit->getDate_exit(),
                    "id_vehicle" => $vehicleExit->getId_vehicle()
                ];
                return $response;
            } else {
                throw new PDOException("Failed to insert data into the database.");
            }

        } catch(PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }


    function updateVehicleExit($id_vehicle){

        try{
            $pdo = Database::getConection();

            $sql = $pdo->prepare("UPDATE entries SET active = false WHERE id_vehicle = :id_vehicle AND active = true");
            $sql->bindValue(":id_vehicle", $id_vehicle);
            $sql->execute();

        } catch (PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }


    function getAllVehicles(){

        try{
            $pdo = Database::getConection();

            $sql = $pdo->query("SELECT v.id as id_vehicle,vc.name as name,vc.rate as rate,v.plate as plate,e.date_entry as date_entry,MIN(x.date_exit) as date_exit
                                FROM vehicle_category vc JOIN vehicles v ON v.id_vehicle_category = vc.id JOIN 
                                (SELECT id_vehicle,date_entry FROM entries WHERE date_entry IS NOT NULL GROUP BY id_vehicle,date_entry) e ON e.id_vehicle = v.id
                                LEFT JOIN exits x ON x.id_vehicle = v.id AND x.date_exit > e.date_entry
                                GROUP BY v.id,vc.name,vc.rate,v.plate,e.date_entry");
            
            if($sql->rowCount() > 0){
                $response["result"] = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $response;
            }

        } catch (PDOException $e){
            throw new PDOException($e->getMessage());
        }

    }

}
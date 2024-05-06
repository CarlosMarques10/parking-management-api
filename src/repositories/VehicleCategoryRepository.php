<?php
namespace src\repositories;

use Exception;
USE PDO;
use PDOException;
use src\config\Database;
use src\entities\VehicleCategory;

class VehicleCategoryRepository{

    function save(VehicleCategory $vehicleCategory){
         
       try{
        $pdo = Database::getConection();

        $sql = $pdo->prepare("INSERT INTO vehicle_category (name, rate) VALUES (:name, :rate)");
        $sql->bindValue(":name", $vehicleCategory->getName());
        $sql->bindValue(":rate", $vehicleCategory->getRate());
        
        if($sql->execute()){
            $vehicleCategory->setId($pdo->lastInsertId());

            $response["result"] = [
                "id" => $vehicleCategory->getId(),
                "name" => $vehicleCategory->getName(),
                "rate" => $vehicleCategory->getRate()
            ];
            return $response;
        }else{
            throw new PDOException("Failed to insert data into the database.");
        }

       }catch (PDOException $e){
            throw new PDOException($e->getMessage());
       }
    }

    function exists($name){
        try{
            $pdo = Database::getConection();

            $sql = $pdo->prepare("SELECT * FROM vehicle_category WHERE name = :name");
            $sql->bindValue(":name", $name);
            $sql->execute();

            if($sql->rowCount() > 0){
                return true;
            }
            return false;

        } catch (Exception $e){
            throw new PDOException($e->getMessage());
        }
    }


    function getAll(){
      
        try{
            $pdo = Database::getConection();
            
            $sql = $pdo->query("SELECT * FROM vehicle_category");
            
            if($sql->rowCount() > 0){
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($data as $category){
                    $vehicleCategory = new VehicleCategory();
                    $vehicleCategory->setId($category["id"]);
                    $vehicleCategory->setName($category["name"]);
                    $vehicleCategory->setRate($category["rate"]);
                    
                    $response["result"][] = [
                        "id" => $vehicleCategory->getId(),
                        "name" => $vehicleCategory->getName(),
                        "rate" => $vehicleCategory->getRate()
                    ];
                }
                
                
            }else {
                $response["error"] = "No categories registered";
            }
            return $response;

        } catch (PDOException $e){
            throw new PDOException($e->getMessage());
        }
    }




}
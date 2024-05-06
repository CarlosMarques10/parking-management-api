<?php
namespace src\controllers;

use Exception;
use src\controllers\handlers\JsonResponse;
use src\controllers\handlers\MethodHandler;
use src\services\VehicleService;

class VehicleController {

    static function insert(){
        $response = ["result" => [], "error" => []];

        try{
            if(MethodHandler::verifyMethod("POST")){
                $response = VehicleService::insert();
            }

        } catch(Exception $e){
            $response["error"] = $e->getMessage();
        }
        JsonResponse::returnJson($response);
    }


    static function insertVehicleEntry(){
        $response = ["result" => [], "error" => []];

        try{
            if(MethodHandler::verifyMethod("POST")){
                $response = VehicleService::insertVehicleEntry();
            }

        } catch (Exception $e){
            $response["error"] = $e->getMessage();
        }
        JsonResponse::returnJson($response);
    }


    static function insertVehicleExit(){
        $response = ["result" => [], "error" => []];

        try{
            if(MethodHandler::verifyMethod("POST")){
                $response = VehicleService::insertVehicleExit();
            }

        } catch(Exception $e){
            $response["error"] = $e->getMessage();
        }
        JsonResponse::returnJson($response);
    }


    static function findAllVehicles(){
        $response = ["result" => [], "error" => []];

        try{
            if(MethodHandler::verifyMethod("GET")){
                $response = VehicleService::findAllVehicles();
            }

        } catch (Exception $e){
            $response["error"] = $e->getMessage();
        }
        JsonResponse::returnJson($response);
    }

    
}
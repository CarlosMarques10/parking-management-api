<?php
namespace src\controllers;
require "../vendor/autoload.php";

use Exception;
use src\controllers\handlers\MethodHandler;
use src\controllers\handlers\JsonResponse;
use src\services\VehicleCategoryService;

class VehicleCategoryController {


    static function insert(){
        $response = ["result" => [], "error" => []];

        try{
            if(MethodHandler::verifyMethod("POST")){
                $response = VehicleCategoryService::insert(); 
            }

        }catch (Exception $e){
            $response["error"] = $e->getMessage();
        }
        JsonResponse::returnJson($response);
    }


    static function findAll(){
        $response = ["result" => [], "error" => []];

        try{
            if(MethodHandler::verifyMethod("GET")){
                $response = VehicleCategoryService::findAll();
            }

        } catch (Exception $e){
            $response["error"] = $e->getMessage();
        }
        JsonResponse::returnJson($response);
    }


}
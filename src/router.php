<?php
require "../vendor/autoload.php";
use src\controllers\VehicleCategoryController;
use src\controllers\VehicleController;

$acao = $_REQUEST["acao"];

switch ($acao){
    case "insertCategory":
        VehicleCategoryController::insert();
    break;
    case "findAllCategory":
        VehicleCategoryController::findAll();
    break;
    case "insertVehicle":
        VehicleController::insert();
    break;
    case "insertVehicleEntry":
        VehicleController::insertVehicleEntry();
    break;
    case "insertVehicleExit":
        VehicleController::insertVehicleExit();
    break;
    case "findAllVehicles":
        VehicleController::findAllVehicles();
    break;
    default:
        echo json_encode("Invalid route");
    break;
}
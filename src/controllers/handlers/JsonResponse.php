<?php
namespace src\controllers\handlers;

class JsonResponse {

    static function returnJson($response){
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($response);
        exit;
    }

}
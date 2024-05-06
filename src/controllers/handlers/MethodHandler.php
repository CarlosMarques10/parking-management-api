<?php
namespace src\controllers\handlers;

use Exception;

class MethodHandler {

    static function verifyMethod($method){

        $methodRequest = $_SERVER["REQUEST_METHOD"];
            if($methodRequest != $method){
                throw new Exception("Invalid request method");
                return false;
            } 
        return true;
    }

}

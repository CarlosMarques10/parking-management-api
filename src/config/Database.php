<?php
namespace src\config;
use Exception;
use PDO;

class Database{
    static function getConection(){

        try {
            CaptureEnv::loadEnv(); 
    
            $dbHost = getenv('DB_HOST');
            $dbPort = getenv('DB_PORT');
            $dbName = getenv('DB_DATABASE');
            $dbUser = getenv('DB_USERNAME');
            $dbPass = getenv('DB_PASSWORD');

            $pdo = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e) {
            echo "Erro na conexão: " . $e->getMessage();
        }
    }


}
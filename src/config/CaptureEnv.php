<?php
namespace src\config;
use Exception;

class CaptureEnv {
  
    static function loadEnv(){

        $envFile = __DIR__ . '/../../.env';

        if (file_exists($envFile)) {
            $envContent = file_get_contents($envFile);
            $lines = explode("\n", $envContent);

            foreach ($lines as $line) {
                if (!empty($line) && strpos($line, '#') !== 0) {
                    $pair = explode('=', $line, 2);
                    if (count($pair) === 2) {
                        list($name, $value) = $pair;
                        $name = trim($name);
                        $value = trim($value, " \t\n\r\0\x0B\"'");
                        putenv("$name=$value");
                    } else {
                        throw new Exception("Formato inválido no arquivo .env: $line");
                    }
                }
            }
        } else {
            throw new Exception("Arquivo .env não encontrado.");
        }
    }

}
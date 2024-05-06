<?php
namespace src\services;

use Exception;
use DateTime;

class FormatDate {

    static function format($date){
        
        $formatoEntrada = 'd-m-Y H:i';
        $dateTime = DateTime::createFromFormat($formatoEntrada, $date);

        if (!$dateTime) {
            throw new Exception('Invalid date format. Fill in the format d-m-Y H:i');
        }

        return $dateTime->format('Y-m-d H:i');
    }


}
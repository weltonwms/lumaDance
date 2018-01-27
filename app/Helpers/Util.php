<?php

namespace App\Helpers;

use Carbon\Carbon;

class Util {

    public static function dataToMysql($data)
    {
        $dtCarbon = Carbon::createFromFormat('d/m/Y', $data);
        return $dtCarbon->format('Y-m-d');
    }

    public static function moneyToBr($valor)
    {
        if ($valor):
            return "R$ " . number_format($valor, 2, ',', '.');
        endif;
    }

    public static function moneyBrToUsd($valor)
    {

        $valor1 = str_replace(".", "", $valor);
        $valor2 = str_replace(",", ".", $valor1);

        return number_format($valor2, 2,'.','');
    }

}

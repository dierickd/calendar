<?php

namespace App\Calendar;

use Exception;

class Month
{
    /**
     * Month constructor
     * @param int $month Le mois compris entre 1 et 12
     * @param int $year L'année
     * @throws Exception
     */
    public function __construct(int $month, int $year)
    {
        if ($month < 1 || $month > 12) {
            throw new Exception("Le mois $month n'est pas valide");
        }

        if ($year < 1970) {
            throw new Exception("L'année est inférieur à 1970");
        }
    }
}
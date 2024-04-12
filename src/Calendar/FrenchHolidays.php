<?php

namespace App\Calendar;

use DateTime;
use DateTimeZone;
use Exception;

class FrenchHolidays
{
    const DAYLIST = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'Dimanche'];

    public static function getHolidays(?int $year = null, ?bool $alsace_moselle = false): array
    {
        if ($year === null) $year = date('Y');

        $holidayList = [
            self::nouvelAn($year) => "Nouvel an",
            self::dimanchePaques($year) => "Dimanche de Pâques",
            self::lundiPaques($year) => "Lundi de Pâques",
            self::jeudiAscension($year) => "Jeudi de l'ascension",
            self::lundiPentecote($year) => "Lundi de Pentecote",
            self::feteDuTravail($year) => "Fête du travail",
            self::feteNationnale($year) => "Fête nationnale",
            self::victoire1945($year) => "Victoire 1945",
            self::armistice($year) => "L'armistice",
            self::assomption($year) => "L'ssomption",
            self::toussaint($year) => "La toussaint",
            self::noel($year) => "Noel",
        ];

        $saintEtienneList = [
            self::vendrediSaint($year) => "Vendredi Saint",
            self::saintEtienne($year) => "Saint-Etienne",
        ];

        if ($alsace_moselle) {
            $holidayList = array_merge($holidayList, $saintEtienneList);
        }

        ksort($holidayList);
        return $holidayList;
    }

    public static function isHoliday(\DateTime $date, ?bool $alsace_moselle = false): bool
    {
        $d = $date->format('Y-m-d');
        $holidayList = self::getHolidays($date->format('Y'), $alsace_moselle);

        return array_key_exists($d, $holidayList);
    }

    /**
     * @param int|null $year
     * @return string
     * @throws Exception
     */
    public static function dimanchePaques(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        $easter = new DateTime('@' . easter_date($year));
        $easter->setTimezone(new DateTimeZone('Europe/Paris'));
        return $easter->format("Y-m-d");
    }

    /**
     * @param int|null $year
     * @return string
     * @throws Exception
     */
    public static function vendrediSaint(?int $year = null): string
    {
        $dimanche_paques = self::dimanchePaques($year);
        return date("Y-m-d", strtotime("$dimanche_paques -2 days"));
    }

    /**
     * @param int|null $year
     * @return string
     * @throws Exception
     */
    public static function lundiPaques(?int $year = null): string
    {
        $dimanche_paques = self::dimanchePaques($year);
        return date("Y-m-d", strtotime("$dimanche_paques +1 day"));
    }

    /**
     * @param int|null $year
     * @return string
     * @throws Exception
     */
    public static function jeudiAscension(?int $year = null): string
    {
        $dimanche_paques = self::dimanchePaques($year);
        return date("Y-m-d", strtotime("$dimanche_paques +39 days"));
    }

    /**
     * @param int|null $year
     * @return string
     * @throws Exception
     */
    public static function lundiPentecote(?int $year = null): string
    {
        $dimanche_paques = self::dimanchePaques($year);
        return date("Y-m-d", strtotime("$dimanche_paques +50 days"));
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function nouvelAn(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-01-01");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function nouvelAnJourSemaine(?int $year = null): string
    {
        $nouvel_an = date("N", strtotime(self::nouvelAn($year)));
        return self::DAYLIST[$nouvel_an];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function feteDuTravail(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-05-01");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function feteDuTravailJourSemaine(?int $year = null): string
    {
        $fete_du_travail = date("N", strtotime(self::feteDuTravail($year)));
        return self::DAYLIST[$fete_du_travail];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function victoire1945(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-05-08");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function victoire1945JourSemaine(?int $year = null): string
    {
        $victoire_1945 = date("N", strtotime(self::victoire1945($year)));
        return self::DAYLIST[$victoire_1945];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function feteNationnale(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-07-14");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function feteNationnaleJourSemaine(?int $year = null): string
    {
        $fete_nationnale = date("N", strtotime(self::feteNationnale($year)));
        return self::DAYLIST[$fete_nationnale];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function armistice(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-11-11");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function armisticeJourSemaine(?int $year = null): string
    {
        $armistice = date("N", strtotime(self::armistice($year)));
        return self::DAYLIST[$armistice];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function assomption(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-08-15");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function assomptionJourSemaine(?int $year = null): string
    {
        $assomption = date("N", strtotime(self::assomption($year)));
        return self::DAYLIST[$assomption];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function toussaint(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-11-01");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function toussaintJourSemaine(?int $year = null): string
    {
        $toussaint = date("N", strtotime(self::toussaint($year)));
        return self::DAYLIST[$toussaint];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function noel(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-12-25");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function noelJourSemaine(?int $year = null): string
    {
        $noel = date("N", strtotime(self::noel($year)));
        return self::DAYLIST[$noel];
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function saintEtienne(?int $year = null): string
    {
        if ($year === null) $year = date('Y');
        return date("{$year}-12-26");
    }

    /**
     * @param int|null $year
     * @return string
     */
    public static function saintEtienneJourSemaine(?int $year = null): string
    {
        $noel = date("N", strtotime(self::saintEtienne($year)));
        return self::DAYLIST[$noel];
    }
}
<?php

namespace App\Twig\Runtime;

use App\Calendar\FrenchHolidays;
use DateTime;
use Twig\Extension\RuntimeExtensionInterface;

class CalendarExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    /**
     * @param DateTime $date
     * @param int $year
     * @param int $month
     * @return bool
     */
    public function withinMonthFunction(DateTime $date, int $year, int $month): bool
    {
        return (new DateTime("{$year}-{$month}-01"))->format('Y-m') === $date->format('Y-m');
    }

    /**
     * @param int $month
     * @return int
     */
    public function previousMonthFunction(int $month): int
    {
        $month -= 1;
        if ($month < 1) $month = 12;
        return $month;
    }

    /**
     * @param DateTime $date
     * @param bool|null $alsace_moselle
     * @return bool
     */
    public function isHolidayFunction(\DateTime $date, ?bool $alsace_moselle = false): bool
    {
        return FrenchHolidays::isHoliday($date, $alsace_moselle);
    }
}

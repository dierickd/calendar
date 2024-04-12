<?php

namespace App\Calendar;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Calendar extends AbstractController
{
    private int $month;
    private int $year;

    private array $monthName = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
    private array $dayName = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    /**
     * @throws Exception
     */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if (isset($_GET["month"]) && preg_match("/[a-z]/i", $_GET['month'])) {
            throw new Exception("Month in query params is invalid ('" . $_GET["month"] . "')");
        }

        if (isset($_GET["year"]) && preg_match("/[a-z]/i", $_GET['year'])) {
            throw new Exception("Year in query params is invalid ('" . $_GET["year"] . "')");
        }

        $this->month = $month ?? $_GET["month"] ?? intval(date('m'));
        $this->year = $year ?? $_GET["year"] ?? intval(date('Y'));
    }

    /**
     * @throws Exception
     */
    public function renderCalendar(): array
    {
        $this->getMonth();
        $day = $this->getStartingDay()->format("N");
        return [
            "generate" => $this->renderView('calendar/calendar.html.twig', [
                'weeks' => $this->getWeeks(),
                'dayNames' => $this->dayName,
                'start' => $day === '1' ? $this->getStartingDay() : $this->getStartingDay()->modify('last monday'),
                'year' => $this->year,
                'month' => $this->month,
                'title' => $this->toString(),
                'previous' => ['month' => $this->previousMonth()->month, 'year' => $this->previousMonth()->year],
                'next' => ['month' => $this->nextMonth()->month, 'year' => $this->nextMonth()->year],
            ]),
        ];
    }

    /**
     * @return void
     */
    private function getMonth(): void
    {
        if ($this->month < 1) {
            $this->month = 12;
            $this->year -= 1;
        }
        if ($this->month > 12) {
            $this->month = 1;
            $this->year += 1;
        }
    }

    /**
     * return le mois et l'année ex: mars 2024
     * @return string
     */
    private function toString(): string
    {
        return $this->monthName[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * return le nombre de semaine dans un mois
     * @return int
     */
    private function getWeeks(): int
    {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $weeks = intval($end->format('W')) - intval($start->format('W'));

        if ($weeks < 0) {
            $weeks = intval($end->format('W'));
        } else {
            $weeks += 1;
        }

        if ($weeks === 1) {
            $lastSunday = $end->modify('last sunday');
            $weeks = intval($lastSunday->format("W")) + 1 - intval($start->format('W')) + 1;
        }

        return $weeks;
    }

    /**
     * return le premier jour du mois
     * @return DateTime
     */
    public function getStartingDay(): DateTime
    {
        return new DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * @return Calendar
     * @throws Exception
     */
    public function nextMonth(): Calendar
    {
        $month = $this->month + 1;
        $year = $this->year;
        if ($month > 12) {
            $month = 1;
            $year += 1;
        }

        return new Calendar($month, $year);
    }

    /**
     * @return Calendar
     * @throws Exception
     */
    public function previousMonth(): Calendar
    {
        $month = $this->month - 1;
        $year = $this->year;
        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }

        return new Calendar($month, $year);
    }
}
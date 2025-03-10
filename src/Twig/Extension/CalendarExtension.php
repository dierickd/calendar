<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\CalendarExtensionRuntime;
use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CalendarExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('withinMonth', [CalendarExtensionRuntime::class, 'withinMonthFunction']),
            new TwigFilter('previousMonth', [CalendarExtensionRuntime::class, 'previousMonthFunction']),
            new TwigFilter('isHoliday', [CalendarExtensionRuntime::class, 'isHolidayFunction']),
        ];
    }

//    public function getFunctions(): array
//    {
//        return [
//            new TwigFunction('function_name', [CalendarExtensionRuntime::class, 'doSomething']),
//        ];
//    }
}

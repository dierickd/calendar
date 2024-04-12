<?php

namespace App\Controller;

use App\Calendar\Calendar;
use App\Repository\ConfigRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    /**
     * @param Calendar $calendar
     * @param ConfigRepository $configRepository
     * @return Response
     * @throws Exception
     */
    #[Route('/', name: 'app_home')]
    public function index(Calendar $calendar, ConfigRepository $configRepository): Response
    {
        $cfg = $configRepository->findAll();
        dump($cfg);

        $date = new \DateTimeImmutable();
        $date->format("Y");

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "calendar" => $calendar->renderCalendar(),
        ]);
    }
}

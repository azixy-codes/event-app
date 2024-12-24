<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\Event1Type;
use App\Repository\EventRepository;
use App\Service\DistanceCalculatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name: 'events.')]
final class EventController extends AbstractController
{
    public function __construct(private DistanceCalculatorService $distanceCalculatorService)
    {

    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Request $request, Event $event): Response
    {

        $participantsWithDistances = [];

        $lat = $request->get('lat');
        $long = $request->get('long');

        if ($lat && $long) {
            $guestDistance = $this->distanceCalculatorService->calculateDistance(
                $event->getLocationLat(),
                $event->getLocationLong(),
                $lat,
                $long
            );

            $this->addFlash('success', message: 'Vous êtes à ' . $guestDistance . ' Km de l\'évenement');
        }


        foreach ($event->getParticipants() as $participant) {

            $distance = $this->distanceCalculatorService->calculateDistance(
                $event->getLocationLat(),
                $event->getLocationLong(),
                $participant->getAddressLat(),
                $participant->getAddressLong()
            );

            $participantsWithDistances[] = [
                'user' => $participant,
                'distance' => $distance,
            ];
        }

        return $this->render('event/show.html.twig', [
            'event' => $event,
            'participantsWithDistances' => $participantsWithDistances
        ]);
    }
}

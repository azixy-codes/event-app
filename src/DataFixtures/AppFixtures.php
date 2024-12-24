<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $events = [
            [
                'name' => 'Lyon Jazz Festival',
                'date' => new \DateTime('2025-03-15'),
                'address' => 'Parc de la Tête d\'Or, Lyon, France',
                'latitude' => 45.7763,
                'longitude' => 4.8365,
            ],
            [
                'name' => 'Paris Foodies\' Night Market',
                'date' => new \DateTime('2025-04-20'),
                'address' => '50 Quai de la Gare, Paris, France',
                'latitude' => 48.8353,
                'longitude' => 2.3765,
            ],
            [
                'name' => 'Marseille Film Fest',
                'date' => new \DateTime('2025-05-10'),
                'address' => 'Théâtre Silvain, 13007 Marseille, France',
                'latitude' => 43.2842,
                'longitude' => 5.3561,
            ],
            [
                'name' => 'Bordeaux Wine Tasting Gala',
                'date' => new \DateTime('2025-06-08'),
                'address' => 'Place de la Bourse, Bordeaux, France',
                'latitude' => 44.8411,
                'longitude' => -0.5693,
            ],
            [
                'name' => 'Toulouse Aerospace Expo',
                'date' => new \DateTime('2025-07-25'),
                'address' => '6 Rue de Sébastopol, Toulouse, France',
                'latitude' => 43.6047,
                'longitude' => 1.4442,
            ]
        ];

        $eventsArr = [];

        foreach ($events as $eventData) {
            $event = new Event();
            $event->setName($eventData['name']);
            $event->setDate($eventData['date']);
            $event->setAddress($eventData['address']);
            $event->setLocationLat($eventData['latitude']);
            $event->setLocationLong($eventData['longitude']);

            $manager->persist($event);
            $eventsArr[] = $event;
        }

        $participantsData = [
            ['name' => 'Alice Dupont', 'email' => 'alice.dupont@example.com', 'latitude' => 48.8566, 'longitude' => 2.3522],
            ['name' => 'Jean Moreau', 'email' => 'jean.moreau@example.com', 'latitude' => 45.7640, 'longitude' => 4.8357],
            ['name' => 'Marie Curie', 'email' => 'marie.curie@example.com', 'latitude' => 43.7102, 'longitude' => 7.2620],
            ['name' => 'Paul Bernard', 'email' => 'paul.bernard@example.com', 'latitude' => 50.6292, 'longitude' => 3.0573],
            ['name' => 'Sophie Martin', 'email' => 'sophie.martin@example.com', 'latitude' => 43.6047, 'longitude' => 1.4442],
            ['name' => 'Claire Fontaine', 'email' => 'claire.fontaine@example.com', 'latitude' => 47.2184, 'longitude' => -1.5536],
            ['name' => 'Antoine Lemoine', 'email' => 'antoine.lemoine@example.com', 'latitude' => 44.8378, 'longitude' => -0.5792],
            ['name' => 'Julie Petit', 'email' => 'julie.petit@example.com', 'latitude' => 48.5734, 'longitude' => 7.7521],
            ['name' => 'Thomas Blanc', 'email' => 'thomas.blanc@example.com', 'latitude' => 43.2951, 'longitude' => 5.3612],
            ['name' => 'Elodie Durand', 'email' => 'elodie.durand@example.com', 'latitude' => 43.6108, 'longitude' => 3.8767],
            ['name' => 'Lucas Garnier', 'email' => 'lucas.garnier@example.com', 'latitude' => 45.7640, 'longitude' => 4.8357],
            ['name' => 'Emma Lambert', 'email' => 'emma.lambert@example.com', 'latitude' => 43.2965, 'longitude' => 5.3698],
            ['name' => 'Noah Roche', 'email' => 'noah.roche@example.com', 'latitude' => 48.8566, 'longitude' => 2.3522],
            ['name' => 'Léa Fabre', 'email' => 'lea.fabre@example.com', 'latitude' => 50.6292, 'longitude' => 3.0573],
            ['name' => 'Hugo Perrin', 'email' => 'hugo.perrin@example.com', 'latitude' => 43.7102, 'longitude' => 7.2620],
            ['name' => 'Chloé Girard', 'email' => 'chloe.girard@example.com', 'latitude' => 44.8378, 'longitude' => -0.5792],
            ['name' => 'Louis Lefevre', 'email' => 'louis.lefevre@example.com', 'latitude' => 47.2184, 'longitude' => -1.5536],
            ['name' => 'Isabelle Simon', 'email' => 'isabelle.simon@example.com', 'latitude' => 48.5734, 'longitude' => 7.7521],
            ['name' => 'Nathan Robert', 'email' => 'nathan.robert@example.com', 'latitude' => 45.7640, 'longitude' => 4.8357],
            ['name' => 'Manon Charpentier', 'email' => 'manon.charpentier@example.com', 'latitude' => 43.2951, 'longitude' => 5.3612],
        ];

        foreach ($participantsData as $participantData) {
            $participant = new Participant();
            $participant->setName($participantData['name']);
            $participant->setEmail($participantData['email']);
            $participant->setAddressLat($participantData['latitude']);
            $participant->setAddressLong($participantData['longitude']);

            // Randomly assign an event
            $event = $eventsArr[array_rand($eventsArr)];
            $participant->addEvent($event);

            $manager->persist($participant);
        }

        $manager->flush();
    }
}

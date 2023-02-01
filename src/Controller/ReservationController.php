<?php

namespace App\Controller;

use App\Entity\Time;
use App\Form\TimerType;
use App\Repository\TimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservation')]
    public function index(TimeRepository $timeRepository): Response
    {
        $reservations = $timeRepository->findAll();

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations
        ]);
    }

    #[Route('/ajouterreservation', name: 'app_reservation_add')]
    public function addReserve(Request $request, EntityManagerInterface $entityManager, TimeRepository $timeRepository): Response
    {


        $timeReservations = $timeRepository->findAll();

        $reservations = new Time();
        $form = $this->createForm(TimerType::class, $reservations);
        $form->handleRequest($request);
        // 5400s = 1h30 en Timestamp
        $gameTime = 5300;


        if ($form->isSubmitted() && $form->isValid()) {

            $form->getData();
            // On Récupère la date et l'heure et on le formate en timeStamp 3600 correspond au chgmt horaire
            $hourTimestampPlayerChoice = $reservations->getHour()->getTimestamp() + 3600;
            $dateTimestampPlayerChoice = $reservations->getDate()->getTimestamp();
            // On additionne les 2 pour récupérer le temps de début et on déduis le temps de l'équipe précédente et on ajoute le temps de jeux pour récupérer le temps de fin

            $startPlay = $hourTimestampPlayerChoice + $dateTimestampPlayerChoice;
            $endPlay = $startPlay + $gameTime;
            $endPlayDateTime = date('Y-m-d H:i:s', $endPlay);
            $startPlayDateTime = date('Y-m-d H:i:s', $startPlay);

            //dd($endPlayDateTime);
            $existingReservations = $entityManager->createQuery(
                "SELECT r FROM App:Time r
                WHERE r.startplay BETWEEN :start AND :end
                OR r.endplay BETWEEN :start AND :end"
            )->setParameter('start', $startPlayDateTime)
                ->setParameter('end', $endPlayDateTime)
                ->getResult();



            if (!empty($existingReservations)) {
                $this->addFlash('danger', 'Créneau horaire non disponible.');
                return $this->redirectToRoute('app_reservation_add');
            }

            $reservations->setStartplay(new \DateTime($startPlayDateTime))
                ->setEndplay(new \DateTime($endPlayDateTime));


            $entityManager->persist($reservations);
            $entityManager->flush();

            $this->addFlash('success', 'Réservation enregistré avec succès.');

            return $this->redirectToRoute('app_reservation_add');

        };

        return $this->render('reservation/add.html.twig', [
            'reservationForm' => $form->createView(),
            'timeReservations' =>  $timeReservations
        ]);
    }
}

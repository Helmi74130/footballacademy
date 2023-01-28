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
    public function addReserve(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservations = new Time();
        $form = $this->createForm(TimerType::class, $reservations);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $entityManager->persist($reservations);
            $entityManager->flush();

            $this->addFlash('success', 'Réservation enregistré avec succès.');

            return $this->redirectToRoute('app_home');

        };

        return $this->render('reservation/add.html.twig', [
            'reservationForm' => $form->createView(),
        ]);
    }
}

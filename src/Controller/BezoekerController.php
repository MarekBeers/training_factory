<?php


namespace App\Controller;

use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BezoekerController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function homePage()
    {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route ("/contact", name="contact")
     */
    public function contactPage()
    {
        return $this->render('pages/contact.html.twig');
    }

    /**
     * @Route ("/trainingaanbod", name="trainingaanbod")
     */
    public function trainingaanbodPage(TrainingRepository $trainingRepository): Response
    {
        return $this->render('pages/trainingaanbod.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/inschrijven", name="inschrijven")
     */
    public function inschrijvenOverzicht(TrainingRepository $trainingRepository): Response
    {
        return $this->render('pages/inschrijven.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }


}
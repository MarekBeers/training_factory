<?php


namespace App\Controller;

use App\Entity\user;
use App\Form\UserType;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
     * @Route ("/lidworden", name="lidworden")
     */
     public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new user();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('pages/lidworden.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/regels", name="regels")
     */
    public function regelsPage()
    {
        return $this->render('pages/regels.html.twig');
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
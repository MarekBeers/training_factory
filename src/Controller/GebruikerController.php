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

/**
 * @Route("/user", name="user")
 */
class GebruikerController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function homePage()
    {
        return $this->render('pages/home.html.twig');
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

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, user $user, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $this->addFlash('success', 'section.backoffice.users.edit_roles.confirmation');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
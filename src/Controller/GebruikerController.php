<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\user;
use App\Form\UserType;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
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
    public function inschrijvenPage(LessonRepository $lessonRepository): Response
    {
        return $this->render('gebruiker/inschrijven.html.twig', [
            'lessons' => $lessonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/inschrijvenoverzicht", name="inschrijvenoverzicht")
     */
    public function inschrijvenOverzicht(RegistrationRepository $registrationRepository): Response
    {
        return $this->render('gebruiker/overzichtinschrijven.html.twig', [
            'registrations' => $registrationRepository->findAll(),
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

            return $this->redirectToRoute('userhome');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inschrijven/{id}" , name="app_nu_inschrijvingen")
     */
    public function inschrijvenLesson($id)
    {
        $les = $this->getDoctrine()
            ->getRepository(Lesson::class)
            ->find($id);

        $user=$this->getUser();

        $registration=new Registration();
        $registration->setLessonId($les);
        $registration->setUser($user);
        $registration->setPayment(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($registration);
        $entityManager->flush();

//        return $this->render('pages/home.html.twig', [
//            'page_name' => 'app_latere_inschrijvingen'
//        ]);
        return $this->redirectToRoute('userinschrijven');
    }
}
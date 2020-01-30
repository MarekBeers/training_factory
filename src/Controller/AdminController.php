<?php


namespace App\Controller;

use App\Entity\training;
use App\Entity\user;
use App\Form\TrainingType;
use App\Form\UserType;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('admin/home.html.twig');
    }

    /**
     * @Route("/training/", name="training_index", methods={"GET"})
     */
    public function indextraining(TrainingRepository $trainingRepository): Response
    {
        return $this->render('training/index.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }



    /**
     * @Route("/training/new", name="training_new", methods={"GET","POST"})
     */
    public function newtraining(Request $request): Response
    {
        $training = new training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form['brochure']->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $training->setBrochureFilename($newFilename);

            }

            // ... persist the $product variable or any other work

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('admintraining_index');
        }

        return $this->render('training/new.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/{id}", name="training_show", methods={"GET"})
     */
    public function showtraining(training $training): Response
    {
        return $this->render('training/show.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/training/{id}/edit", name="training_edit", methods={"GET","POST"})
     */
    public function edittraining(Request $request, training $training): Response
    {
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admintraining_index');
        }

        return $this->render('training/edit.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/{id}", name="training_delete", methods={"DELETE"})
     */
    public function deletetraining(Request $request, training $training): Response
    {
        if ($this->isCsrfTokenValid('delete'.$training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admintraining_index');
    }

    /**
     * @Route("/user/instructeurs", name="instructeurs", methods={"GET"})
     */
    public function instructeurs(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/gebruikers", name="user_index", methods={"GET"})
     */
    public function indexuser(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/new", name="user_new", methods={"GET","POST"})
     */
    public function newuser(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new user();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = array('ROLE_USER');
            $user->setRoles($role);
            $user->setStatus(true);
            $entityManager = $this->getDoctrine()->getManager();
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('adminuser_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/newinstructeur", name="instructeur_new", methods={"GET","POST"})
     */
    public function newinstructeuruser(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new user();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = array('ROLE_INSTRUCTEUR');
            $user->setRoles($role);
            $user->setStatus(true);
            $entityManager = $this->getDoctrine()->getManager();
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admininstructeurs');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     */
    public function showuser(user $user, RegistrationRepository $registrationRepository, LessonRepository $lessonRepository): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'registrations' => $registrationRepository->findAll(),
            'lessons' => $lessonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edituser(Request $request, user $user, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $this->addFlash('success', 'section.backoffice.users.edit_roles.confirmation');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminuser_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     */
    public function deleteuser(Request $request, user $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adminuser_index');
    }

    /**
     * @Route("/user/{id}/disable", name="user_disable", methods={"DISABLE"})
     */
    public function userDisable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setStatus(false);
        $entityManager->flush();
        return $this->redirectToRoute('adminuser_show', ['id'=>$user->getId()]);
    }

    /**
     * @Route("/user/{id}/enable", name="user_enable", methods={"ENABLE"})
     */
    public function userEnable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setStatus(true);
        $entityManager->flush();
        return $this->redirectToRoute('adminuser_show', ['id'=>$user->getId()]);
    }

    /**
     * @Route("/user/{id}/disable", name="instructeur_disable", methods={"DISABLE"})
     */
    public function instructeurDisable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setStatus(false);
        $entityManager->flush();
        return $this->redirectToRoute('adminuser_show', ['id'=>$user->getId()]);
    }

    /**
     * @Route("/user/{id}/enable", name="instructeur_enable", methods={"ENABLE"})
     */
    public function instructeurEnable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setStatus(true);
        $entityManager->flush();
        return $this->redirectToRoute('adminuser_show', ['id'=>$user->getId()]);
    }
}
<?php


namespace App\Controller;

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
    public function trainingaanbodPage()
    {
        return $this->render('pages/trainingaanbod.html.twig');
    }

    /**
     * @Route ("/inschrijven", name="inschrijven")
     */
    public function inschrijvenPage()
    {
        return $this->render('pages/inschrijven.html.twig');
    }

    /**
     * @Route ("/login", name="login")
     */
    public function loginPage()
    {
        return $this->render('pages/login.html.twig');
    }
}
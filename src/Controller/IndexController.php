<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Extra\TwigExtraBundle\TwigExtraBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

final class IndexController extends AbstractController
{
    #[Route('/Accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/Admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('pages/admin.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/User', name: 'app_user')]
    public function user(): Response
    {
        return $this->render('pages/user.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/Employee', name: 'app_employee')]
    public function employee(): Response
    {
        return $this->render('pages/employee.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/SaisirCovoiturage', name: 'app_saisir_covoiturage')]
    public function saisirCovoiturage(): Response
    {
        return $this->render('pages/saisirCovoiturage.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/MesCovoiturages', name: 'app_mes_covoiturages')]
    public function mesCovoiturages(): Response
    {
        return $this->render('pages/mesCovoiturages.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    
    #[Route('/Connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('pages/connexion.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/Create', name: 'app_create_user')]
    public function createUser(): Response
    {
        return $this->render('pages/create.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/Contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/MentionsLegales', name: 'app_mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('pages/mentionsLegales.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
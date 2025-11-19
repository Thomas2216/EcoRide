<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Extra\TwigExtraBundle\TwigExtraBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;

final class IndexController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('pages/admin.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/user', name: 'app_user')]
    public function user(): Response
    {
        return $this->render('pages/user.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/mesreservations', name: 'app_mes_reservations')]
    public function mesReservations(): Response
    {
        return $this->render('pages/mesreservations.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/employee', name: 'app_employee')]
    public function employee(): Response
    {
        return $this->render('pages/employee.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/saisircovoiturage', name: 'app_saisir_covoiturage')]
    public function saisirCovoiturage(): Response
    {
        return $this->render('pages/saisircovoiturage.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/mescovoiturages', name: 'app_mes_covoiturages')]
    public function mesCovoiturages(): Response
    {
        return $this->render('pages/mescovoiturages.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    
    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('pages/connexion.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/create', name: 'app_create_user')]
    public function createUser(): Response
    {
        return $this->render('pages/create.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/mentionslegales', name: 'app_mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('pages/mentionslegales.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
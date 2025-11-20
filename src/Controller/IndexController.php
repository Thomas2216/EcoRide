<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/')]
final class IndexController extends AbstractController
{
    #[Route('accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('pages/index.html.twig');
    }

    #[Route('admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function admin(): Response
    {
        return $this->render('pages/admin.html.twig');
    }

    #[Route('user', name: 'app_user')]
    #[IsGranted('ROLE_USER')]
    public function user(): Response
    {
        return $this->render('pages/user.html.twig');
    }

    #[Route('employee', name: 'app_employee')]
    #[IsGranted('ROLE_EMPLOYEE')]
    public function employee(): Response
    {
        return $this->render('pages/employee.html.twig');
    }

    #[Route('saisircovoiturage', name: 'app_saisir_covoiturage')]
    #[IsGranted('ROLE_USER')]
    public function saisirCovoiturage(): Response
    {
        return $this->render('pages/saisircovoiturage.html.twig');
    }

    #[Route('mescovoiturages', name: 'app_mes_covoiturages')]
    #[IsGranted('ROLE_USER')]
    public function mesCovoiturages(): Response
    {
        return $this->render('pages/mescovoiturages.html.twig');
    }

    #[Route('connexion', name: 'app_connexion')]
    public function connexion(): Response
    {
        return $this->render('pages/connexion.html.twig');
    }

    #[Route('create', name: 'app_create_user')]
    public function createUser(): Response
    {
        return $this->render('pages/create.html.twig');
    }

    #[Route('contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }

    #[Route('mentionslegales', name: 'app_mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('pages/mentionslegales.html.twig');
    }
}

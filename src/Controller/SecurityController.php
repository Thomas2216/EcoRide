<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_connexion', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_connexion_redirect');
        }

        // Erreur éventuelle
        $error = $authenticationUtils->getLastAuthenticationError();
        // Dernier email saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('pages/connexion.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new \LogicException('Logout handled by Symfony firewall.');
    }

    #[Route('/connexion/redirect', name: 'app_connexion_redirect')]
    public function redirectAfterLogin(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        }

        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return $this->redirectToRoute('app_employee');
        }

        return $this->redirectToRoute('app_user');
    }
}

<?php

namespace App\Controller;

use Symfony\Entity\User;
use Symfony\EntityManager\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Config\package\Security\AccessControlConfig;


class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_connexion')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $email = $authenticationUtils->getLastUsername();

        return $this->render('pages/connexion.html.twig', [
            'email' => $email,
            'error' => $error,
        ]);

        if ($this->getRole() === ROLE_ADMIN) {
            return $this->redirectToRoute('pages/admin/html.twig');
        }
        elseif ($this->getRole() === ROLE_EMPLOYEE) {
            return $this->redirectToRoute('pages/employee/html.twig');
        }
        elseif ($this->getRole() === ROLE_USER) {
            return $this->redirectToRoute('pages/user/html.twig');
        }
        else {
            return $this->redirectToRoute('pages/connexion.html.twig');
        }
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

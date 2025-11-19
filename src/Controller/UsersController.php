<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UsersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UsersController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/create', name: 'app_create_user', methods: ['GET', 'POST'])]
    public function create(HttpFoundationRequest $request, EntityManagerInterface $em): Response
    {
        // Crée un nouvel utilisateur
        $user = new User();
        $user->setRoles(['ROLE_USER']); // rôle par défaut

        // Crée le formulaire
        $form = $this->createForm(UsersType::class, $user);
        $form->add('submit', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary'],
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe avant de persister
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $user->getPassword() // le mot de passe en clair saisi dans le formulaire
            );
            $user->setPassword($hashedPassword);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_user');
        }

        return $this->render('pages/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

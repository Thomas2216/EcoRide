<?php

namespace App\Controller;

use App\Form\UsersType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsersController extends AbstractController
{
    #[Route('/create', name: 'app_create_user', methods: ['GET', 'POST'])]
    public function create(HttpFoundationRequest $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UsersType::class);
        $form->add('submit', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_user');
        }

        return $this->render('pages/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

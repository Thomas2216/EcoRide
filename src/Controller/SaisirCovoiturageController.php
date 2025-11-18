<?php

namespace App\Controller;

use App\Form\CovoiturageType;

use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SaisirCovoiturageController extends AbstractController
{
    #[Route('/SaisirCovoiturage', name: 'app_saisir_covoiturage', methods: ['GET', 'POST'])]
    public function create(HttpFoundationRequest $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CovoiturageType::class);
        $form->add('submit', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-primary'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $covoiturage = $form->getData();
            $em->persist($covoiturage);
            $em->flush();

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_covoiturages');
        }
        }

        return $this->render('pages/SaisirCovoiturage.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

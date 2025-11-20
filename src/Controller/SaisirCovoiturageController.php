<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use App\Form\CovoiturageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SaisirCovoiturageController extends AbstractController
{
    #[Route('/SaisirCovoiturage', name: 'app_saisir_covoiturage', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $covoiturage = new Covoiturage();
        $form = $this->createForm(CovoiturageType::class, $covoiturage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $covoiturage->setConducteur($this->getUser());

            $em->persist($covoiturage);
            $em->flush();

            return $this->redirectToRoute('app_covoiturages');
        }

        return $this->render('pages/SaisirCovoiturage.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

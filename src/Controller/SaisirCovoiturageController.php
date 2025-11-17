<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SaisirCovoiturageController extends AbstractController
{
    #[Route('/SaisirCovoiturage', name: 'app_saisir_covoiturage', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/saisirCovoiturage.html.twig', [
            'covoiturages' => ['SaisirCovoiturageController'],
        ]);
    }
}

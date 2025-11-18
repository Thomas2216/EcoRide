<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Tools\ORMSetup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class CovoituragesController extends AbstractController
{
    #[Route('/covoiturages', name: 'app_covoiturages', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
            $covoiturages = $em->getRepository(Covoiturage::class)->findAll();

            return $this->render('pages/covoiturages.html.twig', [
                'covoiturages' => $covoiturages,],
        );
    }
}

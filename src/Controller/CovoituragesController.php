<?php

namespace App\Controller;

use App\Document\StatVisite;
use App\Service\CovoiturageService;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CovoituragesController extends AbstractController
{
    public function __construct(
        private readonly CovoiturageService $covoiturageService,
    ) {}

    #[Route('/covoiturages', name: 'app_covoiturages', methods: ['GET'])]
    public function index(DocumentManager $dm, Request $request): Response
    {
        $covoiturages = $this->covoiturageService->getCovoituragesDisponibles();

        $stat = new StatVisite(
            new \DateTime(),
            count($covoiturages),
            $request->getClientIp() ?? '0.0.0.0'
        );
        $dm->persist($stat);
        $dm->flush();

        return $this->render('pages/covoiturages.html.twig', [
            'covoiturages' => $covoiturages,
        ]);
    }
}

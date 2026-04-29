<?php

namespace App\Controller;

use App\Document\StatVisite;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminStatsController extends AbstractController
{
    #[Route('/admin/stats', name: 'admin_stats', methods: ['GET'])]
    public function index(DocumentManager $dm): Response
    {
        $stats = $dm->getRepository(StatVisite::class)->findBy([], ['date' => 'DESC'], 50);

        return $this->render('pages/admin_stats.html.twig', [
            'stats' => $stats,
        ]);
    }
}

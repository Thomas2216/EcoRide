<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

final class CovoituragesController extends AbstractController
{
    #[Route('/covoiturages', name: 'app_covoiturages', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/covoiturages.html.twig',
        ['covoiturages' => []]);
}
}

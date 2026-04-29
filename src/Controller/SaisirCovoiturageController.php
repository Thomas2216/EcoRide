<?php

namespace App\Controller;

use App\Entity\Covoiturage;
use App\Entity\User;
use App\Form\CovoiturageType;
use App\Service\CovoiturageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class SaisirCovoiturageController extends AbstractController
{
    public function __construct(
        private readonly CovoiturageService $covoiturageService,
    ) {}

    #[Route('/SaisirCovoiturage', name: 'app_saisir_covoiturage', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(CovoiturageType::class, new Covoiturage());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $conducteur */
            $conducteur = $this->getUser();

            /** @var Covoiturage $covoiturage */
            $covoiturage = $form->getData();
            $this->covoiturageService->creerCovoiturage($conducteur, $covoiturage);

            return $this->redirectToRoute('app_covoiturages');
        }

        return $this->render('pages/SaisirCovoiturage.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

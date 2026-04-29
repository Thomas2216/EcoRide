<?php

namespace App\Service;

use App\Entity\Covoiturage;
use App\Entity\User;
use App\Repository\CovoiturageRepository;
use Doctrine\ORM\EntityManagerInterface;

class CovoiturageService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly CovoiturageRepository $covoiturageRepository,
    ) {}

    public function getCovoituragesDisponibles(): array
    {
        return $this->covoiturageRepository->findDisponiblesAvecRelations();
    }

    public function creerCovoiturage(User $conducteur, Covoiturage $covoiturage): Covoiturage
    {
        if ($covoiturage->getStatut() === null) {
            $covoiturage->setStatut('ouvert');
        }

        $covoiturage->setConducteur($conducteur);

        $this->em->persist($covoiturage);
        $this->em->flush();

        return $covoiturage;
    }

    /**
     * Calcule la note moyenne des avis du conducteur du covoiturage.
     * Retourne 0.0 si le covoiturage n'a pas de conducteur ou si celui-ci n'a aucun avis.
     */
    public function calculerNoteMoyenne(Covoiturage $covoiturage): float
    {
        $conducteur = $covoiturage->getConducteur();

        if ($conducteur === null || $conducteur->getAvis()->isEmpty()) {
            return 0.0;
        }

        $avis = $conducteur->getAvis();
        $total = 0;

        foreach ($avis as $unAvis) {
            $total += $unAvis->getNote();
        }

        return round($total / $avis->count(), 1);
    }
}

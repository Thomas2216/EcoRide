<?php

namespace App\Repository;

use App\Entity\Covoiturage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Covoiturage>
 */
class CovoiturageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Covoiturage::class);
    }

    /**
     * Retourne les covoiturages avec au moins 1 place disponible.
     * Charge conducteur, voiture et avis du conducteur en une seule requête (pas de N+1).
     *
     * @return Covoiturage[]
     */
    public function findDisponiblesAvecRelations(): array
    {
        return $this->createQueryBuilder('c')
            ->addSelect('conducteur', 'voiture', 'avis')
            ->leftJoin('c.conducteur', 'conducteur')
            ->leftJoin('c.voiture', 'voiture')
            ->leftJoin('conducteur.avis', 'avis')
            ->where('c.nb_place >= 1')
            ->orderBy('c.date_depart', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

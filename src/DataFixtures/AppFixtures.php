<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use App\Entity\Covoiturage;
use App\Entity\User;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {}

    public function load(ObjectManager $manager): void
    {
        // ----------------------------------------------------------------
        // UTILISATEURS
        // ----------------------------------------------------------------

        $admin = new User();
        $admin->setNom('Dupont')
            ->setPrenom('Alice')
            ->setEmail('admin@ecoride.fr')
            ->setPassword($this->hasher->hashPassword($admin, 'Admin1234!'))
            ->setRoles(['ROLE_ADMIN'])
            ->setTelephone('0600000001')
            ->setAdresse('1 rue de la Paix, Paris')
            ->setDateNaissance(new \DateTime('1985-03-15'))
            ->setPseudo('alice_admin')
            ->setTypeUtilisateur('les_deux');
        $manager->persist($admin);

        $employee = new User();
        $employee->setNom('Martin')
            ->setPrenom('Bob')
            ->setEmail('employe@ecoride.fr')
            ->setPassword($this->hasher->hashPassword($employee, 'Employe1234!'))
            ->setRoles(['ROLE_EMPLOYEE'])
            ->setTelephone('0600000002')
            ->setAdresse('12 avenue des Fleurs, Lyon')
            ->setDateNaissance(new \DateTime('1990-07-22'))
            ->setPseudo('bob_employe')
            ->setTypeUtilisateur('passager');
        $manager->persist($employee);

        $user = new User();
        $user->setNom('Leclerc')
            ->setPrenom('Clara')
            ->setEmail('user@ecoride.fr')
            ->setPassword($this->hasher->hashPassword($user, 'User1234!'))
            ->setRoles(['ROLE_USER'])
            ->setTelephone('0600000003')
            ->setAdresse('5 boulevard du Soleil, Bordeaux')
            ->setDateNaissance(new \DateTime('1995-11-08'))
            ->setPseudo('clara_eco')
            ->setTypeUtilisateur('conducteur');
        $manager->persist($user);

        // ----------------------------------------------------------------
        // VOITURES (rattachées au user classique)
        // ----------------------------------------------------------------

        $voiture1 = new Voiture();
        $voiture1->setMarque('Renault')
            ->setModele('Zoé')
            ->setImmatriculation('AB-123-CD')
            ->setEnergie('Électrique')
            ->setCouleur('Blanche')
            ->setDatePremiereImmatriculation(new \DateTime('2020-06-01'));
        $manager->persist($voiture1);

        $voiture2 = new Voiture();
        $voiture2->setMarque('Peugeot')
            ->setModele('208')
            ->setImmatriculation('EF-456-GH')
            ->setEnergie('Essence')
            ->setCouleur('Grise')
            ->setDatePremiereImmatriculation(new \DateTime('2019-03-15'));
        $manager->persist($voiture2);

        // Associe les deux voitures à Clara (ManyToOne côté User)
        $user->setVoiture($voiture1);

        // ----------------------------------------------------------------
        // COVOITURAGES (créés par Clara, conducteur)
        // ----------------------------------------------------------------

        $cov1 = new Covoiturage();
        $cov1->setLieuDepart('Bordeaux')
            ->setDateDepart(new \DateTime('2026-05-10'))
            ->setHeureDepart(new \DateTime('08:00:00'))
            ->setLieuArrivee('Paris')
            ->setDateArrivee(new \DateTime('2026-05-10'))
            ->setHeureArrivee(new \DateTime('14:30:00'))
            ->setStatut('ouvert')
            ->setNbPlace(3)
            ->setPrixPersonne(25.00)
            ->setConducteur($user)
            ->setVoiture($voiture1);
        $manager->persist($cov1);

        $cov2 = new Covoiturage();
        $cov2->setLieuDepart('Paris')
            ->setDateDepart(new \DateTime('2026-05-15'))
            ->setHeureDepart(new \DateTime('09:00:00'))
            ->setLieuArrivee('Lyon')
            ->setDateArrivee(new \DateTime('2026-05-15'))
            ->setHeureArrivee(new \DateTime('13:00:00'))
            ->setStatut('ouvert')
            ->setNbPlace(2)
            ->setPrixPersonne(18.50)
            ->setConducteur($user)
            ->setVoiture($voiture2);
        $manager->persist($cov2);

        $cov3 = new Covoiturage();
        $cov3->setLieuDepart('Lyon')
            ->setDateDepart(new \DateTime('2026-05-20'))
            ->setHeureDepart(new \DateTime('07:30:00'))
            ->setLieuArrivee('Marseille')
            ->setDateArrivee(new \DateTime('2026-05-20'))
            ->setHeureArrivee(new \DateTime('10:45:00'))
            ->setStatut('complet')
            ->setNbPlace(1)
            ->setPrixPersonne(12.00)
            ->setConducteur($user)
            ->setVoiture($voiture1);
        $manager->persist($cov3);

        // ----------------------------------------------------------------
        // AVIS (reliés à Clara via la relation ManyToMany User <-> Avis)
        // ----------------------------------------------------------------

        $avis1 = new Avis();
        $avis1->setCommentaire('Très bon conducteur, ponctuel et agréable.')
            ->setNote(5)
            ->setStatut('approuve');
        // L'avis est attribué à Clara (le conducteur noté)
        $user->addAvis($avis1);
        $manager->persist($avis1);

        $avis2 = new Avis();
        $avis2->setCommentaire('Trajet confortable, voiture propre. Léger retard au départ.')
            ->setNote(4)
            ->setStatut('approuve');
        $user->addAvis($avis2);
        $manager->persist($avis2);

        // ----------------------------------------------------------------
        $manager->flush();
    }
}

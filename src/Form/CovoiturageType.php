<?php

namespace App\Form;

use App\Entity\Covoiturage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CovoiturageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_depart', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de départ',
            ])
            ->add('heure_depart', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Heure de départ',
            ])
            ->add('lieu_depart', TextType::class, [
                'label' => 'Lieu de départ',
            ])
            ->add('date_arrivee', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date d’arrivée',
            ])
            ->add('heure_arrivee', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Heure d’arrivée',
            ])
            ->add('lieu_arrivee', TextType::class, [
                'label' => 'Lieu d’arrivée',
            ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Ouvert' => 'ouvert',
                    'Fermé' => 'ferme',
                    'Annulé' => 'annule',
                ],
            ])
            ->add('nb_place', IntegerType::class, [
                'label' => 'Nombre de places disponibles',
            ])
            ->add('prix_personne', MoneyType::class, [
                'label' => 'Prix par personne',
                'currency' => 'EUR',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer le covoiturage',
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Covoiturage::class,
        ]);
    }
}

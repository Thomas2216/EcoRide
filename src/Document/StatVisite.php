<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\Document(collection: 'stat_visites')]
class StatVisite
{
    #[ODM\Id]
    private ?string $id = null;

    #[ODM\Field(type: 'date')]
    private \DateTimeInterface $date;

    #[ODM\Field(type: 'int')]
    private int $nombreCovoiturages;

    #[ODM\Field(type: 'string')]
    private string $ipUtilisateur;

    public function __construct(\DateTimeInterface $date, int $nombreCovoiturages, string $ipUtilisateur)
    {
        $this->date = $date;
        $this->nombreCovoiturages = $nombreCovoiturages;
        $this->ipUtilisateur = $ipUtilisateur;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getNombreCovoiturages(): int
    {
        return $this->nombreCovoiturages;
    }

    public function getIpUtilisateur(): string
    {
        return $this->ipUtilisateur;
    }
}

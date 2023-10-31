<?php

namespace App\Entity;

use App\Repository\IndexPoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IndexPoleRepository::class)]
class IndexPole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $indexName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlIndex = null;

    #[ORM\ManyToOne(inversedBy: 'indexPoles')]
    private ?Pole $pole = null;

    #[ORM\OneToOne(mappedBy: 'urlIndex', cascade: ['persist', 'remove'])]
    private ?RapportActivite $rapportActivite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndexName(): ?string
    {
        return $this->indexName;
    }

    public function setIndexName(string $indexName): static
    {
        $this->indexName = $indexName;

        return $this;
    }

    public function getUrlIndex(): ?string
    {
        return $this->urlIndex;
    }

    public function setUrlIndex(?string $urlIndex): static
    {
        $this->urlIndex = $urlIndex;

        return $this;
    }

    public function getPole(): ?Pole
    {
        return $this->pole;
    }

    public function setPole(?Pole $pole): static
    {
        $this->pole = $pole;

        return $this;
    }

    public function getRapportActivite(): ?RapportActivite
    {
        return $this->rapportActivite;
    }

    public function setRapportActivite(?RapportActivite $rapportActivite): static
    {
        // unset the owning side of the relation if necessary
        if ($rapportActivite === null && $this->rapportActivite !== null) {
            $this->rapportActivite->setUrlIndex(null);
        }

        // set the owning side of the relation if necessary
        if ($rapportActivite !== null && $rapportActivite->getUrlIndex() !== $this) {
            $rapportActivite->setUrlIndex($this);
        }

        $this->rapportActivite = $rapportActivite;

        return $this;
    }
}

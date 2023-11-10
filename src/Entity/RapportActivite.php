<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RapportActiviteRepository;
use PhpOffice\PhpWord\PhpWord;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: RapportActiviteRepository::class)]
#[Vich\Uploadable]
class RapportActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $missionPrincipale = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $indicateur = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $realisation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $perspective = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $donneesFinance = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $donneesRH = null;

    #[ORM\Column(length: 255)]
    private ?string $status = 'En cours';

    #[Vich\UploadableField(mapping: 'file_upload_indicateur', fileNameProperty: 'indicateurFileName')]
    private ?File $indicateurFile = null;

    #[Vich\UploadableField(mapping: 'file_upload_realisation', fileNameProperty: 'realisationFileName')]
    private ?File $realisationFile = null;

    #[Vich\UploadableField(mapping: 'file_upload_perspective', fileNameProperty: 'perspectiveFileName')]
    private ?File $perspectiveFile = null;

    private ?PhpWord $rapportActiviteFile = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $indicateurFileName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $realisationFileName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $perspectiveFileName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $rapportActiviteFileName = null;

    #[ORM\ManyToOne]
    private ?IndexPole $urlIndex = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMissionPrincipale(): ?string
    {
        return $this->missionPrincipale;
    }

    public function setMissionPrincipale(string $missionPrincipale): static
    {
        $this->missionPrincipale = $missionPrincipale;

        return $this;
    }

    public function getIndicateur(): ?string
    {
        return $this->indicateur;
    }

    public function setIndicateur(string $indicateur): static
    {
        $this->indicateur = $indicateur;

        return $this;
    }

    public function getRealisation(): ?string
    {
        return $this->realisation;
    }

    public function setRealisation(string $realisation): static
    {
        $this->realisation = $realisation;

        return $this;
    }

    public function getPerspective(): ?string
    {
        return $this->perspective;
    }

    public function setPerspective(string $perspective): static
    {
        $this->perspective = $perspective;

        return $this;
    }

    public function getDonneesFinance(): ?string
    {
        return $this->donneesFinance;
    }

    public function setDonneesFinance(?string $donneesFinance): static
    {
        $this->donneesFinance = $donneesFinance;

        return $this;
    }

    public function getDonneesRH(): ?string
    {
        return $this->donneesRH;
    }

    public function setDonneesRH(?string $donneesRH): static
    {
        $this->donneesRH = $donneesRH;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getIndicateurFileName(): ?string
    {
        return $this->indicateurFileName;
    }

    public function setIndicateurFileName(?string $indicateurFileName): void
    {
        $this->indicateurFileName = $indicateurFileName;
    }

    public function getRealisationFileName(): ?string
    {
        return $this->realisationFileName;
    }

    public function setRealisationFileName(?string $realisationFileName): void
    {
        $this->realisationFileName = $realisationFileName;
    }

    public function getPerspectiveFileName(): ?string
    {
        return $this->perspectiveFileName;
    }

    public function setPerspectiveFileName(?string $perspectiveFileName): void
    {
        $this->perspectiveFileName = $perspectiveFileName;
    }

    public function getRapportActiviteFileName(): string
    {
        return $this->rapportActiviteFileName;
    }

    public function setRapportActiviteFileName(?string $rapportActiviteFileName): void
    {
        $this->rapportActiviteFileName = $rapportActiviteFileName;
    }

    public function getUrlIndex(): ?IndexPole
    {
        return $this->urlIndex;
    }

    public function setUrlIndex(?IndexPole $urlIndex): static
    {
        $this->urlIndex = $urlIndex;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getIndicateurFile(): ?File
    {
        return $this->indicateurFile;
    }

    public function setIndicateurFile(?File $indicateurFile = null): void
    {
        $this->indicateurFile = $indicateurFile;
    }

    public function getRealisationFile(): ?File
    {
        return $this->realisationFile;
    }

    public function setRealisationFile(?File $realisationFile = null): void
    {
        $this->realisationFile = $realisationFile;
    }

    public function getPerspectiveFile(): ?File
    {
        return $this->perspectiveFile;
    }

    public function setPerspectiveFile(?File $perspectiveFile = null): void
    {
        $this->perspectiveFile = $perspectiveFile;
    }

    public function getRapportActiviteFile(): ?PhpWord {
    	return $this->rapportActiviteFile;
    }

    public function setRapportActiviteFile(?PhpWord $rapportActiviteFile = null): void {
    	$this->rapportActiviteFile = $rapportActiviteFile;
    }
}

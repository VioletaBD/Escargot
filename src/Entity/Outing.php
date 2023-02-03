<?php

namespace App\Entity;

use DateTime;
use App\Entity\User;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OutingRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OutingRepository::class)]
#[Vich\Uploadable]
class Outing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Assert\Length(max: 255)]
    #[ORM\Column(nullable: true)]
    private ?string $outingName = null;
     
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    #[Vich\UploadableField(mapping: 'outing_file', fileNameProperty: 'outingName')]
    private ?File $outingFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DatetimeInterface $updatedAt = null;
    
    #[ORM\Column(length: 255)]
    private ?string $dateTime = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'inscription')]
    private Collection $inscription;

    public function __construct()
    {
        $this->inscription = new ArrayCollection();
        $this->updatedAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOutingFile(): ?File
    {
        return $this->outingFile;
    }

    public function setOutingFile(File $outingFile = null): void
    {
        $this->outingFile = $outingFile;
        if ($outingFile) {
            $this->updatedAt = new DateTime('now');
          }      
    }

    public function getOutingName(): ?string
    {
        return $this->outingName;
    }

    public function setOutingName(?string $outingName): void
    {
        $this->outingName = $outingName;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getInscription(): Collection
    {
        return $this->inscription;
    }

    public function addInscription(User $inscription): self
    {
        if (!$this->inscription->contains($inscription)) {
            $this->inscription->add($inscription);
        }

        return $this;
    }

    public function removeInscription(User $inscription): self
    {
        $this->inscription->removeElement($inscription);

        return $this;
    }
}

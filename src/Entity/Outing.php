<?php

namespace App\Entity;

use App\Repository\OutingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OutingRepository::class)]
class Outing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?string $file = null;

    #[ORM\Column(length: 255)]
    private ?string $dateTime = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'inscription')]
    private Collection $inscription;

    public function __construct()
    {
        $this->inscription = new ArrayCollection();
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

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

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

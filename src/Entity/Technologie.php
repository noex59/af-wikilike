<?php

namespace App\Entity;

use App\Repository\TechnologieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TechnologieRepository::class)]
class Technologie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'technologies', targetEntity: Exemple::class)]
    private $exemple;

	public function __construct() {
		$this->exemple = new ArrayCollection();
	}

	public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getExemples(): Collection
    {
        return $this->exemple;
    }

	public function addExemples(Exemple $exemple): self
	{
		if (!$this->exemple->contains($exemple)) {
			$this->exemple->add($exemple);
			$exemple->setTechnologies($this);
		}

		return $this;
	}

	public function removeExemples(Exemple $exemple): self
	{
		if ($this->exemple->removeElement($exemple)) {
			// set the owning side to null (unless already changed)
			if ($exemple->getTechnologies() === $this) {
				$exemple->setTechnologies(null);
			}
		}

		return $this;
	}

	public function __toString(): string{
		return $this->libelle;
	}
}

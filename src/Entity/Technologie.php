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

	#[ORM\ManyToMany(targetEntity: Exemple::class, mappedBy: 'technologies')]
	private Collection $exemples;


	public function __construct() {
		$this->exemples = new ArrayCollection();
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

	/**
	 * @return Collection<int, Exemple>
	 */
	public function getExemples(): Collection
	{
		return $this->exemples;
	}

	public function addExemple(Exemple $exemple): self
	{
		if (!$this->exemples->contains($exemple)) {
			$this->exemples->add($exemple);
			$exemple->addTechnology($this);
		}

		return $this;
	}

	public function removeExemple(Exemple $exemple): self
	{
		if ($this->exemples->removeElement($exemple)) {
			$exemple->removeTechnology($this);
		}

		return $this;
	}

	public function __toString(): string{
		return $this->libelle;
	}
}

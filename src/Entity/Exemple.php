<?php

namespace App\Entity;

use App\Repository\ExempleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExempleRepository::class)]
class Exemple
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(length: 200)]
	private ?string $titre = null;

	#[ORM\Column(type: Types::TEXT, nullable: true)]
	private ?string $description = null;

	#[ORM\Column(type: Types::TEXT)]
	private ?string $code = null;

	#[ORM\Column]
	private ?\DateTimeImmutable $createdAt = null;

	#[ORM\Column(length: 255, nullable: true)]
	private ?string $video = null;

	#[ORM\ManyToMany(targetEntity: Technologie::class, inversedBy: 'exemples')]
	private Collection $technologies;

	public function __construct()
	{
		$this->technologies = new ArrayCollection();
	}


	public function getId(): ?int
	{
		return $this->id;
	}

	public function getTitre(): ?string
	{
		return $this->titre;
	}

	public function setTitre(string $titre): self
	{
		$this->titre = $titre;

		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(?string $description): self
	{
		$this->description = $description;

		return $this;
	}

	public function getCode(): ?string
	{
		return $this->code;
	}

	public function setCode(string $code): self
	{
		$this->code = $code;

		return $this;
	}

	public function getCreatedAt(): ?\DateTimeImmutable
	{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTimeImmutable $createdAt): self
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	public function getVideo(): ?string
	{
		return $this->video;
	}

	public function setVideo(?string $video): self
	{
		$this->video = $video;

		return $this;
	}

	/**
	 * @return Collection<int, Technologie>
	 */
	public function getTechnologies(): Collection
	{
		return $this->technologies;
	}

	public function addTechnology(Technologie $technology): self
	{
		if (!$this->technologies->contains($technology)) {
			$this->technologies->add($technology);
		}

		return $this;
	}

	public function removeTechnology(Technologie $technology): self
	{
		$this->technologies->removeElement($technology);

		return $this;
	}
}

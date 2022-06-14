<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Provincia;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LocalidadRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: LocalidadRepository::class)]
class Localidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\ManyToOne(targetEntity: Provincia::class, inversedBy: 'localidades')]
    #[ORM\JoinColumn(nullable: false)]
    private $provincia;

    #[ORM\OneToMany(mappedBy: 'localidad', targetEntity: User::class)]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setLocalidad($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLocalidad() === $this) {
                $user->setLocalidad(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nombre;
    }
}

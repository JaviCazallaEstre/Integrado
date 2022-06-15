<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Producto;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompraRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CompraRepository::class)]
class Compra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fecha;

    #[ORM\Column(type: 'float')]
    private $coste;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'compras')]
    private $usuario;

    #[ORM\ManyToMany(targetEntity: Producto::class, inversedBy: 'compras')]
    private $compras;

    public function __construct()
    {
        $this->compras = new ArrayCollection();
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCoste(): ?float
    {
        return $this->coste;
    }

    public function setCoste(float $coste): self
    {
        $this->coste = $coste;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection<int, producto>
     */
    public function getCompras(): Collection
    {
        return $this->compras;
    }

    public function addCompra(Producto $compra): self
    {
        if (!$this->compras->contains($compra)) {
            $this->compras[] = $compra;
        }

        return $this;
    }

    public function removeCompra(producto $compra): self
    {
        $this->compras->removeElement($compra);

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CarritoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarritoRepository::class)]
class Carrito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: producto::class, cascade: ['persist', 'remove'])]
    private $producto;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'carritos')]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    #[ORM\Column(type: 'integer')]
    private $cantidad;

    public function __construct()
    {
        $this->usuario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function getProducto(): ?producto
    {
        return $this->producto;
    }

    public function setProducto(?producto $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function setUsuario(?user $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
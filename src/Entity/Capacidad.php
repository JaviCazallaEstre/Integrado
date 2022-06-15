<?php

namespace App\Entity;

use App\Repository\CapacidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapacidadRepository::class)]
class Capacidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $capacidad;

    #[ORM\OneToMany(mappedBy: 'capacidad', targetEntity: Producto::class)]
    private $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
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

    public function getCapacidad(): ?string
    {
        return $this->capacidad;
    }

    public function setCapacidad(string $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setCapacidad($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getCapacidad() === $this) {
                $producto->setCapacidad(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->capacidad;
    }
}

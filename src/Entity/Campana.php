<?php

namespace App\Entity;

use App\Repository\CampanaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampanaRepository::class)]
class Campana
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $campana;

    #[ORM\OneToMany(mappedBy: 'campana', targetEntity: Producto::class)]
    private $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampana(): ?string
    {
        return $this->campana;
    }

    public function setCampana(string $campana): self
    {
        $this->campana = $campana;

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
            $producto->setCampana($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getCampana() === $this) {
                $producto->setCampana(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->campana;
    }
}

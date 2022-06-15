<?php

namespace App\Entity;

use App\Entity\Producto;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CosechaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CosechaRepository::class)]
class Cosecha
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $cosecha;

    #[ORM\OneToMany(mappedBy: 'cosecha', targetEntity: Producto::class)]
    private $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCosecha(): ?string
    {
        return $this->cosecha;
    }

    public function setCosecha(string $cosecha): self
    {
        $this->cosecha = $cosecha;

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
            $producto->setCosecha($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getCosecha() === $this) {
                $producto->setCosecha(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->cosecha;
    }
}

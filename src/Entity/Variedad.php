<?php

namespace App\Entity;

use App\Entity\Producto;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VariedadRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: VariedadRepository::class)]
class Variedad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $variedad;

    #[ORM\OneToMany(mappedBy: 'variedad', targetEntity: Producto::class)]
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

    public function getVariedad(): ?string
    {
        return $this->variedad;
    }

    public function setVariedad(string $variedad): self
    {
        $this->variedad = $variedad;

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
            $producto->setVariedad($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getVariedad() === $this) {
                $producto->setVariedad(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->variedad;
    }
}

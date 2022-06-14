<?php

namespace App\Entity;

use App\Entity\Compra;
use App\Entity\Campana;
use App\Entity\Cosecha;
use App\Entity\Variedad;
use App\Entity\Capacidad;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'float')]
    private $precio;

    #[ORM\Column(type: 'string', length: 255)]
    private $descripcion;

    #[ORM\ManyToOne(targetEntity: Variedad::class, inversedBy: 'productos')]
    private $variedad;

    #[ORM\ManyToOne(targetEntity: Cosecha::class, inversedBy: 'productos')]
    private $cosecha;

    #[ORM\Column(type: 'string', length: 255)]
    private $foto;

    #[ORM\ManyToMany(targetEntity: Compra::class, mappedBy: 'compras')]
    private $compras;

    #[ORM\ManyToOne(targetEntity: Campana::class, inversedBy: 'productos')]
    private $campana;

    #[ORM\Column(type: 'integer')]
    private $stock;

    #[ORM\ManyToOne(targetEntity: Capacidad::class, inversedBy: 'productos')]
    private $capacidad;

    public function __construct()
    {
        $this->compras = new ArrayCollection();
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

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getVariedad(): ?Variedad
    {
        return $this->variedad;
    }

    public function setVariedad(?Variedad $variedad): self
    {
        $this->variedad = $variedad;

        return $this;
    }

    public function getCosecha(): ?Cosecha
    {
        return $this->cosecha;
    }

    public function setCosecha(?Cosecha $cosecha): self
    {
        $this->cosecha = $cosecha;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return Collection<int, Compra>
     */
    public function getCompras(): Collection
    {
        return $this->compras;
    }

    public function addCompra(Compra $compra): self
    {
        if (!$this->compras->contains($compra)) {
            $this->compras[] = $compra;
            $compra->addCompra($this);
        }

        return $this;
    }

    public function removeCompra(Compra $compra): self
    {
        if ($this->compras->removeElement($compra)) {
            $compra->removeCompra($this);
        }

        return $this;
    }

    public function getCampana(): ?Campana
    {
        return $this->campana;
    }

    public function setCampana(?Campana $campana): self
    {
        $this->campana = $campana;

        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCapacidad(): ?Capacidad
    {
        return $this->capacidad;
    }

    public function setCapacidad(?Capacidad $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }
}
